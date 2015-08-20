<?php
	@$text = getallheaders()['text'];
	if ($text != null) {
		$handle = fopen("../cfg/gefunden_ueber.cfg", "w");
		fwrite($handle, $text);
		fclose($handle);
	}
?>