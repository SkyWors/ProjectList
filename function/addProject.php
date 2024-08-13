<?php

function addProject($file, $project, $selectedFile) {
	$file = array_merge($file, $project);
	file_put_contents("data/" . $selectedFile, json_encode($file, JSON_PRETTY_PRINT));
}
