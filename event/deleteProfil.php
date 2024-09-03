<?php

if (isset($_POST["profilDeleteName"])) {
	$project->deleteProfile($_SESSION["userUID"], $_POST["profilDeleteName"]);
	header("Location: /");
}
