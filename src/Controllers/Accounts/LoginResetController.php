<?php

namespace App\Controllers\Accounts;

use App\Enums\Path;
use Tempora\Attributes\RouteAttribute;
use Tempora\Controllers\Controller;

class LoginResetController extends Controller {
	#[RouteAttribute(
		path: "/login/reset",
		name: "app_account_login_reset_get",
		method: "GET",
		description: "Login reset page",
		title: "LOGIN_RESET_TITLE",
		translateTitle: true,
		needLoginToBe: false
	)]

	public function __invoke(): void {
		$pageData = $this->getPageData();

		$this->setStyles(styles: [
			"/assets/styles/main.css",
			"/assets/styles/remixicon.css"
		]);

		$this->setScripts(scripts: [
			"/assets/scripts/engine.js",
			"/assets/scripts/theme.js"
		]);

		require Path::LAYOUT->value . "/header.php";

		require Path::LAYOUT->value . "/login/reset/index.php";

		include Path::LAYOUT->value . "/footer.php";
	}
}
