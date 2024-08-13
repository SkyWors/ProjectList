<?php

if (isset($_POST["profilAddName"])) {
	$newFile = "data/" . $_POST["profilAddName"] . ".json";
	if (!file_exists($newFile)) {
		fopen($newFile, "a");
		file_put_contents($newFile, "{}");
		chmod($newFile, 0777);
	}
	header("Location: ?profil=" . $_POST["profilAddName"]);
}
