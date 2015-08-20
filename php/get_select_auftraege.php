<?php header("Content-Type: text/html; charset=ISO-8859-1");
include_once '../classes/Database.php';

$id = $_GET['id'];

$auftraege = $db -> fetch_all_array("SELECT id, datum FROM auftrag WHERE kunde_id = " . $id);

foreach ($auftraege as $auftrag) {
	echo "<option value=\"" . $auftrag['id'] . "\">" . $auftrag['datum'] . "</option>";
}
?>