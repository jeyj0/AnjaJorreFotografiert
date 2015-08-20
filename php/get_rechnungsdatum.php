<?php header("Content-Type: text/html; charset=ISO-8859-1");
include_once '../classes/Database.php';

$id = $_GET['id'];

$rechnung = $db -> fetch_all_array("SELECT datum FROM rechnung WHERE id = " . $id);
echo $rechnung[0]['datum'];

?>