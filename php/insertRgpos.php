<?php
	include_once '../classes/Database.php';
	$headers = getallheaders();
	
	$valid = true;
	@$rechnungID = $headers['rechnungID'];
	if (@$rechnungID == null) {
		echo "Error: no rechnungID given.\n";
		$valid = false;
	}
	
	if ($valid) {
		$sql = "SELECT MAX(id) + 1 FROM rechnungsposition";
		$nextid = $db -> fetch_array( $db -> query($sql) );
		$sql = "INSERT INTO rechnungsposition (id, rechnung_id, anzahl) VALUES (" . $nextid[0] . ", " . $rechnungID . ", 1)";
		echo ( $db -> query($sql) == "1" ) ? $nextid[0] : "";
	}
?>