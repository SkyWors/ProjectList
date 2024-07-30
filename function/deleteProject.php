<?php

function deleteProject($file, $project) {
	foreach($file as $name => $properties) {
		if ($name == $project) {
			unset($file[$name]);
		}
	}
	file_put_contents("data/project.json", json_encode($file, JSON_PRETTY_PRINT));
}
