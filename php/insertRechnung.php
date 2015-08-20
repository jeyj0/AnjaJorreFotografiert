<?php
	include_once '../classes/Database.php';
	$headers = getallheaders();
	
	$valid = true;
	@$nachbestellung = $headers['nachbestellung'];
	@$datum = $headers['datum'];
	@$auftragID = $headers['auftragID'];
	if (@$auftragID == null) {
		echo "Error: no auftragID given.\n";
		$valid = false;
	}
	if (@$datum == null) {
		echo "Error: no datum given.\n";
		$valid = false;
	}
	
	if ($valid) {
		//$sql = "SELECT MAX(r.rechnungsnummer) FROM rechnung r INNER JOIN auftrag a WHERE year(r.datum) = " . substr($datum, 0, $length = 4);
		//		SELECT coalesce(MAX(r.rechnungsnummer), 15000) 									  FROM rechnung r WHERE year(r.datum) = 2015 									and left(r.rechnungsnummer, 2) = 15
	
		$sql = "SELECT coalesce(MAX(r.rechnungsnummer)," . substr($datum, 2, $length = 2) . "000) FROM rechnung r WHERE year(r.datum) = " . substr($datum, 0, $length = 4) . " and left(r.rechnungsnummer, 2) = " . substr($datum, 2, $length = 2);
		$rgnr = $db -> fetch_array( $db -> query($sql) );
		$rgnr = substr($rgnr[0], 0, $length = 2) . (substr($rgnr[0], 2, $length = 3) + 1);
		while (strlen($rgnr) != 5) {
			$rgnr = substr($rgnr, 0, $length = 2) . "0" . substr($rgnr, 2, $length = strlen($rgnr) - 2);
		}
		
		$sql = "SELECT MAX(id) + 1 FROM rechnung";
		$nextid = $db -> fetch_array( $db -> query($sql) );
		$sql = "INSERT INTO rechnung (id, rechnungsnummer, auftrag_id, datum, nachbestellung) VALUES (" . $nextid[0] . ", \"" . $rgnr . "\", " . $auftragID . ", \"" . $datum . "\", " . $nachbestellung . ")";
		echo ( $db -> query($sql) == "1" ) ? $nextid[0] : "";
	}
?>