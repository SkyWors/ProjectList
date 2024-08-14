<?php

function getArrowProfil($list, $selectedFile) {
	$tempIndex = (int)array_search($selectedFile, $list);

	if (isset($list[$tempIndex - 1])) {
		$previousProfil = $list[$tempIndex - 1];
	} else {
		$previousProfil = $list[array_key_last($list)];
	}
	if (isset($list[$tempIndex + 1])) {
		$nextProfil = $list[$tempIndex + 1];
	} else {
		$nextProfil = $list[array_key_first($list)];
	}

	$previousProfil = str_replace(".json", "", $previousProfil);
	$nextProfil = str_replace(".json", "", $nextProfil);

	if ($previousProfil != $selectedFile)
		echo "<button class='simpleButton arrowButton' id='switchProfil' title='" . $previousProfil . "' value='" . $previousProfil . "'><i class='ri-arrow-left-double-line'></i></button>";
	if ($nextProfil != $selectedFile)
		echo "<button class='simpleButton arrowButton' id='switchProfil' title='" . $nextProfil . "' value='" . $nextProfil . "'><i class='ri-arrow-right-double-line'></i></button>";
}
