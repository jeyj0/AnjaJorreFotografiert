<?php
	include_once '../classes/Database.php';
	
	$valid = true;
	$headers = getallheaders();
	
	if ( !($gueltigAb = $headers['gueltigAb']) ) {
		echo "ERROR: No gueltigAb given.";
		$valid = false;
	}
	
	if ( !($gueltigBis = $headers['gueltigBis']) ) {
		echo "ERROR: No gueltigBis given.";
		$valid = false;
	}
	
	if ( !($kundeID = $headers['kundeID']) ) {
		echo "ERROR: No kundeID given.";
		$valid = false;
	}
	
	if ($valid) {
		$sql = "SELECT MAX(id) + 1 FROM adresse";
		$nextID = $db -> fetch_array( $db -> query($sql) );
		$sql = "INSERT INTO adresse (id, kunde_id, gueltig_ab, gueltig_bis, land) VALUES (" . $nextID[0] . ", " . $kundeID . ", \"" . $gueltigAb . "\", \"" . $gueltigBis . "\", \"Deutschland\")";
		$res = $db -> query($sql);
		
		if ($res == "1") {
			echo $nextID[0];
			
			if (@$headers['lastAdressID'] != null) {
				$befGueltigBis = date("Y-m-d", strtotime($gueltigAb . "-1 day"));
				$befAdressID = $headers['lastAdressID'];
				
				$args = array("gueltigBis"=>$befGueltigBis, "adressID"=>$befAdressID);
				$httpargs = http_build_query($args);
				// yes, very complicated...
				$url = "http://" . $_SERVER['HTTP_HOST'] . substr($_SERVER['REQUEST_URI'], 0, strlen($_SERVER['REQUEST_URI']) - strlen(__FILE__)) . 'update_adresseGueltigBis.php?' . $httpargs;
				$fhttp = fopen($url, 'r');
				fclose($fhttp);
			}
		}
	}
?>