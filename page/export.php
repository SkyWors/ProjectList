<?php

use
	ProjectList\Project;

$projects = array();

$project = new Project();
$projectsId = $project->getProjects($_SESSION["userUID"], $_GET["profile"]);
if (!empty($projectsId)) {
	foreach ($projectsId as $uid) {
		$properties = $project->getProperties($uid["uid"]);

		$formattedProject = array(
			"path" => $properties["path"],
			"description" => $properties["description"],
			"url" => $properties["url"],
			"vscode" => $properties["vscode"] == 1 ? true : false,
			"idea" => $properties["idea"] == 1 ? true : false,
			"github" => $properties["github"],
			"gitlab" => $properties["gitlab"],
			"language" => array($properties["language"]),
			"tag" => explode(" ", $properties["tag"])
		);

		$projects[$properties["name"]] = $formattedProject;
	}
}

$jsonData = json_encode($projects);

header('Content-Type: application/json');
header('Content-Disposition: attachment; filename="' . $_GET["profile"] . '.json"');

echo $jsonData;
exit;
