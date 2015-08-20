<?php header("Content-Type: text/json; charset=ISO-8859-1");
include_once '../classes/Database.php';

$id = $_GET['id'];

$auftragsinfos = $db -> fetch_all_array("SELECT datum, bemerkung, ausstellungsbemerkung, ausstellung, dateiorte, auftragsart_id FROM auftrag WHERE id = " . $id);

$echo = "[";
foreach ($auftragsinfos[0] as $key => $value) {
	$echo = $echo . "\"" . $value . "\",";
}
$echo = substr($echo, 0, strlen($echo) - 1) . "]";

echo $echo;
?>