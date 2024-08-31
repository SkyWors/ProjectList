<?php

function createFilterList($languages, $tags, $selectedLanguages, $selectedTags) {
	$list = "<div class='box filterContainer column'><a class='tagListTitle'><i class='ri-bookmark-line'></i> Tags</a><div class='badgeList'>";

	// Import tags in filter list
	foreach($tags as $element) {
		$list .= "<div id='filter'>";

		if (isset($selectedTags) && in_array($element, $selectedTags)) {
			$list .= "<input type='checkbox' checked><label>" . $element . "</label>";
		} else {
			$list .= "<input type='checkbox'><label>" . $element . "</label>";
		}

		$list .= "</div>";
	}
	$list .= "</div>";

	$list .= "<a class='tagListTitle'><i class='ri-global-line'></i> Langages</a><div class='languageList'>";

	// Import languages in filter list
	foreach($languages as $element) {
		$list .= "<div id='language'>";

		if (isset($selectedLanguages) && in_array($element, $selectedLanguages)) {
			$list .= "<input type='checkbox' checked><label>" . $element . "</label>";
		} else {
			$list .= "<input type='checkbox'><label>" . $element . "</label>";
		}

		$list .= "</div>";
	}
	$list .= "</div></div>";

	return $list;
}
