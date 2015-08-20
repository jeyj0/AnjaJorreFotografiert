<?php header("Content-Type: text/html; charset=ISO-8859-1");
include_once '../classes/Database.php';

$id = $_GET['id'];

$rgn = $db -> fetch_all_array("SELECT r.id, r.rechnungsnummer rgnr, r.nachbestellung nach FROM rechnung r WHERE r.geloescht != 1 AND r.auftrag_id = " . $id);

foreach ($rgn as $c_rgn) {
	echo "<option value=\"" . $c_rgn['id'] . "\">" . $c_rgn['rgnr'] . ($c_rgn['nach'] ? " (Nachbestellung)" : "") . "</option>";
}
?>