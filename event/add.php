<?php

if (isset($_POST["add"])) {
	$description = $_POST["description"] ?? "";
	$path = $_POST["path"] ?? "";
	$url = $_POST["url"] ?? "";
	$github = $_POST["github"] ?? "";
	$gitlab = $_POST["gitlab"] ?? "";
	$vscode = $_POST["vscode"] ?? false;
	$idea = $_POST["idea"] ?? false;

	while (substr($_POST["language"], -1) == " ") {
		$_POST["language"] = substr($_POST["language"], 0, -1);
	}
	while (substr($_POST["badge"], -1) == " ") {
		$_POST["badge"] = substr($_POST["badge"], 0, -1);
	}

	$properties = array(
		"name" => str_replace(" ", "", $_POST["name"]),
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

	$project->addProject($_SESSION["userData"]["oauth_uid"], $selectedProfile, $properties);
	header("Refresh: 0");
}
