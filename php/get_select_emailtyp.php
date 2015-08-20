<?php header("Content-Type: text/html; charset=ISO-8859-1");
	include_once '../classes/Database.php';
	
	$typen = $db -> fetch_all_array("SELECT id, bezeichnung FROM emailtyp WHERE geloescht != 1");
	
	foreach ($typen as $typ) {
		echo "<option value=\"" . $typ['id'] . "\" " . ($mail['emailtyp_id'] == $typ['id'] ? "selected" : "") . ">" . $typ['bezeichnung'] . "</option>";
	}
?>