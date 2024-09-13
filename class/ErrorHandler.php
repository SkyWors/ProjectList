<?php

namespace ProjectList;

use
	ErrorException,
	Throwable;

class ErrorHandler {
	public static function handle(Throwable $exception) {
		$errorFolder = __DIR__ . "/../log";
		$logFile = $errorFolder . "/" . date("Y-m-d") . ".log";

		if (!file_exists($errorFolder . "/"))
			mkdir($errorFolder, 0777, true);

        $errorMessage = "[" . date('Y-m-d H:i:s') . "] ";
        $errorMessage .= "Uncaught Exception: " . $exception->getMessage() . "\n";
        $errorMessage .= "File: " . $exception->getFile() . " (Line " . $exception->getLine() . ")\n";
        $errorMessage .= "Stack trace:\n" . $exception->getTraceAsString() . "\n\n";

        file_put_contents($logFile, $errorMessage, FILE_APPEND);

		header("Location: /error");
	}

	public static function shutdown() {
		$error = error_get_last();
		if ($error != NULL) {
			$exception = new ErrorException(
				$error['message'], 0, $error['type'], $error['file'], $error['line']
			);
			self::handle($exception);
		}
	}
}
