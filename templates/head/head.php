<?php
	ob_start();
?>
<head>
	<title>[name]</title>
	
	<link rel="shortcut icon" href="./resources/kamera.ico" />
	<link rel="favicon" href="./resources/kamera.ico" />
	
	<link rel="stylesheet" type="text/css" href="./style/main.css" charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./style/extras.css" charset="UTF-8">
	<script type="text/javascript" charset="UTF-8" src="./script/main.js"></script>
	<script type="text/javascript" charset="UTF-8" src="./script/globals.js"></script>
	<script type="text/javascript" charset="UTF-8" src="./script/eventHandler.js"></script>
	<script type="text/javascript" charset="UTF-8" src="./script/mainSetup.js"></script>
	<script type="text/javascript" charset="UTF-8" src="./script/http.js"></script>
	<script type="text/javascript" charset="UTF-8" src="./script/filler.js"></script>
	<script type="text/javascript" charset="UTF-8" src="./script/popup.js"></script>
	<script type="text/javascript" charset="UTF-8" src="./script/forms.js"></script>
</head>
<?php
	$code = ob_get_clean();
	$HTML = new HTML($code);
	echo $HTML->getHTML();
?>