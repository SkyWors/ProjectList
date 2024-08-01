<?php

function createItem($name, $properties, $languages, $filter) {
	$box = "<div class='box item column'>";

	$box .= "<div class='row'>";

	if ($properties["url"] != "") {
		$box .= "<a class='itemName' id='itemName' data-id='" . $name . "' href='" . $properties["url"] . "' target='_blank'><i class='ri-external-link-line'></i> " . $name . "</a>";
	} else {
		$box .= "<a class='itemName' id='itemName'>" . $name . "</a>";
	}

	$box .= "<div class='badgeContainer'>";

	$tempBadgeList = "";
	foreach ($properties["badge"] as $badge) {
		$tempBadgeList .= $badge . " ";
	}
	$tempLanguageList = "";
	foreach ($properties["language"] as $language) {
		$tempLanguageList .= $language . " ";
	}
	$box .= "<a class='language' data-id='" . $name . "' title='" . $tempLanguageList . "'><i class='ri-global-line'></i></a>";
	$box .= "<a class='badge' data-id='" . $name . "' title='" . $tempBadgeList . "'><i class='ri-bookmark-line'></i></a>";

	$box .= "</div>";

	$box .= "</div>";
	$box .= "<div class='description' data-id='" . $name . "' title='" . $properties["description"] . "'><a>" . $properties["description"] . "</a></div>";

	$box .= "<div class='buttonContainer row'>";

	if ($properties["edit"] == true) {
		$box .= vscodeButton($properties["path"], $name);
	}
	if ($properties["idea"] == true) {
		$box .= ideaButton($properties["path"], $name);
	}
	if ($properties["github"] != "") {
		$box .= githubButton($properties["github"], $name);
	}
	if ($properties["gitlab"] != "") {
		$box .= gitlabButton($properties["gitlab"], $name);
	}

	$box .= "</div>";

	$box .= "<div class='actionButtonContainer row'>";

	$date = localtime(@filemtime($properties["path"]), true);
	if ($date["tm_year"] != 70) {
		$box .= "<button class='lastUpdateDate' title='" . $date["tm_hour"] . "h " . $date["tm_min"] . "m " . $date["tm_sec"] . "s | " . $date["tm_mday"] . " " . date('F', mktime(0, 0, 0, $date["tm_mon"] + 1, 10)) . " " . 1900 + $date["tm_year"] . "'><i class='ri-time-line'></i></button>";
	}

	if ($properties['path']) {
		$box .= "<button class='copyButton' data-id='" . $name . "' id='copyButton' value='" . $properties['path'] . "' title='Copier le chemin'><i class='ri-link'></i></button>";
	}

	$box .= "
	<button class='editButton' id='editButton' value='$name' title='Modifier'><i class='ri-pencil-line'></i></button>
	<form method='POST' class='actionForm row'>
		<button class='deleteButton' type='submit' name='deleteItem' value='$name' onclick='return confirmForm()' title='Supprimer'><i class='ri-delete-bin-line'></i></button>
	</form>";

	$box .= "</div>";
	$box .= "</div>";

	$projectFilters = array_merge($properties["language"], $properties["badge"]);
	$getFilters = array_merge($languages, $filter);

	if (array_intersect($getFilters, $projectFilters) == $getFilters) {
		return $box;
	} else {
		if (empty($_GET["language"]) && empty($_GET["filter"])) {
			return $box;
		}
	}
}
