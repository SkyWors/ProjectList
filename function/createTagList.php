<?php

function createTagList($badgeList, $languageList, $filter, $languages) {
	$list = "<div class='box filterContainer column'><a>Tags</a><div class='badgeList'>";

	foreach($badgeList as $badge) {
		$list .= "<div id='filter'>";

		if (isset($_GET["filter"]) && in_array($badge, $filter)) {
			$list .= "<input type='checkbox' checked><label>" . $badge . "</label>";
		} else {
			$list .= "<input type='checkbox'><label>" . $badge . "</label>";
		}

		$list .= "</div>";
	}
	$list .= "</div>";

	$list .= "<a>Languages</a><div class='languageList'>";

	foreach($languageList as $language) {
		$list .= "<div id='language'>";

		if (isset($_GET["language"]) && in_array($language, $languages)) {
			$list .= "<input type='checkbox' checked><label>" . $language . "</label>";
		} else {
			$list .= "<input type='checkbox'><label>" . $language . "</label>";
		}
		
		$list .= "</div>";
	}
	$list .= "</div></div>";

	return $list;
}
