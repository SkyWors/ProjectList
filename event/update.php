<?php

if (isset($_POST["update"])) {
	$description = $_POST["description"] ?? "";
	$url = $_POST["url"] ?? "";
	$github = $_POST["github"] ?? "";
	$gitlab = $_POST["gitlab"] ?? "";
	$checkbox = $_POST["edit"] ?? false;

	while (substr($_POST["language"], -1) == " ") {
		$_POST["language"] = substr($_POST["language"], 0, -1);
	}
	while (substr($_POST["badge"], -1) == " ") {
		$_POST["badge"] = substr($_POST["badge"], 0, -1);
	}

	$temp = array($_POST["name"]
		=> array(
			"path" => $_POST["path"],
			"edit" => $checkbox,
			"description" => $description,
			"url" => $url,
			"github" => $github,
			"gitlab" => $gitlab,
			"language" => explode(" ", $_POST["language"]),
			"badge" => explode(" ", $_POST["badge"])
		));

	deleteProject($file, $_POST["update"]);
	$file = json_decode(file_get_contents("data/project.json"), true);
	addProject($file, $temp);
	header("Refresh: 0");
}
