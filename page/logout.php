<?php

require_once __DIR__ . "/../start.php";

unset($_SESSION["userUID"]);

header("Location: /login");
