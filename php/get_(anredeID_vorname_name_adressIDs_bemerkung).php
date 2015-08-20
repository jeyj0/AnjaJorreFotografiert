<?php header("Content-Type: text/json; charset=ISO-8859-1");
include_once '../classes/Database.php';

$id = $_GET['id'];

$kunde = $db -> fetch_all_array("SELECT k.anrede_id, k.vorname, k.name, k.bemerkung FROM kunde k WHERE k.id = " . $id);
$adressIDs = $db -> fetch_all_array("SELECT a.id FROM adresse a WHERE geloescht != 1 AND a.kunde_id = " . $id . " ORDER BY a.gueltig_bis");

$adressIDsString = "";
foreach ($adressIDs as $adressID) {
	$adressIDsString = $adressIDsString . $adressID['id'] . ",";
}
$adressIDsString = substr($adressIDsString, 0, strlen($adressIDsString));

echo "[".$kunde[0]['anrede_id'].",\"".$kunde[0]['vorname']."\",\"".$kunde[0]['name']."\",[".$adressIDsString."], \"".$kunde[0]['bemerkung']."\"]";
?>