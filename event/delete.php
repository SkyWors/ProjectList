<?php

if (isset($_POST["deleteItem"])) {
	$project->deleteProject($_SESSION["userData"]["oauth_uid"], $selectedProfile, $_POST["deleteItem"]);
	header("Refresh: 0");
}
