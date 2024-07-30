<?php

if (isset($_POST["deleteItem"])) {
	deleteProject($file, $_POST["deleteItem"]);
	header("Refresh: 0");
}
