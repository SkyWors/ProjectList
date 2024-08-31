<?php

require_once __DIR__ . "/../start.php";

unset($_SESSION["token"]);
unset($_SESSION['userData']);

GCLIENT->revokeToken();

header("Location: /login");
