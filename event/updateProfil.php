<?php

if (isset($_POST["profilUpdateName"])) {
	$project->updateProfile($_SESSION["userUID"], $_POST["profilUpdateName"], $_POST["profilUpdateNewName"]);

	if (isset($_GET["profile"]) && $_GET["profile"] == $_POST["profilUpdateName"]) {
		header("Location: /?profile=" . $_POST["profilUpdateNewName"]);
	} else {
		header("Location: /");
	}
}
