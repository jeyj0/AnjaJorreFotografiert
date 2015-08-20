function saveGefundenUeber() {
	request("./php/saveCfgGefundenUeber.php", new Array(new Array('text', encodeURIComponent($('cfg_gefundenUeber').value))));
}

function saveRgpos() {
	request("./php/saveCfgRgpos.php", new Array(new Array('text', encodeURIComponent($('cfg_rgpos').value))));
}

function openAuswertungen() {
	$('div_selectExtra').style.display = 'none';
	$('select_kunde').style.display = 'none';
	$('button_kunde_new').style.display = 'none';
	$('button_bemerkung').style.display = 'none';
	CLEAR_kunde();
	$('div_extraBody').style.display = 'block';
	$('div_cfg_gefundenUeber').style.display = 'none';
	$('div_cfg_rgpos').style.display = 'none';
	$('div_auswertungen').style.display = 'block';
}

function openConfigurationsRgpos() {
	$('div_selectExtra').style.display = 'none';
	$('select_kunde').style.display = 'none';
	$('button_kunde_new').style.display = 'none';
	$('button_bemerkung').style.display = 'none';
	CLEAR_kunde();
	request("./cfg/rgpos.cfg").onreadystatechange = function () {
		if (this.readyState == 4) {
			$('cfg_rgpos').value = decodeURIComponent(this.responseText);
		}
	};
	$('div_extraBody').style.display = 'block';
	$('div_cfg_gefundenUeber').style.display = 'none';
	$('div_auswertungen').style.display = 'none';
	$('div_cfg_rgpos').style.display = 'block';
}

function openConfigurationsGefundenUeber() {
	$('div_selectExtra').style.display = 'none';
	$('select_kunde').style.display = 'none';
	$('button_kunde_new').style.display = 'none';
	$('button_bemerkung').style.display = 'none';
	CLEAR_kunde();
	request("./cfg/gefunden_ueber.cfg").onreadystatechange = function () {
		if (this.readyState == 4) {
			$('cfg_gefundenUeber').value = decodeURIComponent(this.responseText);
		}
	};
	$('div_extraBody').style.display = 'block';
	$('div_cfg_rgpos').style.display = 'none';
	$('div_auswertungen').style.display = 'none';
	$('div_cfg_gefundenUeber').style.display = 'block';
}

function openDatasite() {
	$('div_selectExtra').style.display = 'none';
	$('div_extraBody').style.display = 'none';
	$('select_kunde').style.display = 'block';
	$('button_kunde_new').style.display = 'block';
	$('button_bemerkung').style.display = 'block';
}

function selectExtra() {
	$('div_selectExtra').style.display = 'block';
	$('div_selectExtra').onmouseleave = function () {
		$('div_selectExtra').style.display = 'none';
	};
}

function onMainanimationEnded() {
	$log('Main animation ended.');
	$_mainAnimationEnded = true;
	if ($_mainSetupFinished) {
		hideElement($('iframe_mainload'));
		$log('Intro hidden.');
	}
}

function changeBemerkungState() {
	if ($('div_bemerkung').style.display == 'none' && $_kundeID != null) {
		$('div_bemerkung').style.display = 'block';
	} else if ($('div_bemerkung').style.display != 'none') {
		$('div_bemerkung').style.display = 'none';
	}
}

function onUnbekanntVerzogen() {
	var value = $('input_unbekanntVerzogen').checked;
	if (value) {
		var headers = new Array(new Array('table', 'kunde'), 
										new Array('field', 'unbekannt_verzogen'), 
										new Array('value', 'true'), 
										new Array('id', $_kundeID));
		request("./php/updateValue.php", headers).onreadystatechange = function () {
			if (this.readyState == 4 && this.responseText.substr(0, 1) != "1") {
				alert("Es gab einen Fehler beim updaten eines Wertes. Bitte lade die Seite neu und versuche es erneut. \n\nFalls diese Fehlermeldung dann auch erscheint bitte den Seitenadmin kontaktieren.");
			}
		};
		var headers = new Array(new Array('kundeID', $_kundeID));
		request("./php/setUnbekanntVerzogen.php", headers).onreadystatechange = function () {
			if (this.readyState == 4 && this.responseText.substr(0, 1) != "1") {
				alert("Es gab einen Fehler beim updaten eines Wertes. Bitte lade die Seite neu und versuche es erneut. \n\nFalls diese Fehlermeldung dann auch erscheint bitte den Seitenadmin kontaktieren.");
			}
		};
	} else if (!value) {
		var headers = new Array(new Array('table', 'kunde'), 
										new Array('field', 'unbekannt_verzogen'), 
										new Array('value', 'false'), 
										new Array('id', $_kundeID));
		request("./php/updateValue.php", headers).onreadystatechange = function () {
			if (this.readyState == 4 && this.responseText.substr(0, 1) != "1") {
				alert("Es gab einen Fehler beim updaten eines Wertes. Bitte lade die Seite neu und versuche es erneut. \n\nFalls diese Fehlermeldung dann auch erscheint bitte den Seitenadmin kontaktieren.");
			}
		};
	}
}

function onFotoortChange(checkbox) {
	var v1 = $('input_auftrag_mamaDateien').checked ? 1 : 0;
	var v2 = $('input_auftrag_kundeDateien').checked ? 4 : 2;
	var value = v1 + v2;
	var headers = new Array(new Array('table', 'auftrag'), 
									new Array('field', 'dateiorte'), 
									new Array('value', value), 
									new Array('id', $_auftragID));
	request("./php/updateValue.php", headers).onreadystatechange = function () {
		if (this.readyState == 4 && this.responseText.substr(0, 1) != "1") {
			alert("Es gab einen Fehler beim updaten eines Wertes. Bitte lade die Seite neu und versuche es erneut. \n\nFalls diese Fehlermeldung dann auch erscheint bitte den Seitenadmin kontaktieren.");
		}
	}
}

function onValueChange(e) {
	var table = e.getAttribute("table");
	var field = e.getAttribute("field");
	if (e.getAttribute('type') != "checkbox") {
		var value = e.value != "" ? e.value : "%null%";
	} else {
		var value = e.checked ? "1" : "0";
	}
	var id = getIDbyTablename(table, e);
	
	var headers = new Array(new Array('table', table), 
									new Array('field', field), 
									new Array('value', value), 
									new Array('id', id));
	request("./php/updateValue.php", headers).onreadystatechange = function () {
		if (this.readyState == 4 && this.responseText.substr(0, 1) == "1") {
			var res = this.responseText.substr(1, this.responseText.length - 1);
			if (res == "kunde.vorname" || res == "kunde.name") {
				fillElementWithRequest($('select_kunde'), "./php/get_select_kunde.php", null, $_kundeID);
			}
			if (res == "auftrag.datum") {
				fillElementWithRequest($('select_auftraege'), "./php/get_select_auftraege.php?id=" + $_kundeID, null, $_kundeID);
			}
		} else if (this.readyState == 4) {
			alert("Es gab einen Fehler beim updaten eines Wertes. Bitte lade die Seite neu und versuche es erneut. \n\nFalls diese Fehlermeldung dann auch erscheint bitte den Seitenadmin kontaktieren.");
		}
	};
}

function getIDbyTablename(table, e) {
	switch(table) {
		case 'kunde':
			return $_kundeID;
		case 'telefon':
			return e.parentElement.getAttribute('telid');
		case 'email':
			return e.parentElement.getAttribute('mailid');
		case 'adresse':
			return $_adressID;
		case 'auftrag':
			return $_auftragID;
		case 'rechnung':
			return $_rechnungID;
		case 'rechnungsposition':
			return e.parentElement.getAttribute('posid');
	}
}
