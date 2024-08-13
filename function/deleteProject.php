<?php

function deleteProject($file, $project, $selectedFile) {
	foreach($file as $name => $properties) {
		if ($name == $project) {
			unset($file[$name]);
		}
	}
	file_put_contents("data/" . $selectedFile, json_encode($file, JSON_PRETTY_PRINT));
}
