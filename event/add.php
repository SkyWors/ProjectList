<?php

if (isset($_POST["add"])) {
	$description = $_POST["description"] ?? "";
	$path = $_POST["path"] ?? "";
	$url = $_POST["url"] ?? "";
	$github = $_POST["github"] ?? "";
	$gitlab = $_POST["gitlab"] ?? "";
	$checkbox = $_POST["edit"] ?? false;
	$idea = $_POST["idea"] ?? false;

	while (substr($_POST["language"], -1) == " ") {
		$_POST["language"] = substr($_POST["language"], 0, -1);
	}
	while (substr($_POST["badge"], -1) == " ") {
		$_POST["badge"] = substr($_POST["badge"], 0, -1);
	}

	$temp = array(str_replace(" ", "", $_POST["name"])
		=> array(
			"path" => $path,
			"edit" => $checkbox,
			"description" => $description,
			"url" => $url,
			"idea" => $idea,
			"github" => $github,
			"gitlab" => $gitlab,
			"language" => explode(" ", $_POST["language"]),
			"badge" => explode(" ", $_POST["badge"])
		));

	addProject($file, $temp, $selectedFile);
	header("Refresh: 0");
}
