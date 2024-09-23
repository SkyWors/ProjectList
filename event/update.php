<?php

if (isset($_POST["update"])) {
	$description = $_POST["description"] ?? "";
	$path = $_POST["path"] ?? "";
	$url = $_POST["url"] ?? "";
	$github = $_POST["github"] ?? "";
	$gitlab = $_POST["gitlab"] ?? "";
	isset($_POST["vscode"]) && $_POST["vscode"] == true ? $vscode = true : $vscode = false;
	isset($_POST["idea"]) && $_POST["idea"] == true ? $idea = true : $idea = false;

	while (substr($_POST["language"], -1) == " ") {
		$_POST["language"] = substr($_POST["language"], 0, -1);
	}
	while (substr($_POST["badge"], -1) == " ") {
		$_POST["badge"] = substr($_POST["badge"], 0, -1);
	}

	$properties = array(
		"oldname" => $_POST["update"],
		"name" => $_POST["name"],
		"path" => $path,
		"description" => $description,
		"url" => $url,
		"language" => $_POST["language"],
		"tag" => $_POST["badge"],
		"github" => $github,
		"gitlab" => $gitlab,
		"vscode" => $vscode,
		"idea" => $idea
	);

	$project->updateProject($_SESSION["userUID"], $selectedProfile, $properties);
	header("Refresh: 0");
}
