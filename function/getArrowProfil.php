<?php

function getArrowProfil($list, $selectedProfile) {
	$tempIndex = (int)array_search($selectedProfile, $list);

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

	if ($previousProfil != $selectedProfile) {
		echo "<button class='simpleButton arrowButton' id='switchProfil' title='" . $previousProfil . "' value='" . $previousProfil . "'><i class='ri-arrow-left-double-line'></i></button>";
	}
	if ($nextProfil != $selectedProfile) {
		echo "<button class='simpleButton arrowButton' id='switchProfil' title='" . $nextProfil . "' value='" . $nextProfil . "'><i class='ri-arrow-right-double-line'></i></button>";
	}
}
