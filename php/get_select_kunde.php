<?php header("Content-Type: text/html; charset=ISO-8859-1");
include_once '../classes/Database.php';

$kunden = $db -> fetch_all_array("SELECT k.name, k.vorname, k.id FROM kunde k WHERE k.geloescht != 1 ORDER BY lower(k.name), lower(k.vorname)");

foreach ($kunden as $kunde) {
	echo '<option value="' . $kunde['id'] . '">' . $kunde['name'] . ($kunde['vorname'] != '' ? (', ' . $kunde['vorname']) : "") . '</option>';
}
?>