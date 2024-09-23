<?php

$errorLoginMessage = "";

if (isset($_POST["login"])) {
	if ($user->verifyPassword($_POST["login"], $_POST["password"])) {
		$_SESSION["userUID"] = $user->getUID($_POST["login"]);
		header("Location: /");
	} else {
		$errorLoginMessage = "Ces identifiants sont incorrects.";
	}
}
