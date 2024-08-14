<?php

if (isset($_POST["profilUpdateName"])) {
	$updateFile = "data/" . $_POST["profilUpdateName"] . ".json";
	if (file_exists($updateFile)) {
		rename("data/" . $_POST["profilUpdateName"] . ".json", "data/" . $_POST["profilUpdateNewName"] . ".json");
	}
	if ($_GET["profil"] == $_POST["profilUpdateName"]) {
		header("Location: /?profil=" . $_POST["profilUpdateNewName"]);
	}
}
