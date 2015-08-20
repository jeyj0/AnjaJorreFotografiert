/**
 * @param element: the element to set the value of
 * @param requestFile: the file to request
 * @param headers: optional headers for the request
 */
function setElementsValueWithRequest(element, requestFile, headers) {
	/**
	 * @param element: the element to fill
	 * @param requestFile: the file to request
	 * @param headers: optional headers for the request
	 */
	request(requestFile, headers).onreadystatechange = function() {
		if (this.readyState == 4) {
			if (element.type == "checkbox") {
				element.checked = this.responseText;
			} else {
				element.value = this.responseText;
			}
		}
	};
}

/**
 * @param element: the element to fill
 * @param requestFile: the file to request
 * @param headers: optional headers for the request
 */
function fillElementWithRequest(element, requestFile, headers, val, fireChange) {
	/**
	 * @param element: the element to fill
	 * @param requestFile: the file to request
	 * @param headers: optional headers for the request
	 */
	request(requestFile, headers).onreadystatechange = function() {
		if (this.readyState == 4) {
			element.innerHTML = this.responseText;
			if (val) {
				val = val == "%null%" ? null : val;
				element.value = val;
				if (fireChange == true) fireEvent(element, "change");
			}
		}
	};
}

/** 
 * requests a file on the server (asynchronous)
 * @return the XMLHttpRequest-Object 
 */
function request(file, headers) {
	headers = headers ? headers : new Array();

	if (window.XMLHttpRequest) {
		var XMLHttp = new XMLHttpRequest();
	} else {
		var XMLHttp = new ActiveXObject("Microsoft.XMLHTTP");
	}

	XMLHttp.open("GET", file, true);
	headers.forEach(function(element) {
		XMLHttp.setRequestHeader(element[0], element[1]);
	});
	XMLHttp.send(null);
	return XMLHttp;
}

function urlencode(str) {
	//       discuss at: http://phpjs.org/functions/urlencode/
	//      original by: Philip Peterson
	//      improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	//      improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	//      improved by: Brett Zamir (http://brett-zamir.me)
	//      improved by: Lars Fischer
	//         input by: AJ
	//         input by: travc
	//         input by: Brett Zamir (http://brett-zamir.me)
	//         input by: Ratheous
	//      bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	//      bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	//      bugfixed by: Joris
	// reimplemented by: Brett Zamir (http://brett-zamir.me)
	// reimplemented by: Brett Zamir (http://brett-zamir.me)
	//             note: This reflects PHP 5.3/6.0+ behavior
	//             note: Please be aware that this function expects to encode into UTF-8 encoded strings, as found on
	//             note: pages served as UTF-8
	//        example 1: urlencode('Kevin van Zonneveld!');
	//        returns 1: 'Kevin+van+Zonneveld%21'
	//        example 2: urlencode('http://kevin.vanzonneveld.net/');
	//        returns 2: 'http%3A%2F%2Fkevin.vanzonneveld.net%2F'
	//        example 3: urlencode('http://www.google.nl/search?q=php.js&ie=utf-8&oe=utf-8&aq=t&rls=com.ubuntu:en-US:unofficial&client=firefox-a');
	//        returns 3: 'http%3A%2F%2Fwww.google.nl%2Fsearch%3Fq%3Dphp.js%26ie%3Dutf-8%26oe%3Dutf-8%26aq%3Dt%26rls%3Dcom.ubuntu%3Aen-US%3Aunofficial%26client%3Dfirefox-a'

	str = (str + '').toString();

	// Tilde should be allowed unescaped in future versions of PHP (as reflected below), but if you want to reflect current
	// PHP behavior, you would need to add ".replace(/~/g, '%7E');" to the following.
	return encodeURIComponent(str).replace(/!/g, '%21').replace(/'/g, '%27').replace(/\(/g, '%28').replace(/\)/g, '%29').replace(/\*/g, '%2A').replace(/%20/g, '+');
}