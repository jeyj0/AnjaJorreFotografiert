<?php

$mobile_browser = '0';

if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
	$mobile_browser++;
}

if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
	$mobile_browser++;
}

$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
$mobile_agents = array(
	'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
	'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
	'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
	'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
	'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
	'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
	'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
	'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
	'wapr','webc','winw','winw','xda ','xda-');

if (in_array($mobile_ua,$mobile_agents)) {
	$mobile_browser++;
}

if (strpos(strtolower(@$_SERVER['ALL_HTTP']),'OperaMini') > 0) {
	$mobile_browser++;
}

if (strpos(strtolower(@$_SERVER['HTTP_USER_AGENT']),'windows') > 0) {
	$mobile_browser = 0;
}

if ($mobile_browser > 0) {
	header("Location: ./mobilesite/");
}
else { ?>

	<!DOCTYPE HTML>
	<html>
		<meta content="text/html; charset=iso-8859-1" />
		<?php 
			include_once './classes/LogFile.php';
			
			if (!(@include_once './classes/Database.php')) $log->addError("Failed to include Database-class ('./classes/Database.php').");
			if (!(@include_once './classes/HTML.php')) $log->addError("Failed to include HTML-class ('./classes/HTML.php').");
			
			if (!(@include './templates/head/head.php')) $log->addError("Failed to include head ('./templates/head/head.php').");
			if (!(@include './templates/body/body.php')) $log->addError("Failed to include body ('./templates/body/body.php').");			
			
			$log->save();
		 ?>
		 <noscript>
		 	Diese Seite nutzt JavaScript. Bitte in den Browsereinstellungen aktivieren!
		 </noscript>
	</html>

<?php } ?>