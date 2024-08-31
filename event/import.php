<?php

if (isset($_FILES["import"]) && $_FILES["import"]['error'] == 0) {
	if (in_array($_FILES["import"]['type'], ['json' => 'application/json'])) {
		$fileContent = file_get_contents($_FILES["import"]['tmp_name']);
		$fileElement = json_decode($fileContent, true);

		foreach ($fileElement as $key => $element) {
			$properties = array(
				"name" => $key,
				"description" => $element["description"],
				"path" => $element["path"],
				"url" => $element["url"],
				"language" => join(" ", $element["language"]),
				"tag" => join(" ", $element["tag"]),

				"github" => $element["github"],
				"gitlab" => $element["gitlab"],
				"vscode" => $element["vscode"],
				"idea" => $element["idea"],
			);

			$project->addProject($_SESSION["userData"]["oauth_uid"], $selectedProfile, $properties);
		}
	}
	header("Refresh: 0");
}
