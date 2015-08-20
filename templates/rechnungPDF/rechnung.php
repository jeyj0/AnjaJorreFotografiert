<?php 

header('Content-type: text/html; charset=iso-8859-1');

require_once('../../dompdf-master/dompdf_config.inc.php');

@$headerHTML = implode("", file('header.html'));
include('content.php'); // $contentHTML
@$footerHTML = implode("", file('footer.html'));

@$headTagHTML = "<title>Rechnung</title><link rel='stylesheet' href='main.css' /><meta charset='utf-8' />";
@$bodyTagHTML = @$headerHTML.@$contentHTML.@$footerHTML;

@$HTML = "<!DOCTYPE HTML><html><head>".@$headTagHTML."</head><body>".@$bodyTagHTML."</body></html>";

$dompdf = new DOMPDF();
$dompdf->load_html($HTML);
$dompdf->set_paper("a4", 'portrait'); 
$dompdf->render();
$dompdf->stream("rechnung.pdf", array("Attachment" => 0));

 ?>