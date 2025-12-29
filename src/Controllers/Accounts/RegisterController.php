<?php

namespace App\Controllers\Accounts;

use App\Enums\Path;
use Tempora\Attributes\RouteAttribute;
use Tempora\Controllers\Controller;
use Tempora\Utils\Lang;

class RegisterController extends Controller {
	#[RouteAttribute(
		path: "/register",
		name: "app_account_register_get",
		method: "GET",
		description: "Register page",
		title: "REGISTER_TITLE",
		translateTitle: true,
		translateFile: "pages/register",
		needLoginToBe: false
	)]

	public function render(): void {
		$pageData = $this->getPageData();
		$pageLang = new Lang(filePath: "pages/register");

		$this->setStyles(styles: [
			"/assets/styles/main.css",
			"/assets/styles/remixicon.css"
		]);

		$this->setScripts(scripts: [
			"/assets/scripts/engine.js",
			"/assets/scripts/theme.js"
		]);

		require Path::LAYOUT->value . "/header.php";

		require Path::LAYOUT->value . "/register/index.php";

		include Path::LAYOUT->value . "/footer.php";
	}
}
