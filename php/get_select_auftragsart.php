<?php header("Content-Type: text/html; charset=ISO-8859-1");
include_once '../classes/Database.php';

$auftragsarten = $db -> fetch_all_array("SELECT id, bezeichnung FROM auftragsart WHERE geloescht != 1");

foreach ($auftragsarten as $auftragsart) {
	echo "<option value=\"" . $auftragsart['id'] . "\">" . $auftragsart['bezeichnung'] . "</option>";
}
?>