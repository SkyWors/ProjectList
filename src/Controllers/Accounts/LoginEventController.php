<?php

namespace App\Controllers\Accounts;

use App\Models\Repositories\UserRepository;
use Exception;
use Tempora\Attributes\RouteAttribute;
use Tempora\Controllers\Controller;
use Tempora\Utils\Cookie;
use Tempora\Utils\JWT;
use Tempora\Utils\Lang;
use Tempora\Utils\System;

class LoginEventController extends Controller {
	#[RouteAttribute(
		path: "/login",
		name: "app_account_login_post",
		method: "POST"
	)]

	public function __invoke(): void {
		if (
			System::checkCSRF()
			&& isset($_POST["email"])
			&& isset($_POST["password"])
		) {
			$userRepo = new UserRepository;
			$userRepo
				->setEmail(email: $_POST["email"])
				->setPassword(password: $_POST["password"])
			;

			$uid = $userRepo->verifyPassword();

			if ($uid instanceof Exception) {
				$notificationCookie = new Cookie;
				$notificationCookie
					->setName(name: "NOTIFICATION")
					->setValue(value: Lang::translate(key: "LOGIN_WRONG_CREDENTIALS"))
				;
				$notificationCookie->send();

				$_SESSION["page_data"] = [
					"form_email" => $_POST["email"],
					"form_password" => $_POST["password"]
				];
			} else {
				$_SESSION["user"]["uid"] = $uid;

				$cookieJWT = new Cookie;
				$cookieJWT
					->setName(name: "JWT")
					->setValue(value: (new JWT)->create())
					->setSecure(secure: true)
					->setHttpOnly(httponly: true)
				;
				$cookieJWT->send();

				System::redirect(url: "/");
			}
		}

		System::redirect();
	}
}
