<?php

function addProject($file, $project) {
	$file = array_merge($file, $project);
	file_put_contents("data/project.json", json_encode($file, JSON_PRETTY_PRINT));
}
