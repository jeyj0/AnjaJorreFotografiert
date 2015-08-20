<?php header("Content-Type: text/html; charset=ISO-8859-1");
include_once '../classes/Database.php';

$anreden = $db -> fetch_all_array("SELECT id, bezeichnung FROM anrede");

foreach ($anreden as $anrede) {
	echo "<option value=\"" . $anrede['id'] . "\">" . $anrede['bezeichnung'] . "</option>";
}
?>