<?php

namespace App\Controllers\Project;

use App\Models\Entities\User;
use App\Models\Repositories\ProfileRepository;
use App\Models\Repositories\ProjectRepository;
use Tempora\Attributes\RouteAttribute;
use Tempora\Controllers\Controller;
use Tempora\Utils\Cache\Route;
use Tempora\Utils\Cookie;
use Tempora\Utils\System;

class ProjectAddEventController extends Controller {
	#[RouteAttribute(
		path: "/project/add",
		name: "app_project_add_post",
		method: "POST"
	)]

	public function __invoke(): void {
		if (
			System::checkCSRF()
			&& isset($_POST["name"])
		) {
			$imageBlob = null;

			if (
				isset($_FILES["illustration"])
				&& $_FILES["illustration"]["error"] === UPLOAD_ERR_OK
				&& $_FILES["illustration"]["size"] > 0
			) {
				if ($_FILES["illustration"]["size"] > 512000) {
					$notificationCookie = new Cookie;
					$notificationCookie
						->setName(name: "NOTIFICATION")
						->setValue(value: "File too large")
					;
					$notificationCookie->send();
					System::redirect();
				}

				$allowedTypes = ['image/jpeg', 'image/png'];
				if (!in_array($_FILES["illustration"]["type"], $allowedTypes)) {
					$notificationCookie = new Cookie;
					$notificationCookie
						->setName(name: "NOTIFICATION")
						->setValue(value: "Invalid type")
					;
					$notificationCookie->send();
					System::redirect();
				} else {
					$fileTmp = $_FILES["illustration"]["tmp_name"] ?? null;

					if (getimagesize(filename: $fileTmp) === false) {
						$notificationCookie = new Cookie;
						$notificationCookie
							->setName(name: "NOTIFICATION")
							->setValue(value: "Invalid image")
						;
						$notificationCookie->send();
						System::redirect();
					}

					$srcImage = imagecreatefromstring(data: file_get_contents(filename: $fileTmp));
					$resizedImage = imagecreatetruecolor(width: 80, height: 80);
					imagecopyresampled(
						dst_image: $resizedImage,
						src_image: $srcImage,
						dst_x: 0,
						dst_y: 0,
						src_x: 0,
						src_y: 0,
						dst_width: 80,
						dst_height: 80,
						src_width: imagesx(image: $srcImage),
						src_height: imagesy(image: $srcImage)
					);

					ob_start();
					imagepng(image: $resizedImage, quality: 9, filters: PNG_ALL_FILTERS);
					$imageBlob = ob_get_clean();
				}
			}

			// Create the project
			$project = new ProjectRepository();
			$project
				->setUser(user: (new User())->setUid(uid: $_SESSION["user"]["uid"]))
				->setName(name: $_POST["name"])
				->setDescription(description: $_POST["description"] ?? null)
				->setIllustrationBlob(illustrationBlob: $imageBlob ?? null)
				->create()
			;

			// Add the project to the profile
			$profile = (new ProfileRepository)->setUid(uid: "abc");
			$profile->addProject(
				project: $project
			);

			// Add links
			$links = [];
			foreach ($_POST["link"] as $link) {
				array_push($links, [
					"link" => $link["link"],
					"color" => $link["color"] ?? null,
					"icon" => $link["icon"] ?? null,
				]);
			}
			$project->setLinks(links: $links);
			$project->saveLinks();

			System::redirect(url: Route::getPath(name: "app_dashboard_get"));
		}

		System::redirect();
	}
}
