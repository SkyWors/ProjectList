<?php

if (!file_exists("data/")) {
	mkdir("data/", 0777, true);
}

if (!file_exists("data/project.json")) {
	fopen("data/project.json", "a");
	file_put_contents("data/project.json", "{}");
	chmod("data/project.json", 0777);
}

$file = json_decode(file_get_contents("data/project.json"), true);
ksort($file);
