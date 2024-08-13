<?php

if (isset($_POST["profilDeleteName"])) {
	$updateFile = "data/" . $_POST["profilDeleteName"] . ".json";
	if (file_exists($updateFile)) {
		unlink($updateFile);
	}
	header("Location: /");
}
