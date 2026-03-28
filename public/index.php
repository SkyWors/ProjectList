<?php

use Tempora\Tempora;
use Tempora\Utils\Render\Modules\RenderRemoveWhitespaceBetweenTagsModule;
use Tempora\Utils\Render\Modules\RenderRemoveTrailingWhitespaceModule;
use Tempora\Utils\Render\Modules\RenderRemoveEmptyLinesModule;
use Tempora\Utils\Render\Modules\RenderCollapseSpacesModule;
use Tempora\Utils\Render\Modules\RenderRemoveNewLinesModule;
use Tempora\Utils\Render\Modules\RenderRemoveCommentsModule;

// Path
define(constant_name: "APP_DIR", value: $_SERVER["DOCUMENT_ROOT"] . "/..");
define(constant_name: "ASSET_ICONS_CSS", value: "https://cdn.jsdelivr.net/npm/remixicon@4.8.0/fonts/remixicon.css");
define(constant_name: "ASSET_FONT", value: "https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap");

// Composer
require APP_DIR . "/vendor/autoload.php";

// Tempora's kernel
(new Tempora(
	modules: [
		new RenderRemoveWhitespaceBetweenTagsModule(),
		new RenderRemoveTrailingWhitespaceModule(),
		new RenderRemoveEmptyLinesModule(),
		new RenderCollapseSpacesModule(),
		new RenderRemoveNewLinesModule(),
		new RenderRemoveCommentsModule()
	]
));
