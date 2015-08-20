<?php
	include_once '../classes/Database.php';
	
	$headers = getallheaders();
	$valid = true;
	
	if ( !(@$kundeID = $headers['kundeID']) ) {
		echo "ERROR: No kundeID given.<br>";
		$valid = false;
	}
	
	if ($valid) {
		$heute = date('Y-m-d');
		$gestern = date('Y-m-d', strtotime('-1 day'));
		$sql = "UPDATE adresse SET gueltig_bis = \"" . $gestern . "\" WHERE kunde_id = " . $kundeID . " AND gueltig_bis >= " . $heute;
		$res = $db -> query($sql);
		echo $res;
	}
	
?>