function mainSetup() {
	$log('Starting main setup.');
	
	hideElement($('div_kunde'));
	hideElement($('div_auftrag'));
	hideElement($('input_rechnungsdatum'));
	hideElement($('div_rechnungspositionen'));
	hideElement($('div_rechnungsbuttons'));
	hideElement($('div_diesesJahr'));
	hideElement($('div_gesamt'));
	hideElement($('div_durchschnitt'));
	hideElement($('div_minmax'));

	fillElementWithRequest($('select_kunde'), "./php/get_select_kunde.php", null, "%null%");
	fillElementWithRequest($('select_anrede'), "./php/get_select_anrede.php", null, "%null%");
	fillElementWithRequest($('newKunde_selectAnrede'), "./php/get_select_anrede.php", null, "%null%");
	fillElementWithRequest($('select_auftragsart'), "./php/get_select_auftragsart.php", null, "%null%");
	fillElementWithRequest($('newAuftrag_selectArt'), "./php/get_select_auftragsart.php", null, "%null%");
	
	CLEAR_newAdresse();
	
	$_allFieldIDs.forEach(function (element) {
		e = $(element[0]);
		e.setAttribute('table', element[1]);
		e.setAttribute('field', element[2]);
		e.setAttribute('onblur', 'onValueChange(this);');
	});
	
	$("input_auftrag_kundeDateien").setAttribute('onblur', 'onFotoortChange(0)');
	$("input_auftrag_mamaDateien").setAttribute('onblur', 'onFotoortChange(1)');
	$("input_unbekanntVerzogen").setAttribute('onblur', 'onUnbekanntVerzogen()');
	
	var onChangeBlur = function (element) {
		var onchange = element.getAttribute('onChange');
		onchange = (onchange != null) ? (onchange + ';fireEvent(this, "blur");') : ('fireEvent(this, "blur");');
		element.setAttribute('onChange', onchange);
	};
	Array.prototype.slice.call(document.getElementsByTagName('select')).forEach(onChangeBlur);
	Array.prototype.slice.call(document.querySelectorAll('input[type="checkbox"]')).forEach(onChangeBlur);
	
	$('div_bemerkung').style.display = 'none';
	$('div_selectExtra').style.display = 'none';
	$('div_extraBody').style.display = 'none';
	
	onSetupFinished();
}

function onSetupFinished() {
	$log('Setup finished.');
	$_mainSetupFinished = true;
	if ($_mainAnimationEnded) {
		hideElement($('iframe_mainload'));
		$log('Intro hidden.');
	}
}
