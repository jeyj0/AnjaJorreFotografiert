<?php
	@$text = getallheaders()['text'];
	if ($text != null) {
		$handle = fopen("../cfg/rgpos.cfg", "w");
		fwrite($handle, $text);
		fclose($handle);
	}
?>