<?php header("Content-Type: text/html; charset=ISO-8859-1");
include_once '../classes/Database.php';

$id = $_GET['id'];

$typen = $db -> fetch_all_array("SELECT id, bezeichnung FROM emailtyp WHERE geloescht != 1");
$mails = $db -> fetch_all_array("SELECT e.id, e.email, e.typ_id FROM kunde k INNER JOIN email e ON k.id = e.kunde_id WHERE e.geloescht != 1 AND k.id = " . $id);

foreach ($mails as $mail) {
	echo "<div class=\"div_email\" mailid=\"" . $mail['id'] . "\">";
	echo "<input type=\"email\" class=\"input_email\" value=\"" . $mail['email'] . "\" onblur=\"onValueChange(this)\" table=\"email\" field=\"email\" />";
	echo "<select class=\"select_emailtyp\" onblur=\"onValueChange(this)\" table=\"email\" field=\"emailtyp_id\">";
	foreach ($typen as $typ) {
		echo "<option value=\"" . $typ['id'] . "\" " . ($mail['emailtyp_id'] == $typ['id'] ? "selected" : "") . ">" . $typ['bezeichnung'] . "</option>";
	}
	echo "</select><img class=\"button deleteEmail\" src=\"./resources/delete.png\" onclick=\"deleteEmail(this);\" /></div>";
}
?>