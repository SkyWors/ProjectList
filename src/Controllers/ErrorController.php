<?php

namespace App\Controllers;

use App\Enums\Path;
use Tempora\Controllers\Controller;

class ErrorController extends Controller {
	public function __invoke(): void {
		$pageData = $this->getPageData();

		http_response_code(response_code: $pageData["error_code"]);

		$this->setStyles(styles: [
			"/assets/styles/main.css",
			"/assets/styles/remixicon.css"
		]);

		$this->setScripts(scripts: [
			"/assets/scripts/engine.js",
			"/assets/scripts/theme.js"
		]);

		require Path::LAYOUT->value . "/header.php";

		require Path::LAYOUT->value . "/error/index.php";

		include Path::LAYOUT->value . "/footer.php";
	}
}
