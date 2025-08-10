<?php

namespace App\Controllers\Accounts;

use App\Enums\Path;
use Tempora\Attributes\RouteAttribute;
use Tempora\Controllers\Controller;

class LoginController extends Controller {
	#[RouteAttribute(
		path: "/login",
		name: "app_account_login_get",
		method: "GET",
		description: "Login page",
		title: "LOGIN_TITLE",
		translateTitle: true,
		needLoginToBe: false
	)]

	public function __invoke(): void {
		$pageData = $this->getPageData();

		if (isset($pageData["form_email"])) {
			$_SESSION["page_data"] = [
				"form_email" => $pageData["form_email"]
			];
		}

		$this->setStyles(styles: [
			"/assets/styles/main.css",
			"/assets/styles/remixicon.css"
		]);

		$this->setScripts(scripts: [
			"/assets/scripts/engine.js",
			"/assets/scripts/theme.js"
		]);

		require Path::LAYOUT->value . "/header.php";

		require Path::LAYOUT->value . "/login/index.php";

		include Path::LAYOUT->value . "/footer.php";
	}
}
