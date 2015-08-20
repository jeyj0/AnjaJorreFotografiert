<?php
	include_once '../classes/Database.php';
	
	$headers = getallheaders();
	
	$valid = true;
	if (!($table = @$headers['table'])) {
		$valid = false;
		echo "ERROR: No table given.\n";
	}
	if (!($field = @$headers['field'])) {
		$valid = false;
		echo "ERROR: No field given.\n";
	}
	$value = @$headers['value'];
	if ($value == null) {
		$valid = false;
		echo "ERROR: No value given.\n";
	}
	if (!($id = @$headers['id'])) {
		$valid = false;
		echo "ERROR: No id given.\n";
	}
	
	if ($valid) {
		if ($value == "%null%") $value = "";
		$sql = "UPDATE " . $table . " SET " . $field . " = \"" . $value . "\" WHERE id = " . $id;
		$res = $db -> query($sql);
		if ($res != 1) {
			echo $res;
		} elseif ($res == 1) {
			echo "1" . $table . "." . $field;
		}
	}
?>