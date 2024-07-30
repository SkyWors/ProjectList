<?php

if (isset($_GET["filter"])) {
	$filter = explode(",", $_GET["filter"]);
} else {
	$filter = array();
}
if (isset($_GET["language"])) {
	$languages = explode(",", $_GET["language"]);
} else {
	$languages = array();
}

$badgeList = array();
foreach($file as $name => $properties) {
	foreach($properties["badge"] as $badge) {
		if (!in_array($badge, $badgeList)) {
			array_push($badgeList, $badge);
		}
	}
}
$languageList = array();
foreach($file as $name => $properties) {
	foreach($properties["language"] as $language) {
		if (!in_array($language, $languageList)) {
			array_push($languageList, $language);
		}
	}
}

sort($badgeList);
sort($languageList);
