<?php
	include_once '../classes/Database.php';
	$headers = getallheaders();
	
	$valid = true;
	@$artID = $headers['artID'];
	@$datum = $headers['datum'];
	@$kundeID = $headers['kundeID'];
	if (@$artID == null) {
		echo "Error: no artID given.\n";
		$valid = false;
	}
	if (@$datum == null) {
		echo "Error: no datum given.\n";
		$valid = false;
	}
	if (@$kundeID == null) {
		echo "Error: no kundeID given.\n";
		$valid = false;
	}
	
	if ($valid) {
		$sql = "SELECT MAX(id) + 1 FROM auftrag";
		$nextid = $db -> fetch_array( $db -> query($sql) );
		$sql = "INSERT INTO auftrag (id, kunde_id, auftragsart_id, datum) VALUES (" . $nextid[0] . ", " . $kundeID . ", " . $artID . ", \"" . $datum . "\")";
		echo ( $db -> query($sql) == "1" ) ? $nextid[0] : "";
	}
?>