<?php
	include_once '../classes/Database.php';
	$headers = getallheaders();
	
	$valid = true;
	@$anredeID = $headers['anredeID'];
	@$firstName = $headers['firstName'];
	@$lastName = $headers['lastName'];
	if (@$anredeID == null) {
		echo "Error: no anredeID given.\n";
		$valid = false;
	}
	if (@$lastName == null) {
		echo "Error: no lastName given.\n";
		$valid = false;
	}
	
	if ($valid) {
		$sql = "SELECT MAX(id) + 1 FROM kunde";
		$nextid = $db -> fetch_array( $db -> query($sql) );
		$sql = "INSERT INTO kunde (id, anrede_id, vorname, name) VALUES (" . $nextid[0] . ", " . $anredeID . ", \"" . $firstName . "\", \"" . $lastName . "\")";
		echo ( $db -> query($sql) == "1" ) ? $nextid[0] : "";
	}
?>