<?php

function createItem($project) {
	$name = $project["name"];

	$box = "<div class='box item column'>";

	$box .= "<div class='row'>";

	if ($project["url"] != "") {
		$box .= "<a class='itemName' id='itemName' title='" . $name . "' data-id='" . $name . "' href='" . $project["url"] . "' target='_blank'><i class='ri-external-link-line'></i> " . $name . "</a>";
	} else {
		$box .= "<a class='itemName' title='" . $name . "' id='itemName'>" . $name . "</a>";
	}

	$box .= "<div class='badgeContainer'>";

	$box .= "<a class='language' data-id='" . $name . "' title='" . $project["language"] . "'><i class='ri-global-line'></i></a>";
	$box .= "<a class='badge' data-id='" . $name . "' title='" . $project["tag"] . "'><i class='ri-bookmark-line'></i></a>";

	$box .= "</div>";

	$box .= "</div>";
	$box .= "<div class='description' data-id='" . $name . "' title='" . $project["description"] . "'><a>" . $project["description"] . "</a></div>";

	$box .= "<div class='buttonContainer row'>";

	if ($project["vscode"] != false) {
		$box .= vscodeButton($project["path"], $name);
	}
	if ($project["idea"] != false) {
		$box .= ideaButton($project["path"], $name);
	}
	if ($project["github"] != false) {
		$box .= githubButton($project["github"], $name);
	}
	if ($project["gitlab"] != false) {
		$box .= gitlabButton($project["gitlab"], $name);
	}

	$box .= "</div>";

	$box .= "<div class='actionButtonContainer row'>";

	if ($project["path"] != "") {
		$date = getLastUpdated($project["path"]);
		if ($date["tm_year"] != 70) {
			$box .= "<button class='simpleButton lastUpdateDate' title='" . $date["tm_hour"] . "h " . $date["tm_min"] . "m " . $date["tm_sec"] . "s | " . $date["tm_mday"] . " " . date('F', mktime(0, 0, 0, $date["tm_mon"] + 1, 10)) . " " . 1900 + $date["tm_year"] . "'><i class='ri-time-line'></i></button>";
		}
	}

	if ($project['path']) {
		$box .= "<button class='simpleButton copyButton' data-id='" . $name . "' id='copyButton' value='" . $project['path'] . "' title='Copier le chemin'><i class='ri-link'></i></button>";
	}

	$box .= "
	<button class='simpleButton editButton' id='editButton' value='$name' title='Modifier'><i class='ri-pencil-line'></i></button>
	<form method='POST' class='actionForm row'>
		<button class='simpleButton deleteButton' type='submit' name='deleteItem' value='$name' onclick='return confirmForm()' title='Supprimer'><i class='ri-delete-bin-line'></i></button>
	</form>";

	$box .= "</div>";
	$box .= "</div>";

	return $box;
}
