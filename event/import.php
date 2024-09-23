<?php

if (isset($_FILES["import"]) && $_FILES["import"]['error'] == 0) {
	if (in_array($_FILES["import"]['type'], ['json' => 'application/json'])) {
		$fileContent = file_get_contents($_FILES["import"]['tmp_name']);
		$fileElement = json_decode($fileContent, true);

		$projectsId = $project->getProjects($_SESSION["userUID"], $selectedProfile);
		if (!empty($projectsId)) {
			foreach ($projectsId as $uid) {
				$project->deleteProject($uid["uid"]);
			}
		}

		foreach ($fileElement as $key => $element) {
			$properties = array(
				"name" => $key,
				"path" => $element["path"],
				"description" => $element["description"],
				"url" => $element["url"],
				"language" => join(" ", $element["language"]),
				"tag" => join(" ", $element["tag"]),

				"vscode" => $element["vscode"],
				"idea" => $element["idea"],
				"github" => $element["github"],
				"gitlab" => $element["gitlab"],
			);

			$project->addProject($_SESSION["userUID"], $selectedProfile, $properties);
		}
	}
	header("Refresh: 0");
}
