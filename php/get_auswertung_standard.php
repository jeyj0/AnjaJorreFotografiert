<?php header("Content-Type: text/html; charset=ISO-8859-1");
include_once '../classes/Database.php';

$valid = true;
$headers = getallheaders();

if ( !($year1 = $headers['year1']) ) {
	echo "<b>ERROR:</b> No year1 given.";
	$valid = false;
}

if ( !($year2 = $headers['year2']) ) {
	echo "<b>ERROR:</b> No year1 given.";
	$valid = false;
}

if ($valid) {
	$year = array();
	$sql = "SELECT YEAR(r.datum) as year, MONTH(r.datum) as month, SUM( rp.einzelpreis * rp.anzahl ) as amount
				FROM rechnungsposition rp
				INNER JOIN rechnung r ON rp.rechnung_id = r.id
				INNER JOIN auftrag a ON r.auftrag_id = a.id
				INNER JOIN kunde k ON a.kunde_id = k.id
				WHERE rp.geloescht != 1
				AND r.geloescht != 1
				AND a.geloescht != 1
				AND k.geloescht != 1
				AND YEAR(r.datum) >= " . $year1 . "
				AND YEAR(r.datum) <= " . $year2 . "
				GROUP BY YEAR(r.datum), MONTH(r.datum)
				ORDER BY YEAR(r.datum), MONTH(r.datum)";
	$res = $db -> fetch_all_array($sql);
	foreach ($res as $year) {
	?>
	
<div class="auswertung_div">
	<div class="auswertung_jahr">
	<label class="auswertung_label">Jahr</label>
	<label class="auswertung_label">0000,00&euro;</label>
		<table class="auswertung_table">
			<tr>
				<td class="auswertung_quartal1" colspan="3">
					<label class="auswertung_label">1. Quartal</label>
				</td>
				<td class="auswertung_quartal2" colspan="3">
					<label class="auswertung_label">2. Quartal</label>
				</td>
				<td class="auswertung_quartal3" colspan="3">
					<label class="auswertung_label">3. Quartal</label>
				</td>
				<td class="auswertung_quartal4" colspan="3">
					<label class="auswertung_label">4. Quartal</label>
				</td>
			</tr>
			<tr class="auswertung_tr2">
				<td class="auswertung_quartal1b" colspan="3">
					<label class="auswertung_label">0000,00&euro;</label>
				</td>
				<td class="auswertung_quartal2b" colspan="3">
					<label class="auswertung_label">0000,00&euro;</label>
				</td>
				<td class="auswertung_quartal3b" colspan="3">
					<label class="auswertung_label">0000,00&euro;</label>
				</td>
				<td class="auswertung_quartal4b" colspan="3">
					<label class="auswertung_label">0000,00&euro;</label>
				</td>
			</tr>
			<tr class="auswertung_tr3">
			<!-- Q1 -->
					<td class="auswertung_monat1">
						Jan
					</td>
					<td class="auswertung_monat">
						Feb
					</td>
					<td class="auswertung_monat">
						M&auml;r
					</td>
			<!-- Q2 -->
					<td class="auswertung_monat">
						Apr
					</td>
					<td class="auswertung_monat">
						Mai	
					</td>
					<td class="auswertung_monat">
						Jun
					</td>
			<!-- Q3 -->
					<td class="auswertung_monat">
						Jul
					</td>
					<td class="auswertung_monat">
						Aug
					</td>
					<td class="auswertung_monat">
						Sep
					</td>
			<!-- Q4 -->
					<td class="auswertung_monat">
						Okt
					</td>
					<td class="auswertung_monat">
						Nov
					</td>
					<td class="auswertung_monat">
						Dez
					</td>
			</tr>
			<tr>
					<td class="auswertung_monat1b">
						0000,00&euro;
					</td>
					<td class="auswertung_monatb">
						0000,00&euro;
					</td>
					<td class="auswertung_monatb">
						0000,00&euro;
					</td>
			<!-- Q2 -->
					<td class="auswertung_monatb">
						0000,00&euro;
					</td>
					<td class="auswertung_monatb">
						0000,00&euro;
					</td>
					<td class="auswertung_monatb">
						0000,00&euro;
					</td>
			<!-- Q3 -->
					<td class="auswertung_monatb">
						0000,00&euro;
					</td>
					<td class="auswertung_monatb">
						0000,00&euro;
					</td>
					<td class="auswertung_monatb">
						0000,00&euro;
					</td>
			<!-- Q4 -->
					<td class="auswertung_monatb">
						0000,00&euro;
					</td>
					<td class="auswertung_monatb">
						0000,00&euro;
					</td>
					<td class="auswertung_monatb">
						0000,00&euro;
					</td>
			</tr>
		</table>
	</div>
</div>
	
	<?php
	}
}
?>