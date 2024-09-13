<?php

use
	Dotenv\Dotenv,
	ProjectList\Database,
	ProjectList\ErrorHandler;

require __DIR__ . "/vendor/autoload.php";

set_error_handler(function ($severity, $message, $file, $line) {
	throw new ErrorException($message, 0, $severity, $file, $line);
});
set_exception_handler([ErrorHandler::class, "handle"]);
register_shutdown_function([ErrorHandler::class, "shutdown"]);

session_start();

$dotenv = Dotenv::createImmutable(__DIR__)->load();

foreach (array_diff(scandir(__DIR__ . "/function"), array(".", "..", "include.php")) as $file) {
	require_once __DIR__ . "/function/" . $file;
}

$db = new Database;
define("DATABASE", $db->getConnection());
