<?php

// Path
define(constant_name: "APP_DIR", value: $_SERVER["DOCUMENT_ROOT"] . "/..");

// Composer
require APP_DIR . "/vendor/autoload.php";

// Tempora's kernel
new Tempora\Tempora;
