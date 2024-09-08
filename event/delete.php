<?php

if (isset($_POST["deleteItem"])) {
	$project->deleteProject($project->getProject($_SESSION["userUID"], $selectedProfile, $_POST["deleteItem"]));
	header("Refresh: 0");
}
