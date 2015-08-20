<?php
	include_once '../classes/Database.php';
	
	$valid = true;
	
	if ( !(@$gueltigBis = $_GET['gueltigBis']) ) {
		echo "ERROR: No gueltigBis given.<br>";
		$valid = false;
	}
	
	if ( !(@$adressID = $_GET['adressID']) ) {
		echo "ERROR: No adressID given.<br>";
		$valid = false;
	}
	
	if ($valid) {
		$sql = "UPDATE adresse SET gueltig_bis = \"" . $gueltigBis . "\" WHERE id = " . $adressID;
		$res = $db -> query($sql);
		echo $res;
	}
	
?>