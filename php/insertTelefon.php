<?php
	include_once '../classes/Database.php';
	$headers = getallheaders();
	
	$valid = true;
	@$kundeID = $headers['kundeID'];
	if (@$kundeID == null) {
		echo "Error: no kundeID given.\n";
		$valid = false;
	}
	
	if ($valid) {
		$sql = "SELECT MAX(id) + 1 FROM telefon";
		$nextid = $db -> fetch_array( $db -> query($sql) );
		$sql = "INSERT INTO telefon (id, kunde_id, erreichbar_id) VALUES (" . $nextid[0] . ", " . $kundeID . ", 1)";
		echo ( $db -> query($sql) == "1" ) ? $nextid[0] : "";
	}
?>