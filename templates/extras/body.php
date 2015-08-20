<div id="div_extraBody">
	<div id="div_cfg_gefundenUeber">
		<textarea id="cfg_gefundenUeber"></textarea>
		<img src="./resources/save.png" onclick="saveGefundenUeber()" class="button" id="save_cfg_gefundenUeber">
	</div>
	<div id="div_cfg_rgpos">
		<textarea id="cfg_rgpos"></textarea>
		<img src="./resources/save.png" onclick="saveRgpos()" class="button" id="save_cfg_rgpos">
	</div>
	<div id="div_auswertungen">
		<div id="div_menu">
			<div id="div_mode">
				<select id="mode">
					<option value="0">standard</option>
					<option value="1">grafisch</option>
				</select>
			</div>
			<div class="menuItem" onclick="FILL_auswertung_diesesJahr();showElement($('div_diesesJahr'));hideElement($('div_gesamt'));hideElement($('div_durchschnitt'));hideElement($('div_minmax'));">
				Dieses Jahr
			</div>
			<div class="menuItem disabled">
				Gesamt
			</div>
			<div class="menuItem disabled">
				Dieses Jahr im Vergleich zum Durchschnitt
			</div>
			<div class="menuItem disabled">
				Dieses Jahr im Vergleich zu Maximum und Minimum
			</div>
		</div>
		<div id="div_diesesJahr" class="div_auswertung_container"></div>
		<div id="div_gesamt" class="div_auswertung_container"></div>
		<div id="div_durchschnitt" class="div_auswertung_container"></div>
		<div id="div_minmax" class="div_auswertung_container"></div>
	</div>
</div>

<div id="div_selectExtra">
	<div class="extraOption" onclick="openDatasite()">
		Datenpflege
	</div>
	<div class="extraOption" onclick="openAuswertungen()">
		Auswertungen
	</div>
	<div class="extraOption" onclick="openConfigurationsGefundenUeber()">
		Konfiguration (gefunden &uuml;ber...)
	</div>
	<div class="extraOption" onclick="openConfigurationsRgpos()">
		Konfiguration (Rechnungspositionen)
	</div>
</div>