<?php

if (isset($_POST["profilAddName"])) {
	$project->addProfile($_SESSION["userUID"], $_POST["profilAddName"]);
	header("Location: ?profile=" . $_POST["profilAddName"]);
}
