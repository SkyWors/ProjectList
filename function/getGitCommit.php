<?php

function getGitCommit() {
	$path = sprintf('.git/');
	$head = trim(substr(file_get_contents($path . 'HEAD'), 4));
	$hash = trim(file_get_contents(sprintf($path . $head)));
	return $hash;
}
