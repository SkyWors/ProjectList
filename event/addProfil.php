<?php

if (isset($_POST["profilAddName"])) {
	$project->addProfile($_SESSION["userData"]["oauth_uid"], $_POST["profilAddName"]);
	header("Location: ?profile=" . $_POST["profilAddName"]);
}
