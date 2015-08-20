function disableAdresse() {
	var adressInputs = Array.prototype.slice.call($('div_adresse').getElementsByTagName('input'));
	adressInputs.forEach(function (element) {
		element.disabled = true;
	});
	$('input_unbekanntVerzogen').disabled = false;
}

function enableAdresse() {
	var adressInputs = Array.prototype.slice.call($('div_adresse').getElementsByTagName('input'));
	adressInputs.forEach(function (element) {
		element.disabled = false;
	});
}

function deleteAdresse() {
	if ($_adressID != null && confirm("Bist du dir sicher, dass du die ausgewählte Adresse dieses Kunde löschen möchtest? \nBitte beachte die Abhängigkeit von Rechnungen auf die Adresse. Die Rechnungen werden nicht gespeichert und abgebildete Adressen werden bei jedem Aufruf neu abgefragt. Somit könnte eine gelöschte Adresse zu einem Informationsverlust auf einer oder mehr Rechnungen führen. \n\nTrotzdem löschen?")) {
		var headers = new Array(new Array('table', 'adresse'), 
										new Array('id', $_adressID));
		request('./php/delete_data.php', headers).onreadystatechange = function () {
			if (this.readyState == 4 && this.responseText != "1") {
				alert("Es gab einen Fehler beim Datensatz löschen. Bitte erneut versuchen. \n\nFalls das nicht helfen sollte bitte den Seitenadministrator kontaktieren.");
			} else if (this.readyState == 4) {
				FILL_kunde($_kundeID);
			}
		};
	}
}

function deleteRechnung() {
	if (confirm("Bist du dir sicher, dass du die ausgewählte Rechnung löschen möchtest?\nDieser Vorgang kann nicht rückgängig gemacht werden.")) {
		var headers = new Array(new Array('table', 'rechnung'), 
										new Array('id', $_rechnungID));
		request('./php/delete_data.php', headers).onreadystatechange = function () {
			if (this.readyState == 4 && this.responseText != "1") {
				alert("Es gab einen Fehler beim Datensatz löschen. Bitte erneut versuchen. \n\nFalls das nicht helfen sollte bitte den Seitenadministrator kontaktieren.");
			} else if (this.readyState == 4) {
				CLEAR_rechnung();
				fillElementWithRequest($('select_rechnung'), "./php/get_rechnung_options.php", null, "%null%");
			}
		};
	}
}

function deleteAuftrag() {
	if (confirm("Bist du dir sicher, dass du den ausgewählten Auftrag löschen möchtest?\nDieser Vorgang kann nicht rückgängig gemacht werden.")) {
		var headers = new Array(new Array('table', 'auftrag'), 
										new Array('id', $_auftragID));
		request('./php/delete_data.php', headers).onreadystatechange = function () {
			if (this.readyState == 4 && this.responseText != "1") {
				alert("Es gab einen Fehler beim Datensatz löschen. Bitte erneut versuchen. \n\nFalls das nicht helfen sollte bitte den Seitenadministrator kontaktieren.");
			} else if (this.readyState == 4) {
				CLEAR_auftrag();
				fillElementWithRequest($('select_auftraege'), "./php/get_select_auftraege.php", null, "%null%");
			}
		};
	}
}

function deleteRgpos(delButton) {
	var div = delButton.parentElement;
	var id = div.getAttribute('posid');
	var headers = new Array(new Array('table', 'rechnungsposition'), 
									new Array('id', id));
	request('./php/delete_data.php', headers).onreadystatechange = function () {
		if (this.readyState == 4 && this.responseText != "1") {
			alert("Es gab einen Fehler beim Datensatz löschen. Bitte erneut versuchen. \n\nFalls das nicht helfen sollte bitte den Seitenadministrator kontaktieren.");
		} else if (this.readyState == 4) {
			div.parentNode.removeChild(div);
		}
	};
}

function deleteEmail(delButton) {
	var div = delButton.parentElement;
	var id = div.getAttribute('mailid');
	var headers = new Array(new Array('table', 'email'), 
									new Array('id', id));
	request('./php/delete_data.php', headers).onreadystatechange = function () {
		if (this.readyState == 4 && this.responseText != "1") {
			alert("Es gab einen Fehler beim Datensatz löschen. Bitte erneut versuchen. \n\nFalls das nicht helfen sollte bitte den Seitenadministrator kontaktieren.");
		} else if (this.readyState == 4) {
			div.parentNode.removeChild(div);
		}
	};
}

function deleteTelefon(delButton) {
	var div = delButton.parentElement;
	var id = div.getAttribute('telid');
	var headers = new Array(new Array('table', 'telefon'), 
									new Array('id', id));
	request('./php/delete_data.php', headers).onreadystatechange = function () {
		if (this.readyState == 4 && this.responseText != "1") {
			alert("Es gab einen Fehler beim Datensatz löschen. Bitte erneut versuchen. \n\nFalls das nicht helfen sollte bitte den Seitenadministrator kontaktieren.");
		} else if (this.readyState == 4) {
			div.parentNode.removeChild(div);
		}
	};
}

function deleteKunde() {
	if (confirm("Bist du dir sicher, dass du den ausgewählten Kunden löschen möchtest?\nDieser Vorgang kann nicht rückgängig gemacht werden.")) {
		var headers = new Array(new Array('table', 'kunde'), 
									new Array('id', $_kundeID));
		request('./php/delete_data.php', headers).onreadystatechange = function () {
			if (this.readyState == 4 && this.responseText != "1") {
				alert("Es gab einen Fehler beim Datensatz löschen. Bitte erneut versuchen. \n\nFalls das nicht helfen sollte bitte den Seitenadministrator kontaktieren.");
			} else if (this.readyState == 4) {
				CLEAR_kunde();
				fillElementWithRequest($('select_kunde'), "./php/get_select_kunde.php", null, "%null%");
			}
		};
	}
}

function newTelefon() {
	headers = new Array(new Array('kundeID', $_kundeID));
	request("./php/insertTelefon.php", headers).onreadystatechange = function () {
		if (this.readyState == 4 && this.responseText != "") {
			var telBox = $('div_telefone_box');
			var telDiv = document.createElement('div');
			telDiv.setAttribute("class", "div_telefonnummer");
			telDiv.setAttribute("telid", this.responseText);
			
			var telIn = document.createElement('input');
			telIn.setAttribute("class", "input_telefonnummer");
			telIn.setAttribute("type", "tel");
			telIn.setAttribute("table", "telefon");
			telIn.setAttribute("field", "telefonnummer");
			telIn.setAttribute("onblur", "onValueChange(this);");
			telIn.value = "";
			telDiv.appendChild(telIn);
			
			var selErr = document.createElement('select');
			selErr.setAttribute("class", "select_erreichbar");
			selErr.setAttribute("table", "telefon");
			selErr.setAttribute("field", "erreichbar_id");
			selErr.setAttribute("onblur", "onValueChange(this);");
			telDiv.appendChild(selErr);
			
			var imgDel = document.createElement('img');
			imgDel.setAttribute("class", "button deleteTelefon");
			imgDel.setAttribute("src", "./resources/delete.png");
			imgDel.onclick = function () { deleteTelefon(this); };
			telDiv.appendChild(imgDel);
			
			request("./php/get_select_erreichbars.php").onreadystatechange = function () {
				if (this.readyState == 4) {
					selErr.innerHTML = this.responseText;
					telBox.appendChild(telDiv);
				}
			};
		} else if (this.readyState == 4) {
			alert("Es gab einen Fehler beim Einfügen des Datensatzes. Bitte erneut versuchen.\n\nFalls diese Fehlermeldung erneut erscheint bitte den Seitenadministrator kontaktieren.");
		}
	};
}

function newEmail() {
	headers = new Array(new Array('kundeID', $_kundeID));
	request("./php/insertEmail.php", headers).onreadystatechange = function () {
		if (this.readyState == 4 && this.responseText != "") {
			var mailBox = $('div_emails_box');
			var mailDiv = document.createElement('div');
			mailDiv.setAttribute("class", "div_email");
			mailDiv.setAttribute("mailid", this.responseText);
			
			var mailIn = document.createElement('input');
			mailIn.setAttribute("class", "input_email");
			mailIn.setAttribute("type", "email");
			mailIn.setAttribute("table", "email");
			mailIn.setAttribute("field", "email");
			mailIn.setAttribute("onblur", "onValueChange(this);");
			mailIn.value = "";
			mailDiv.appendChild(mailIn);
			
			var selTyp = document.createElement('select');
			selTyp.setAttribute("class", "select_emailtyp");
			selTyp.setAttribute("table", "email");
			selTyp.setAttribute("field", "emailtyp_id");
			selTyp.setAttribute("onblur", "onValueChange(this);");
			mailDiv.appendChild(selTyp);
			
			var imgDel = document.createElement('img');
			imgDel.setAttribute("class", "button deleteEmail");
			imgDel.setAttribute("src", "./resources/delete.png");
			imgDel.onclick = function () { deleteEmail(this); };
			mailDiv.appendChild(imgDel);
			
			request("./php/get_select_emailtyp.php").onreadystatechange = function () {
				if (this.readyState == 4) {
					selTyp.innerHTML = this.responseText;
					mailBox.appendChild(mailDiv);
				}
			};
		} else if (this.readyState == 4) {
			alert("Es gab einen Fehler beim Einfügen des Datensatzes. Bitte erneut versuchen.\n\nFalls diese Fehlermeldung erneut erscheint bitte den Seitenadministrator kontaktieren.");
		}
	};
}

function newRechnungsposition() {
	headers = new Array(new Array('rechnungID', $_rechnungID));
	request("./php/insertRgpos.php", headers).onreadystatechange = function () {
		if (this.readyState == 4 && this.responseText != "") {
			var posBox = $('div_rechnungspositionen');
			var posDiv = document.createElement('div');
			posDiv.setAttribute("class", "div_rgposition");
			posDiv.setAttribute("posid", this.responseText);
			
			var inBez = document.createElement('input');
			inBez.setAttribute('type', 'text');
			inBez.setAttribute('class', 'input_bezeichnung');
			inBez.setAttribute('onFocus', 'openStandardRgpos(this);');
			inBez.setAttribute('onblur', 'closeStandardRgpos(this);onValueChange(this);');
			inBez.setAttribute('table', 'rechnungsposition');
			inBez.setAttribute('field', 'bezeichnung');
			posDiv.appendChild(inBez);
			
			var inEur = document.createElement('input');
			inEur.setAttribute('type', 'number');
			inEur.setAttribute('step', '0.01');
			inEur.setAttribute('class', 'input_preis');
			inEur.setAttribute('table', 'rechnungsposition');
			inEur.setAttribute('field', 'einzelpreis');
			inEur.setAttribute('onblur', 'onValueChange(this);');
			inEur.value = '0.00';
			posDiv.appendChild(inEur);
			
			var inAnz = document.createElement('input');
			inAnz.setAttribute('type', 'number');
			inAnz.setAttribute('step', '1');
			inAnz.setAttribute('class', 'input_menge');
			inAnz.setAttribute('min', '1');
			inAnz.setAttribute('table', 'rechnungsposition');
			inAnz.setAttribute('field', 'anzahl');
			inAnz.setAttribute('onblur', 'onValueChange(this);');
			inAnz.value = 1;
			posDiv.appendChild(inAnz);
			
			var imgDel = document.createElement('img');
			imgDel.setAttribute("class", "button deleteRgposition");
			imgDel.setAttribute("src", "./resources/delete.png");
			imgDel.onclick = function () { deleteRgpos(this); };
			posDiv.appendChild(imgDel);
			
			posBox.appendChild(posDiv);
			updateListeners();
		} else if (this.readyState == 4) {
			alert("Es gab einen Fehler beim Einfügen des Datensatzes. Bitte erneut versuchen.\n\nFalls diese Fehlermeldung erneut erscheint bitte den Seitenadministrator kontaktieren.");
		}
	};
}

function openStandardRgpos(inputElement) {
	var e = inputElement;
	
}

function closeStandardRgpos(inputElement) {
	var e = inputElement;
}
