function submit_newAdresse() {
	var valid = true;
	
	if ($('newAdresse_inputAb').value == "") {
		$('newAdresse_inputAb').style.borderColor = "#a00";
		valid = false;
		alert("Bitte ein gültig-ab Datum festlegen.")
	} else {
		$('newAdresse_inputAb').style.borderColor = "";
	}
	
	if ($('newAdresse_inputBis').value == "") {
		$('newAdresse_inputBis').style.borderColor = "#a00";
		valid = false;
		alert("Bitte ein gültig-bis Datum festlegen.")
	} else {
		$('newAdresse_inputBis').style.borderColor = "";
	}
	
	if (valid) {
		var gueltigAb = $('newAdresse_inputAb').value;
		var gueltigBis = $('newAdresse_inputBis').value;
		
		hideElement($('popup_newAdresse'));
		hideElement($('popup_graybg'));
		CLEAR_newAdresse();
		var headers = new Array(new Array('gueltigAb', gueltigAb),
										new Array('gueltigBis', gueltigBis), 
										new Array('kundeID', $_kundeID));
		if ($_adressID != null)
			headers.push(new Array('lastAdressID', $_adressID));
		
		request('./php/insertAdresse.php', headers).onreadystatechange = function () {
			if (this.readyState == 4) {
				$_kundenadressIDs[$_kundenadressIDs.length] = this.responseText;
				FILL_adress(this.responseText);
			}
		};
	}
}

function submit_newRechnung() {
	var valid = true;
	if ($('newRechnung_inputDatum').value == "") {
		$('newRechnung_inputDatum').style.borderColor = "#a00";
		valid = false;
		alert("Bitte ein Datum festlegen.");
	} else {
		$('newRechnung_inputDatum').style.borderColor = "";
	}
	
	if (valid) {
		var nachbestellung = $('newRechnung_checkNachbestellung').checked;
		var datum = $('newRechnung_inputDatum').value;
		
		hideElement($('popup_newRechnung'));
		hideElement($('popup_graybg'));
		CLEAR_newRechnung();
		var headers = new Array(new Array('nachbestellung', nachbestellung),  
										new Array('datum', datum),
										new Array('auftragID', $_auftragID));
		request('./php/insertRechnung.php', headers).onreadystatechange = function () {
			if (this.readyState == 4) {
				fillElementWithRequest($('select_rechnung'), "./php/get_rechnung_options.php?id=" + $_auftragID, null, this.responseText, true);
			}
		};
	}
}

function submit_newAuftrag() {
	var valid = true;
	if ($('newAuftrag_selectArt').value == "") {
		$('newAuftrag_selectArt').style.borderColor = "#a00";
		valid = false;
		alert("Bitte eine Auftragsart auswählen.");
	} else {
		$('newAuftrag_selectArt').style.borderColor = "";
	}
	
	if ($('newAuftrag_inputDatum').value == "") {
		$('newAuftrag_inputDatum').style.borderColor = "#a00";
		valid = false;
		alert("Bitte ein Datum festlegen.");
	} else {
		$('newAuftrag_inputDatum').style.borderColor = "";
	}
	
	if (valid) {
		var artID = $('newAuftrag_selectArt').value;
		var datum = $('newAuftrag_inputDatum').value;
		
		hideElement($('popup_newAuftrag'));
		hideElement($('popup_graybg'));
		CLEAR_newAuftrag();
		var headers = new Array(new Array('artID', artID),  
										new Array('datum', datum),
										new Array('kundeID', $_kundeID));
		request('./php/insertAuftrag.php', headers).onreadystatechange = function () {
			if (this.readyState == 4) {
				fillElementWithRequest($('select_auftraege'), "./php/get_select_auftraege.php?id=" + $_kundeID, null, this.responseText, true);
			}
		};
	}
}

function submit_newKunde() {
	var valid = true;
	if ($('newKunde_selectAnrede').value == "") {
		$('newKunde_selectAnrede').style.borderColor = "#a00";
		valid = false;
		alert("Bitte eine Anrede festlegen.");
	} else {
		$('newKunde_selectAnrede').style.borderColor = "";
	}
	
	if ($('newKunde_inputLastName').value == "") {
		$('newKunde_inputLastName').style.borderColor = "#a00";
		valid = false;
		alert("Bitte einen Nachnamen festlegen.");
	} else {
		$('newKunde_inputLastName').style.borderColor = "";
	}
	
	if ($('newKunde_selectGefundenUeber').value == "") {
		$('newKunde_selectGefundenUeber').style.borderColor = "#a00";
		valid = false;
		alert("Bitte auswählen, wie der Kunde auf Anja Jorré fotografiert gekommen ist.")
	} else {
		$('newKunde_selectGefundenUeber').style.borderColor = "";
	}
	
	if (valid) {
		var anredeID = $('newKunde_selectAnrede').value;
		var firstName = $('newKunde_inputFirstName').value;
		var lastName = $('newKunde_inputLastName').value;
		
		hideElement($('popup_newKunde'));
		hideElement($('popup_graybg'));
		CLEAR_newKunde();
		var headers = new Array(new Array('anredeID', anredeID), 
										new Array('firstName', firstName), 
										new Array('lastName', lastName));
		request('./php/insertKunde.php', headers).onreadystatechange = function () {
			if (this.readyState == 4) {
				fillElementWithRequest($('select_kunde'), "./php/get_select_kunde.php", null, this.responseText, true);
			}
		};
	}
}