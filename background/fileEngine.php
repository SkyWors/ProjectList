<?php

if (!file_exists("data/")) {
	mkdir("data/", 0777, true);
}

if (count(array_diff(scandir("data/"), array('.', '..'))) <= 0) {
	fopen("data/Default.json", "a");
	file_put_contents("data/Default.json", "{}");
	chmod("data/Default.json", 0777);
}

if (isset($_GET["profil"]) && file_exists("data/" . $_GET["profil"] . ".json")) {
	$selectedFile = $_GET["profil"] . ".json";
} else {
	$selectedFile = array_values(array_diff(scandir("data/"), array('.', '..')))[0];
}

$file = json_decode(file_get_contents("data/$selectedFile"), true);
ksort($file);

$tempList = array_diff(scandir("data/"), array('.', '..'));
$projectList = array();
foreach ($tempList as $project) {
	array_push($projectList, $project);
}
