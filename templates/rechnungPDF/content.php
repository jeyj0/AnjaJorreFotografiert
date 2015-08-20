<?php 

include_once '../../classes/Database.php';

@$rechnungID = $_GET['rechnungID'];
@$rechnung = $db->fetch_all_array("SELECT r.id, r.datum, r.auftrag_id, r.rechnungsnummer rgnr FROM rechnung r WHERE r.id = ".@$rechnungID); @$rechnung = @$rechnung[0];
	@$rechnung['frist'] = strtotime('+10 day', @strtotime(@$rechnung['datum']));
		@$rechnung['frist'] = date("d.m.Y", @$rechnung['frist']);
	@$rechnung['datum'] = (substr(@$rechnung['datum'], 8, 2)).".".substr(@$rechnung['datum'], 5, 2).".".substr(@$rechnung['datum'], 0, 4);
	@$datum = intval(substr($rechnung['datum'], 0, 4).substr($rechnung['datum'], 5, 2).substr($rechnung['datum'], 8, 2));
@$auftrag = $db->fetch_all_array("SELECT a.id, a.kunde_id, a.datum FROM auftrag a WHERE a.id = ".@$rechnung['auftrag_id']); @$auftrag = @$auftrag[0];
	@$auftrag['datum'] = substr(@$auftrag['datum'], 8, 2).".".substr(@$auftrag['datum'], 5, 2).".".substr(@$auftrag['datum'], 0, 4);
@$kunde = $db->fetch_all_array("SELECT k.id, k.vorname, k.name
					FROM kunde k WHERE k.id = ".@$auftrag['kunde_id']); @$kunde = @$kunde[0];
@$positionen = $db->fetch_all_array("SELECT p.bezeichnung, p.anzahl, p.einzelpreis FROM rechnungsposition p WHERE geloescht != 1 AND p.rechnung_id = ".@$rechnungID);
@$adresse = $db->fetch_all_array("SELECT a.strasse, a.hausnummer hnr, a.adresszusatz zusatz, a.postleitzahl plz, a.ort, a.land FROM adresse a WHERE a.geloescht != 1 AND a.kunde_id = ".@$kunde['id']);
	foreach (@$adresse as $a) {
		@$a['gueltig_ab'] = intval(substr($a['gueltig_ab'], 0, 4).substr($a['gueltig_ab'], 5, 2).substr($a['gueltig_ab'], 8, 2));
		@$a['gueltig_bis'] = intval(substr($a['gueltig_bis'], 0, 4).substr($a['gueltig_bis'], 5, 2).substr($a['gueltig_bis'], 8, 2));
	}
	function filterLaterAdresses($var) {
		if ($var['gueltig_ab'] > $datum) {
			return false;
		}
		return true;
	}
	
	function filterBeforeAdresses($var) {
		if ($var['gueltig_bis'] < $datum) {
			return false;
		}
		return true;
	}
	@$adresse = array_filter(@$adresse, "filterLaterAdresses");
	@$adresse = array_filter(@$adresse, "filterBeforeAdresses");
	@asort($adresse);
	@$adresse = @$adresse[0];

@$contentHTML = "";
ob_start();

 ?>

<div id="content">
	<label id="contentTitel">Rechnung</label>
	<div id="contentKundenadresse">
		<label id="contentKundenname"><?php echo @$kunde['vorname']." ".@$kunde['name']; ?></label>
		<label id="contentKundenstrassehnr"><?php echo @$adresse['strasse']." ".@$adresse['hnr']; ?></label>
		<label id="contentKundenzusatz"><?php echo @$adresse['zusatz']; ?></label>
		<label id="contentKundenplzort"><?php echo @$adresse['plz']." ".@$adresse['ort']; ?></label>
		<label id="contentKundenland"><?php echo @$adresse['land']; ?></label>
	</div>
	<div id="contentRechnungsinformationen">
		<label id="contentRechnungsnummer">Rechnungsnummer: <?php echo @$rechnung['rgnr']; ?></label>
		<label id="contentRechnungsdatum"><?php echo @$rechnung['datum']; ?></label>
		<label id="contentAuftragsdatum">Rechnung f&uuml;r Fotoaufnahmen vom <?php echo @$auftrag['datum']; ?>.</label>
	</div>
	<!--<div id="contentLinebeforePos" class="lineContent"></div>-->
	<div id="contentRechnungsinhalt">
		<table id="contentRechnungstabelle">
			<tr id="tableHeads">
				<th id="tableHeadBezeichnung">Bezeichnung</th>
				<th id="tableHeadAnzahl">Anzahl</th>
				<th id="tableHeadEinzel">Einzelpreis</th>
				<th id="tableHeadGesamt">Gesamtpreis</th>
			</tr>
			<?php foreach (@$positionen as $position) { ?>
				<tr class="rechnungsposition">
					<td class="bezeichnung"><?php echo @$position['bezeichnung']; ?></td>
					<td class="anzahl"><?php echo @$position['anzahl']; ?></td>
					<td class="einzel"><?php echo @number_format((float) @$position['einzelpreis'], 2, ',', '')."&euro;"; ?></td>
					<td class="gesamt"><?php echo @number_format(((float) @$position['anzahl']*@$position['einzelpreis']), 2, ',', '')."&euro;"; ?></td>
				</tr>
			<?php } ?>
			<tr id="tableGesamt">
				<td id="gesamtBezeichnung" colspan="3">Komplettpreis: </td>
				<td id="gesamtPreis"><?php 
					@$gesamtpreis = 0;
					for ($i = 0; $i <= count($positionen)-1; $i++) {
						$gesamtpreis = $gesamtpreis+$positionen[$i]['anzahl']*$positionen[$i]['einzelpreis'];
					}
					echo @number_format(@$gesamtpreis, 2, ',', '')."&euro;";
				 ?></td>
			</tr>
		</table>
	</div>
	<label id="contentText">Ich weise auf meiner Rechnung keine MwSt. aus, 
							da ich nach &sect; 19 Abs. 1 UStG nicht umsatzsteuerpflichtig bin.<br><br>
							Bitte zahlen Sie den Komplettpreis ohne Abz&uuml;ge bis zum <?php echo @$rechnung['frist']; ?>.<br> 
							Bei der &Uuml;berweisung geben Sie bitte die Rechnungsnummer <?php echo @$rechnung['rgnr']; ?> an.</label>
</div>

<?php 

@$contentHTML = utf8_encode(str_replace('&euro;', '<span class="helvetica"> &euro;</span>', ob_get_clean()));

 ?>