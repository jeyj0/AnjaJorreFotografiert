<?php header("Content-Type: text/html; charset=ISO-8859-1");
include_once '../classes/Database.php';

$id = $_GET['id'];

$positionen = $db -> fetch_all_array("SELECT p.id, p.bezeichnung, p.einzelpreis, p.anzahl FROM rechnung r INNER JOIN rechnungsposition p ON r.id = p.rechnung_id WHERE p.geloescht != 1 AND r.id = " . $id);

foreach ($positionen as $position) {
	echo "<div class=\"div_rgposition\" posid=\"" . $position['id'] . "\">";
	echo "<input type=\"text\" class=\"input_bezeichnung\" value=\"" . $position['bezeichnung'] . "\" table=\"rechnungsposition\" field=\"bezeichnung\" onblur=\"onValueChange(this);\" />";
	echo "<input type=\"number\" step=\"0.01\" class=\"input_preis\" value=\"" . $position['einzelpreis'] . "\" table=\"rechnungsposition\" field=\"einzelpreis\" onblur=\"onValueChange(this);\" />";
	echo "<input type=\"number\" step=\"1\" class=\"input_menge\" value=\"" . $position['anzahl'] . "\" min=\"1\" table=\"rechnungsposition\" field=\"anzahl\" onblur=\"onValueChange(this);\" />";
	echo "<img class=\"button deleteRgposition\" src=\"./resources/delete.png\" onclick=\"deleteRgpos(this);\" /></div>";
}
?>