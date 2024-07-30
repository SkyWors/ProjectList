<?php

function createItem($name, $properties, $languages, $filter) {
	$box = "<div class='box item column'><div class='row'>";

	if ($properties["url"] != "") {
		$box .= "<a class='itemName' id='itemName' title='" . $properties["description"] . "' href='" . $properties["url"] . "' target='_blank'><i class='ri-external-link-line'></i> " . $name . "</a>";
	} else {
		$box .= "<a class='itemName' id='itemName' title='" . $properties["description"] . "'>" . $name . "</a>";
	}

	$box .= "
	<button class='copyButton' id='copyButton' value='" . $properties['path'] . "' title='Copier le chemin'><i class='ri-link'></i></button>
	<button class='editButton' id='editButton' value='$name' title='Modifier'><i class='ri-pencil-line'></i></button>
	<form method='POST' class='actionForm row'>
		<button class='deleteButton' type='submit' name='deleteItem' value='$name' onclick='return confirmForm()' title='Supprimer'><i class='ri-delete-bin-line'></i></button>
	</form>";
	$box .= "</div>";

	$box .= "<div class='buttonContainer'>";

	if ($properties["edit"] == true) {
		$box .= vscodeButton($properties["path"], $name);
	}
	if ($properties["github"] != "") {
		$box .= githubButton($properties["github"], $name);
	}
	if ($properties["gitlab"] != "") {
		$box .= gitlabButton($properties["gitlab"], $name);
	}

	$box .= "</div><div class='badgeContainer'>";

	$tempBadgeList = "";
	foreach ($properties["badge"] as $badge) {
		$tempBadgeList .= $badge . " ";
	}
	$tempLanguageList = "";
	foreach ($properties["language"] as $language) {
		$tempLanguageList .= $language . " ";
	}
	$box .= "<a class='badge' data-id='" . $name . "' title='" . $tempBadgeList . "'>Tags</a>";
	$box .= "<a class='language' data-id='" . $name . "' title='" . $tempLanguageList . "'>Langages</a>";


	$box .= "</div></div>";

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
