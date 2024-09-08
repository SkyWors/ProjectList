<?php

require_once __DIR__ . "/start.php";

switch (explode("?", $_SERVER["REQUEST_URI"])[0]) {
	case "/":
		include "page/index.php";
		break;
	case "/export":
		include "page/export.php";
		break;
	case "/login":
		include "page/login.php";
		break;
	case "/logout":
		include "page/logout.php";
		break;
	default:
		include "page/notfound.php";
		break;
};
