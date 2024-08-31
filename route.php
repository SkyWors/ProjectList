<?php

switch (explode("?", $_SERVER["REQUEST_URI"])[0]) {
	case "/":
		include "page/index.php";
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
