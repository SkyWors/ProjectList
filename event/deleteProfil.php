<?php

if (isset($_POST["profilDeleteName"])) {
	$project->deleteProfile($_SESSION["userData"]["oauth_uid"], $_POST["profilDeleteName"]);
	header("Location: /");
}
