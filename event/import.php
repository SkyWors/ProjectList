<?php

if (isset($_FILES["import"]) && $_FILES["import"]['error'] == 0) {
	if (in_array($_FILES["import"]['type'], ['json' => 'application/json'])) {
		move_uploaded_file($_FILES["import"]['tmp_name'], "data/" . $selectedFile);
	}
	header("Refresh: 0");
}
