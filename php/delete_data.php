<?php
	include_once '../classes/Database.php';
	$headers = getallheaders();
	
	$valid = true;
	if (!($table = @$headers['table'])) {
		$valid = false;
		echo "ERROR: No table given.";
	}
	if (!($id = @$headers['id'])) {
		$valid = false;
		echo "ERROR: No id given.";
	}
	
	if ($valid) {
		$sql = "UPDATE " . $table . " SET geloescht = true WHERE id = " . $id;
		$res = $db -> query($sql);
		echo $res;
	}
?>