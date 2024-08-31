<?php

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

use
	Dotenv\Dotenv,
	ProjectList\Database,
	Google_Client;

session_start();

require __DIR__ . "/vendor/autoload.php";

$dotenv = Dotenv::createImmutable(__DIR__)->load();

foreach (array_diff(scandir(__DIR__ . "/function"), array(".", "..", "include.php")) as $file) {
	require_once __DIR__ . "/function/" . $file;
}

$db = new Database;
define("DATABASE", $db->getConnection());

define("GCLIENT", new Google_Client());
GCLIENT->setApplicationName('Login to ProjectList');
GCLIENT->setClientId($_ENV["GOOGLE_CLIENT_ID"]);
GCLIENT->setClientSecret($_ENV["GOOGLE_CLIENT_SECRET"]);
GCLIENT->setRedirectUri("http://projectlist.fr" . $_ENV["GOOGLE_REDIRECT_URL"]);
GCLIENT->addScope(['https://www.googleapis.com/auth/userinfo.email']);
