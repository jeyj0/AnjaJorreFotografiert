function setOffset(id) {
	// TODO s. getOffset()
}

function getOffset(id) {
    // (0)
    var elem = $(id);
    
    // (1)
    var box = elem.getBoundingClientRect()
    
    var body = document.body
    var docElem = document.documentElement
    
    // (2)
    var scrollTop = window.pageYOffset || docElem.scrollTop || body.scrollTop
    var scrollLeft = window.pageXOffset || docElem.scrollLeft || body.scrollLeft
    
    // (3)
    var clientTop = docElem.clientTop || body.clientTop || 0
    var clientLeft = docElem.clientLeft || body.clientLeft || 0
    
    // (4)
    var top  = box.top +  scrollTop - clientTop
    var left = box.left + scrollLeft - clientLeft
    
    return { top: Math.round(top), left: Math.round(left) }
}

function fireEvent(element, e){
   if (document.createEventObject){
		// dispatch for IE
		var evt = document.createEventObject();
		return element.fireEvent('on' + e, evt)
   } else {
		// dispatch for firefox + others
		var evt = document.createEvent("HTMLEvents");
		evt.initEvent(e, true, true); // event type,bubbling,cancelable
	   return !element.dispatchEvent(evt);
   }
}

function disableForPopup() {
	var header = $('div_header');
	var kunde = $('div_kunde');
	var auftrag = $('div_auftrag');
	var footer = $('div_footer');
	var all = new Array(header, kunde, auftrag, footer);
	
	var disable = function (element) {
		var e = element;
		alert('Got here.');
		if (e.isPrototypeOf(Array)) {
			alert('isArray');
			e.forEach(disable);
		} else /*if (e.isPrototypeOf(DOM))*/ {
			alert(e.prototype.name);
		}
	}
	
	all.forEach(disable);
}

function setAttributeOfElements(elements, att, val) {
	if (!elements.isPrototypeOf(Array)) {
		$logerr("Expected array, got " + elements.prototype + ". [setAttributeOfElements(elements) > param: elements]");
	} else {
		elements.forEach(function (element) {
			element.setAttribute(att, val)
		});
	}
}

function setValueOfElements(elements, val) {
	if (!elements.isPrototypeOf(Array)) {
		$logerr("Expected array, got " + elements.prototype + ". [setAttributeOfElements(elements) > param: elements]");
	} else {
		elements.forEach(function (element) {
			element.value = val;
		});
	}
}

function delElement(element) {
	element.parentNode.removeChild(element);
}

function hideElement(element) {
	element.style.display = "none";
}

function showElement(element) {
	element.style.display = "block";
}

/**
 * @param id: id or classname (with prefix '#')
 * @param element [optional]: parent-element.
 */
function $(id, element) {
	if (id.substr(0, 1) != '#')
		return document.getElementById(id);
	else {
		var className = id;
		element = element ? element.substr(1, element.length - 1) : document;

		var muster = new RegExp("(^|\\s)" + className + "(\\s|$)");
		var all = element.getElementsByTagName("*");
		var found = new Array();

		for (var i = 0; i < all.length; i++) {
			if (all[i] && all[i].className && all[i].className != "") {
				if (all[i].className.match(muster)) // for cases as class="xyz abc"
					found[found.length] = all[i];
			}
		}
		
		return found;
	}
}

function $log(str) {
	console.info(str);
}

function $logerr(str) {
	console.err(str);
}
