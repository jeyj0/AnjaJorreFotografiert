<?php header("Content-Type: text/html; charset=ISO-8859-1");
	include_once '../classes/Database.php';
	
	$erreichbars = $db -> fetch_all_array("SELECT id, bezeichnung FROM erreichbar WHERE geloescht != 1");
	foreach ($erreichbars as $erreichbar) {
		echo "<option value=\"" . $erreichbar['id'] . "\" " . ($telefon['erreichbar_id'] == $erreichbar['id'] ? "selected" : "") . ">" . $erreichbar['bezeichnung'] . "</option>";
	}
?>