function FILL_kunde(kundeID) {
	CLEAR_kunde();
	$_kundeID = kundeID;

	request("./php/get_(anredeID_vorname_name_adressIDs_bemerkung).php?id=" + $_kundeID).onreadystatechange = function() {
		if (this.readyState == 4) {
			var data = eval(this.responseText);
			$('select_anrede').value = data[0];
			$('input_vorname').value = data[1];
			$('input_name').value = data[2];
			
			$_kundenadressIDs = data[3];
			if ($_kundenadressIDs.length > 0) {
				FILL_adress($_kundenadressIDs[0]);
			} else {
				CLEAR_adress();
				disableAdresse();
			}
			
			$('txtarea_bemerkung').value = data[4];
		}
	};

	fillElementWithRequest($('div_telefone_box'), "./php/get_telefons.php?id=" + $_kundeID);
	fillElementWithRequest($('div_emails_box'), "./php/get_emails.php?id=" + $_kundeID);
	fillElementWithRequest($('select_auftraege'), "./php/get_select_auftraege.php?id=" + $_kundeID);

	hideElement($('div_auftrag'));
	showElement($('div_kunde'));
}

function CLEAR_kunde() {
	hideElement($('div_kunde'));
	$_kundeID = null;

	var elements = new Array($('select_anrede'), $('input_vorname'), $('input_name'), $('div_telefone_box'), $('div_emails_box'), $('select_auftraege'), $('txtarea_bemerkung'));
	elements.forEach(function(element) {
		if (element.tagName.toLowerCase() == "div") {
			element.innerHTML = "";
		} else {
			element.value = "";
		}
	});
	
	$('div_bemerkung').style.display = 'none';
	CLEAR_adress();
	CLEAR_auftrag();
	CLEAR_rechnung();
}

function NEXT_adress(rtlf) {
	if (!$_kundenadressIDs.length == 0) {
		var index = $_kundenadressIDs.indexOf($_adressID);

		if (rtlf) {
			index++;
			if (index > $_kundenadressIDs.length - 1)
				index = 0;
		} else if (!rtlf) {
			index--;
			if (index < 0)
				index = $_kundenadressIDs.length - 1;
		}

		FILL_adress($_kundenadressIDs[index]);
	}
}

function FILL_adress(adressID) {
	CLEAR_adress();
	enableAdresse();
	$_adressID = adressID;

	request("./php/get_adresse.php?id=" + $_adressID).onreadystatechange = function() {
		if (this.readyState == 4) {
			var data = eval(this.responseText);

			$('input_strasse').value = data[0];
			$('input_hausnummer').value = data[1];
			$('input_adresszusatz').value = data[2];
			$('input_postleitzahl').value = data[3];
			$('input_ort').value = data[4];
			$('input_land').value = data[5];
			$('input_gueltigab').value = data[6];
			$('input_gueltigbis').value = data[7];
		}
	};
}

function CLEAR_adress() {
	$_adressID = null;

	var elements = new Array($('input_strasse'), $('input_hausnummer'), $('input_adresszusatz'), $('input_postleitzahl'), $('input_ort'), $('input_land'), $('input_gueltigab'), $('input_gueltigbis'));
	elements.forEach(function(element) {
		element.value = "";
	});
}

function FILL_auftrag(auftragID) {
	CLEAR_auftrag();
	$_auftragID = auftragID;

	request("./php/get_auftrag.php?id=" + $_auftragID).onreadystatechange = function() {
		if (this.readyState == 4) {
			var data = eval(this.responseText);

			$('input_auftragsdatum').value = data[0];
			$('txtarea_auftragsbemerkung').value = data[1];
			$('txtarea_auftragsausstellungsbemerkung').value = data[2];
			$('input_auftrag_ausstellungserlaubnis').checked = data[3] == 1 ? true : false; // 1 = true; 0 = false

			// 5: beide || 4: kunde || 3: mama || 2: keiner
			var dateiorte = data[4];
			var mamaDateien;
			var kundeDateien;
			switch (dateiorte) {
				case "2":
					mamaDateien = false;
					kundeDateien = false;
					break;
				case "3":
					mamaDateien = true;
					kundeDateien = false;
					break;
				case "4":
					mamaDateien = false;
					kundeDateien = true;
					break;
				case "5":
					mamaDateien = true;
					kundeDateien = true;
					break;
			};
			$('input_auftrag_mamaDateien').checked = mamaDateien;
			$('input_auftrag_kundeDateien').checked = kundeDateien;

			$('select_auftragsart').value = data[5];
		}
		
		//fillElementWithRequest($('select_rechnung'), "./php/get_rechnung_options.php?id=" + $_auftragID);
		request("./php/get_rechnung_options.php?id=" + $_auftragID).onreadystatechange = function() {
			if (this.readyState == 4) {
				$('select_rechnung').innerHTML = this.responseText;
				if ($('select_rechnung').options[0] != undefined) {
					FILL_rechnung($('select_rechnung').options[0].value);
				} else {
					$log('There is no Rechnung for this Auftrag to load.');
				}
			}
		};
		
		showElement($('div_auftrag'));
	};
}

function CLEAR_auftrag() {
	hideElement($('div_auftrag'));
	$_auftragID = null;

	var elements = new Array();
	elements.forEach(function (element) {
		if (element.tagName.toLowerCase() == "div" || element.tagName.toLowerCase() == "select") {
			element.innerHTML = "";
		} else if (element.type.toLowerCase() == "checkbox") {
			element.checked = false;
		} else {
			element.value = "";
		}
	});
}

function FILL_rechnung(rechnungID) {
	CLEAR_rechnung();
	$_rechnungID = rechnungID;
	
	setElementsValueWithRequest($('input_rechnungsdatum'), "./php/get_rechnungsdatum.php?id=" + $_rechnungID);
	
	//fillElementWithRequest($('div_rechnungspositionen'), "./php/get_rgpositionen.php?id=" + $_rechnungID);
	request("./php/get_rgpositionen.php?id=" + $_rechnungID).onreadystatechange = function() {
		if (this.readyState == 4) {
			$('div_rechnungspositionen').innerHTML = this.responseText;
			updateListeners();
		}
	};
	
	showElement($('input_rechnungsdatum'));
	showElement($('div_rechnungspositionen'));
	showElement($('div_rechnungsbuttons'));
}

function CLEAR_rechnung() {
	hideElement($('input_rechnungsdatum'));
	hideElement($('div_rechnungspositionen'));
	hideElement($('div_rechnungsbuttons'));
	
	$('input_rechnungsdatum').value = null;
	$('div_rechnungspositionen').innerHTML = "";
}

function CLEAR_newKunde() {
	var elements = new Array($('newKunde_selectAnrede'), $('newKunde_inputFirstName'), $('newKunde_inputLastName'));
	elements.forEach(function (element) {
		element.value = null;
		element.style.borderColor = "";
	});
	$('newKunde_selectGefundenUeber').selectedIndex = 0;
}

function CLEAR_newAuftrag() {
	var elements = new Array($('newAuftrag_selectArt'), $('newAuftrag_inputDatum'));
	elements.forEach(function (element) {
		element.value = null;
		element.style.borderColor = "";
	});
}

function CLEAR_newRechnung() {
	$('newRechnung_inputDatum').value = null;
	$('newRechnung_inputDatum').style.borderColor = "";
	$('newRechnung_checkNachbestellung').checked = false;
}

function CLEAR_newAdresse() {
	var currDate = new Date();
	var d = currDate.getDate() < 10 ? '0' + currDate.getDate() : currDate.getDate();
	var m = currDate.getMonth() + 1 < 10 ? '0' + (currDate.getMonth() + 1) : currDate.getMonth() + 1;
	var y = currDate.getFullYear();
	
	$('newAdresse_inputAb').value = y + '-' + m + '-' + d;
	$('newAdresse_inputBis').value = "9999-12-31";
	
	$('newAdresse_inputAb').style.borderColor = "";
	$('newAdresse_inputBis').style.borderColor = "";
}

function FILL_auswertung_diesesJahr() {
	CLEAR_auswertung_diesesJahr();
	var diesesJahr = (new Date()).getFullYear();
	var headers = new Array(new Array('year1', diesesJahr), 
									new Array('year2', diesesJahr));
	request('./php/get_auswertung_standard.php', headers).onreadystatechange = function () {
		if (this.readyState == 4) {
			$('div_diesesJahr').innerHTML = this.responseText;
		}
	};
}

function CLEAR_auswertung_diesesJahr() {
	$('div_diesesJahr').innerHTML = '';
}

function updateListeners() {
	/* 
	 * This paragraph formats the Preis-box for all Rechnungspositionen.
	 */
	var preisInputs = Array.prototype.slice.call(document.getElementsByClassName('input_preis'));
	
	preisInputs.forEach(function (element) {
		element.addEventListener('blur', function () {
			if (this.value === '') {
				return;
			}
			this.setAttribute('type', 'text');
			if (this.value.indexOf('.') === -1) {
				this.value = this.value + '.00€';
			}
			while (this.value.indexOf('.') > this.value.length - 3) {
				this.value = this.value + '0';
			}
			if (this.value.substr(this.value.length - 1) != "€") {
				this.value = this.value + "€";
			}
		});
		element.addEventListener('focus', function () {
			if (this.value.substr(this.value.length - 1) == "€") {
				this.value = this.value.substr(0, this.value.length - 1);
			}
			this.setAttribute('type', 'number');
		});
	});
	
	preisInputs.forEach(function (element) {
		element.focus();
		element.blur();
	});
}
