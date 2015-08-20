var $_mainAnimationEnded = false;
var $_mainSetupFinished = true;

// [ FieldID , Tablename , Fieldname ]
var $_allFieldIDs = new Array(["select_anrede", "kunde", "anrede_id"], 
										["input_vorname", "kunde", "vorname"], 
										["input_name", "kunde", "name"], 
										["txtarea_bemerkung", "kunde", "bemerkung"], 
										//["input_unbekanntVerzogen", "kunde", "unbekannt_verzogen"], 
										["input_strasse", "adresse", "strasse"], 
										["input_hausnummer", "adresse", "hausnummer"], 
										["input_adresszusatz", "adresse", "adresszusatz"], 
										["input_postleitzahl", "adresse", "postleitzahl"], 
										["input_ort", "adresse", "ort"], 
										["input_land", "adresse", "land"], 
										["input_gueltigab", "adresse", "gueltig_ab"], 
										["input_gueltigbis", "adresse", "gueltig_bis"], 
										["input_auftragsdatum", "auftrag", "datum"], 
										["select_auftragsart", "auftrag", "art_id"], 
										//["input_auftrag_kundeDateien", "auftrag"], 
										//["input_auftrag_mamaDateien", "auftrag"], 
										["txtarea_auftragsbemerkung", "auftrag", "bemerkung"], 
										["input_auftrag_ausstellungserlaubnis", "auftrag", "ausstellung"], 
										["txtarea_auftragsausstellungsbemerkung", "auftrag", "ausstellungsbemerkung"], 
										["input_rechnungsdatum", "rechnung", "datum"]);

/*
 * IDs
 */
var $_kundeID;
var $_kundenadressIDs;
var $_kundenautragIDs;

var $_adressID;

var $_auftragID;
var $_auftragsrechnungsIDs;

var $_rechnungID;
var $_rechnungspositionenIDs;
