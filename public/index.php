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
