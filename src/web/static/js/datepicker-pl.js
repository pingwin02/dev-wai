( function( factory ) {
	"use strict";

	if ( typeof define === "function" && define.amd ) {

		define( [ "../widgets/datepicker" ], factory );
	} else {

		factory( jQuery.datepicker );
	}
} )( function( datepicker ) {
"use strict";

datepicker.regional.pl = {
	closeText: "Zamknij",
	prevText: "Poprzedni",
	nextText: "Następny",
	currentText: "Dziś",
	monthNames: [ "Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec",
	"Lipiec", "Sierpień", "Wrzesień", "Październik", "Listopad", "Grudzień" ],
	monthNamesShort: [ "Sty", "Lu", "Mar", "Kw", "Maj", "Cze",
	"Lip", "Sie", "Wrz", "Pa", "Lis", "Gru" ],
	dayNames: [ "Niedziela", "Poniedziałek", "Wtorek", "Środa", "Czwartek", "Piątek", "Sobota" ],
	dayNamesShort: [ "Nie", "Pn", "Wt", "Śr", "Czw", "Pt", "So" ],
	dayNamesMin: [ "N", "Pn", "Wt", "Śr", "Cz", "Pt", "So" ],
	weekHeader: "Tydz",
	dateFormat: "dd.mm.yy",
	firstDay: 1,
	isRTL: false,
	showMonthAfterYear: false,
	yearSuffix: "" };
datepicker.setDefaults( datepicker.regional.pl );

return datepicker.regional.pl;

} );