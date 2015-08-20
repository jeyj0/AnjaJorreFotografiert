<?php header("Content-Type: text/html; charset=ISO-8859-1");
include_once '../classes/Database.php';

$id = $_GET['id'];

$erreichbars = $db -> fetch_all_array("SELECT id, bezeichnung FROM erreichbar WHERE geloescht != 1");
$telefons = $db -> fetch_all_array("SELECT t.id, t.telefonnummer nummer, t.erreichbar_id FROM kunde k INNER JOIN telefon t ON k.id = t.kunde_id WHERE t.geloescht != 1 AND k.id = " . $id);

foreach ($telefons as $telefon) {
	echo "<div class=\"div_telefonnummer\" telid=\"" . $telefon['id'] . "\">";
	echo "<input type=\"tel\" class=\"input_telefonnummer\" value=\"" . $telefon['nummer'] . "\" onblur=\"onValueChange(this)\" table=\"telefon\" field=\"telefonnummer\" />";
	echo "<select class=\"select_erreichbar\" onblur=\"onValueChange(this)\" table=\"telefon\" field=\"erreichbar_id\">";
	foreach ($erreichbars as $erreichbar) {
		echo "<option value=\"" . $erreichbar['id'] . "\" " . ($telefon['erreichbar_id'] == $erreichbar['id'] ? "selected" : "") . ">" . $erreichbar['bezeichnung'] . "</option>";
	}
	echo "</select><img class=\"button deleteTelefon\" src=\"./resources/delete.png\" onclick=\"deleteTelefon(this);\" /></div>";
}
?>