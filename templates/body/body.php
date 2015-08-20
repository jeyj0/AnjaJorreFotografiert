<?php
	ob_start();
?>
<body>
	<div id="div_header">
		<label id="label_sitename">
			[name]
		</label>
		<select id="select_kunde" onchange="FILL_kunde(this.value);"></select>
		<img id="button_kunde_new" class="button" src="./resources/newKunde.png" onclick="showElement($('popup_newKunde'));showElement($('popup_graybg'));" />
		<img id="button_extras" class="button" src="./resources/kamera.png" onclick="selectExtra()" />
	</div>
	<div id="div_kunde">
		<div id="div_kundeninfos">
			<div id="div_kundenname">
				<select id="select_anrede"></select>
				<input id="input_vorname" type="text" />
				<input id="input_name" type="text" />
				<img id="button_kunde_del" class="button" src="./resources/delete.png" onclick="deleteKunde();" />
			</div>
			<div id="div_telefone">
				<label id="label_telefon">
					Telefon
				</label>
				<div id="div_telefone_box">
					<!--
						List of all Telefons for the kunde
					-->
				</div>
				<div id="div_telefone_buttons">
					<img id="button_telefon_new" class="button" src="./resources/add.png" onclick="newTelefon()" />
				</div>
			</div>
			<div id="div_emails">
				<label id="label_email">
					E-Mail
				</label>
				<div id="div_emails_box">
					<!--
						List of all E-Mails for the kunde
					-->
				</div>
				<div id="div_emails_buttons">
					<img id="button_email_new" class="button" src="./resources/add.png" onclick="newEmail()" />
				</div>
			</div>
			<div id="div_adresse">
				<label id="label_adresse">
					Adresse
				</label>
				<input id="input_unbekanntVerzogen" type="checkbox" />
				<label id="label_unbekanntVerzogen" for="input_unbekanntVerzogen">unbekannt verzogen</label>
				<input id="input_strasse" type="text" placeholder="Stra&szlig;e" />
				<input id="input_hausnummer" type="text" placeholder="Hnr" />
				<input id="input_adresszusatz" type="text" placeholder="Adresszusatz" />
				<input id="input_postleitzahl" type="text" placeholder="PLZ" />
				<input id="input_ort" type="text" placeholder="Ort" />
				<input id="input_land" type="text" placeholder="Land" />
				<label id="label_gueltigab">
					G&uuml;ltig von
				</label>
				<input id="input_gueltigab" type="date" />
				<label id="label_gueltigbis">
					bis
				</label>
				<input id="input_gueltigbis" type="date" />
				<img id="button_adresseleft" class="button" src="./resources/left.png" onclick="NEXT_adress(false)" />
				<img id="button_adressenew" class="button" src="./resources/add.png" onclick="showElement($('popup_newAdresse'));showElement($('popup_graybg'));" />
				<img id="button_adressedel" class="button" src="./resources/delete.png" onclick="deleteAdresse();" />
				<img id="button_adresseright" class="button" src="./resources/right.png" onclick="NEXT_adress(true)" />
			</div>
		</div>
		<div id="div_auftraege">
			<select id="select_auftraege" size="2" onchange="FILL_auftrag(this.value)"></select>
			<img id="button_auftrag_new" class="button" src="./resources/auftrag.png" onclick="showElement($('popup_newAuftrag'));showElement($('popup_graybg'));" />
			<img id="button_auftrag_import" class="button" src="./resources/auftragimport.png" />
		</div>
	</div>
	<div id="div_auftrag">
		<div id="div_auftraginfos">
			<div id="div_auftrag_bild">
				<img id="img_auftrag_bild" src="./resources/logo.jpg" />
				<img id="img_delAuftrag" class="button" src="./resources/delete.png" onclick="deleteAuftrag();" />
				<!--upcoming content...
				<input type="file" id="body_auftrag_ifoto" onchange="setFotofileAsAuftragsfoto(this)" accept="image/jpeg, image/gif, image/png" />-->
			</div>
			<input id="input_auftragsdatum" type="date" />
			<select id="select_auftragsart"></select>
			<input id="input_auftrag_kundeDateien" type="checkbox" />
			<label id="label_auftrag_kundeDateien" for="input_auftrag_kundeDateien">Kunde hat Dateien erhalten</label>
			<input id="input_auftrag_mamaDateien" type="checkbox" />
			<label id="label_auftrag_mamaDateien" for="input_auftrag_mamaDateien">Dateien noch vorhanden</label>
			<textarea id="txtarea_auftragsbemerkung" placeholder="Auftragsbemerkung"></textarea>
			<input id="input_auftrag_ausstellungserlaubnis" type="checkbox" />
			<label id="label_auftrag_ausstellung" for="input_auftrag_ausstellungserlaubnis">Ausstellung</label>
			<img id="button_auftrag_ausstellungsfotos" class="button" src="./resources/ausstellung.png" />
			<textarea id="txtarea_auftragsausstellungsbemerkung" placeholder="Ausstellungsbemerkung"></textarea>
		</div>
		<div id="div_rechnung">
			<div id="div_rechnung_auswaehlen">
				<select id="select_rechnung" onchange="FILL_rechnung(this.value)"></select>
				<img id="button_newrg" class="button" src="./resources/rechnung.png" onclick="showElement($('popup_newRechnung'));showElement($('popup_graybg'));" />
				<input id="input_rechnungsdatum" type="date" /> 
			</div>
			<div id="div_rechnungspositionen">
				<!--
					List of all Rechnungspositionen for the current Rechnung
				-->
			</div>
			<div id="div_rechnungsbuttons">
				<img id="button_newrechnungsposition" class="button" src="./resources/add.png" onclick="newRechnungsposition();" />
				<img id="button_rechnung_print" class="button" src="./resources/print.png" onclick="window.open('./templates/rechnungPDF/rechnung.php?rechnungID=' + $_rechnungID)" />
				<img id="button_delRechnung" class="button" src="./resources/delete.png" onclick="deleteRechnung();">
			</div>
		</div>
	</div>
	<?php
		include './templates/extras/body.php';
	?>
	<div id="div_footer">
		<img id="button_bemerkung" class="button" src="./resources/bemerkung.png" onclick="changeBemerkungState();" />
		<!-- upcoming content...
		<img id="button_kundenbeziehung" class="button" src="./resources/beziehung.png" />
		-->
		<img id="img_copyright" src="./resources/copyright.png" />
	</div>
	<mainload>
	
	<div id="popup_graybg"></div>
	
	<div id="popup_newKunde" class="popup">
		<label id="newKunde_title" class="popupTitle">Neuer Kunde</label>
		<img src="./resources/delete.png" class="button popupButtonDel" onclick="hideElement($('popup_newKunde'));hideElement($('popup_graybg'));CLEAR_newKunde();">
		<img src="./resources/ok.png" class="button popupButtonOk" onclick="submit_newKunde();">
		<div class="popupLine"></div>
		<select id="newKunde_selectAnrede"></select>
		<input id="newKunde_inputFirstName" placeholder="Vorname" />
		<input id="newKunde_inputLastName" placeholder="Nachname" />
		<select id="newKunde_selectGefundenUeber">
			<?php
				echo "<option value=\"\" disabled selected>gefunden &uuml;ber...</option>";
				
				$gefunden_ueber = file("./cfg/gefunden_ueber.cfg");
				$gefunden_ueber = urldecode($gefunden_ueber[0]);
				$gefunden_ueber = htmlentities($gefunden_ueber);
				$gefunden_ueber = explode("\n", $gefunden_ueber);
				foreach ($gefunden_ueber as $gue) {
					if (substr($gue, 0, 1) != "#") {
						echo "<option value=\"$gue\">$gue</option>";
					}
				}
			?>
		</select>
	</div>
	
	<div id="popup_newAuftrag" class="popup">
		<label id="newAuftrag_title" class="popupTitle">Neuer Auftrag</label>
		<img src="./resources/delete.png" class="button popupButtonDel" onclick="hideElement($('popup_newAuftrag'));hideElement($('popup_graybg'));CLEAR_newAuftrag();">
		<img src="./resources/ok.png" class="button popupButtonOk" onclick="submit_newAuftrag();">
		<div class="popupLine"></div>
		<select id="newAuftrag_selectArt"></select>
		<input id="newAuftrag_inputDatum" type="date" />
	</div>
	
	<div id="popup_newRechnung" class="popup">
		<label id="newRechnung_title" class="popupTitle">Neue Rechnung</label>
		<img src="./resources/delete.png" class="button popupButtonDel" onclick="hideElement($('popup_newRechnung'));hideElement($('popup_graybg'));CLEAR_newRechnung();">
		<img src="./resources/ok.png" class="button popupButtonOk" onclick="submit_newRechnung();">
		<div class="popupLine"></div>
		<input id="newRechnung_inputDatum" type="date" />
		<input id="newRechnung_checkNachbestellung" type="checkbox" />
		<label id="newRechnung_labelNachbestellung" for="newRechnung_checkNachbestellung">Nachbestellung</label>
	</div>
	
	<div id="popup_newAdresse" class="popup">
		<label id="newAdresse_title" class="popupTitle">Neue Adresse</label>
		<img src="./resources/delete.png" class="button popupButtonDel" onclick="hideElement($('popup_newAdresse'));hideElement($('popup_graybg'));CLEAR_newAdresse();">
		<img src="./resources/ok.png" class="button popupButtonOk" onclick="submit_newAdresse();">
		<div class="popupLine"></div>
		<input id="newAdresse_inputAb" type="date" />
		<input id="newAdresse_inputBis" type="date" />
	</div>
	
	<div id="div_bemerkung">
		<textarea id="txtarea_bemerkung" placeholder="Bemerkung"></textarea>
	</div>
	
	<div id="popup_standardRgpos">
		<?php
			$rgpos = file("./cfg/rgpos.cfg");
			$rgpos = urldecode($rgpos[0]);
			$rgpos = htmlentities($rgpos);
			$rgpos = explode("\n", $rgpos);
			foreach ($rgpos as $pos) {
				if (substr($pos, 0, 1) != "#") {
					$text = substr($pos, 1, strpos($pos, '"', 1) - 1);
					echo "<div class=\"standardRgpos\" onclick='setRgposValueTo(" . $pos . ")'>" . $text . "</div>";
				}
			}
		?>
	</div>
	
</body>
<script type="text/javascript" src="./script/init.js" charset="UTF-8"></script>
<?php
	$code = ob_get_clean();
	$HTML = new HTML($code);
	echo $HTML->getHTML();
?>