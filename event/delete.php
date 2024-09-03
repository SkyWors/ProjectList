<?php

if (isset($_POST["deleteItem"])) {
	$project->deleteProject($_SESSION["userUID"], $selectedProfile, $_POST["deleteItem"]);
	header("Refresh: 0");
}
