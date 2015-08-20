<?php
	
	header("Content-Type: text/json; charset=ISO-8859-1");
	
	@$HTTP_HEADERS = apache_request_headers();
	
	@$_POST['query'] = $HTTP_HEADERS['query'];
	@$_POST['table'] = $HTTP_HEADERS['table'];
	
	if (@$_POST['query'] && @$_POST['table']) {
		if (@include_once('../classes/Database.php')) {
			echo formattedQuery($_POST['query'], $_POST['table'], $db);
		} else {
			echo "ERROR: Could not include Database-file.\n";
		};
	} else {
		if (!@$_POST['query']) echo "ERROR: Got no query.\n";
		if (!@$_POST['table']) echo "ERROR: Got no table.\n";
	};
	
	function formattedQuery($sql, $tbl, $db) {
		$result = $db->fetch_all_array_types($sql, $tbl);
		if (is_array($result)) {
			$keys = $result[0];
			$result = array_reverse($result);array_pop($result);$result = array_reverse($result);
			return formatArray($result[0], 0, $keys);
		} else {
			echo "ERROR: The query-result was expected to be array, got ".gettype($result)."\n";
		}
	}
	
	function formatArray($par1, $par2=0, $par3=false, $par4=true) {
		if (is_array($par1)) {
			$v1 = "";
			$v2 = "";
			/*if (is_int($par2)) {
				for ($i=0; $i < $par2; $i++) { 
					$v2 .= "\t";
				};
			};*/
			if (!$par3) {
				foreach ($par1 as $key => $val) {
					if (is_array($val)) {
						$v1 .= $v2."{".formatArray($val, $par2+1, $par3)."},";
					} else {
						$v1 .= $v2."\"".$key."\":\"".$val."\",";
					};
				};
			} else {
				if ($par4) {
					foreach ($par1 as $key => $val) {
						if (is_array($val)) {
							$v1 .= $v2."{".formatArray($val, $par2+1, $par3)."},";
						} else {
							$v1 .= $v2."\"".$key."\":\"".$val."\",";
						};
					};
				} else {
					foreach ($par1 as $key => $val) {
						echo $key." = ".$val;
						if (is_array($val)) {
							$v1 .= $v2."{".formatArray($val, $par2+1)."},";
						} else {
							$v1 .= $v2."\"".$key."\":\"".$val."\",";
						};
					};
				};
			};
			
			$v1 = str_replace(',}', '}', $v1);
			$v1 = str_replace(',]', ']', $v1);
			return $v1;
		} else {
			return "ERROR: Array expected as \$par1, ".gettype($par1)." given.\n";
		};
	}
	
	function row($name, $value, $left=0, $type="string") {
		for ($i=0; $i < $left; $i++) $l .= "\t";
		return $l."<".$type." name='".$name."'>".$value."</".$type.">\n";
	}
	
?>