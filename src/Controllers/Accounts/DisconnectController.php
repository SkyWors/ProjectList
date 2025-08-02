<?php

namespace App\Controllers\Accounts;

use Tempora\Attributes\RouteAttribute;
use Tempora\Controllers\Controller;
use Tempora\Utils\Cookie;
use Tempora\Utils\JWT;
use Tempora\Utils\System;

class DisconnectController extends Controller {
	#[RouteAttribute(
		path: "/disconnect",
		name: "app_account_disconnect_get",
		method: "GET",
		description: "Disconnect page",
	)]

	public function __invoke(): void {
		session_regenerate_id();

		if (isset($_COOKIE["JWT"])) {
			(new JWT)->delete(token: $_COOKIE["JWT"]);

			$jwtCookie = new Cookie;
			$jwtCookie
				->setName(name: "JWT")
				->setValue(value: "")
				->setExpire(expire: 0)
			;
			$jwtCookie->send();
		}

		unset($_SESSION["user"]);

		System::redirect(url: "/");
	}
}
