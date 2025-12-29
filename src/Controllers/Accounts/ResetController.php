<?php

namespace App\Controllers\Accounts;

use App\Enums\Path;
use App\Models\Repositories\ResetPasswordRepository;
use Tempora\Attributes\RouteAttribute;
use Tempora\Controllers\Controller;
use Tempora\Utils\Lang;
use Tempora\Utils\System;

class ResetController extends Controller {
	#[RouteAttribute(
		path: '/reset/$link',
		name: 'app_account_reset_get',
		method: "GET",
		description: "Reset password page",
		title: "RESET_TITLE",
		translateTitle: true,
		translateFile: "pages/reset",
		needLoginToBe: false
	)]

	public function render(): void {
		$pageData = $this->getPageData();
		$pageLang = new Lang(filePath: "pages/reset");

		$resetPasswordRepo = new ResetPasswordRepository;
		$resetPasswordRepo
			->setLink(link: $pageData["link"])
			->setUid()
		;

		if ($resetPasswordRepo->getUid() === null)
			System::redirect(url: "/");

		$this->setStyles(styles: [
			"/assets/styles/main.css",
			"/assets/styles/remixicon.css"
		]);

		$this->setScripts(scripts: [
			"/assets/scripts/engine.js",
			"/assets/scripts/theme.js"
		]);

		require Path::LAYOUT->value . "/header.php";

		require Path::LAYOUT->value . "/reset/index.php";

		include Path::LAYOUT->value . "/footer.php";
	}
}
