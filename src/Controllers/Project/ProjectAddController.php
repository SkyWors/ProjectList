<?php

namespace App\Controllers\Project;

use App\Enums\Path;
use App\Enums\Role;
use Tempora\Attributes\RouteAttribute;
use Tempora\Controllers\Controller;

class ProjectAddController extends Controller {
	#[RouteAttribute(
		path: '/project/add',
		name: "app_project_add_get",
		method: "GET",
		description: "Project configuration page",
		title: "PROJECT_ADD_TITLE",
		translateTitle: true,
		needLoginToBe: true,
		accessRoles: [
			Role::USER,
		]
	)]

	public function __invoke(): void {
		$pageData = $this->getPageData();

		$this->setStyles(styles: [
			"/assets/styles/dashboard.css",
			"/assets/styles/project.css",
			"/assets/styles/remixicon.css"
		]);

		$this->setScripts(scripts: [
			"/assets/scripts/engine.js",
			"/assets/scripts/theme.js",
			"/assets/scripts/drawer.js",
			"/assets/scripts/project.js",
		]);

		require Path::LAYOUT->value . "/header.php";

		require Path::LAYOUT->value . "/project/index.php";

		include Path::LAYOUT->value . "/footer.php";
	}
}
