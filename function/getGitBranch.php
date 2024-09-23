<?php

function getGitBranch() {
	$fname = sprintf( '.git/HEAD' );
	$data = file_get_contents($fname);
	$ar  = explode( "/", $data );
	$ar = array_reverse($ar);
	return  trim ("" . @$ar[0]);
}

