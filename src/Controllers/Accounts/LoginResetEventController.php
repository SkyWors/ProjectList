<?php

namespace App\Controllers\Accounts;

use App\Models\Repositories\ResetPasswordRepository;
use App\Models\Repositories\UserRepository;
use Tempora\Attributes\RouteAttribute;
use Tempora\Controllers\Controller;
use Tempora\Utils\Cookie;
use Tempora\Utils\Lang;
use Tempora\Utils\System;

class LoginResetEventController extends Controller {
	#[RouteAttribute(
		path: "/login/reset",
		name: "app_account_login_reset_post",
		method: "POST"
	)]

	public function render(): void {
		$pageLang = new Lang(filePath: "pages/login_reset");

		if (
			System::checkCSRF()
			&& isset($_POST["email"])
		) {
			if (UserRepository::getUidByEmail(email: $_POST["email"]) === null)
				System::redirect(url: "/login");

			$resetRepo = new ResetPasswordRepository;
			$resetRepo
				->setEmail(email: $_POST["email"])
				->setUid(uid: UserRepository::getUidByEmail(email: $_POST["email"]))
			;

			if ($resetRepo->isUserUid())
				System::redirect(url: "/login");

			$resetRepo->generateResetLink();
		}

		$notificationCookie = new Cookie;
		$notificationCookie
			->setName(name: "NOTIFICATION")
			->setValue(value: $pageLang->translate(key: "LOGIN_RESET_SEND"))
		;
		$notificationCookie->send();

		System::redirect(url: "/login");
	}
}
