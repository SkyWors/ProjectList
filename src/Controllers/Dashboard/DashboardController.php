<?php

namespace App\Controllers\Dashboard;

use App\Enums\Path;
use App\Enums\Role;
use App\Models\Repositories\ProfileRepository;
use Tempora\Attributes\RouteAttribute;
use Tempora\Controllers\Controller;

class DashboardController extends Controller {
	#[RouteAttribute(
		path: "/dashboard",
		name: "app_dashboard_get",
		method: "GET",
		description: "Dashboard page",
		title: "DASHBOARD_TITLE",
		translateTitle: true,
		translateFile: "pages/dashboard",
		needLoginToBe: true,
		accessRoles: [
			Role::USER,
		]
	)]

	public function render(): void {
		$pageData = $this->getPageData();

		$profile = (new ProfileRepository())->setUid(uid: "abc");
		$projectsUid = $profile->getProjects();

		$this->setStyles(styles: [
			"/assets/styles/dashboard.css",
			"/assets/styles/remixicon.css"
		]);

		$this->setScripts(scripts: [
			"/assets/scripts/engine.js",
			"/assets/scripts/theme.js",
			"/assets/scripts/drawer.js",
			"/assets/scripts/project.js",
		]);

		require Path::LAYOUT->value . "/header.php";

		require Path::LAYOUT->value . "/dashboard/index.php";

		include Path::LAYOUT->value . "/footer.php";
	}
}
