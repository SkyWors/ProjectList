<?php

if (isset($_POST["deleteItem"])) {
	deleteProject($file, $_POST["deleteItem"], $selectedFile);
	header("Refresh: 0");
}
