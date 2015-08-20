<?php header("Content-Type: text/json; charset=ISO-8859-1");
include_once '../classes/Database.php';

$id = $_GET['id'];

$adresse = $db -> fetch_all_array("SELECT strasse, hausnummer, adresszusatz, postleitzahl, ort, land, gueltig_ab, gueltig_bis FROM adresse WHERE id = " . $id);

$echo = "[";
foreach ($adresse[0] as $key => $value) {
	$echo = $echo . "\"" . $value . "\",";
}
$echo = substr($echo, 0, strlen($echo) - 1) . "]";
echo $echo;
?>