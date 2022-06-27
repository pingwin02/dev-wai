$(document).ready(function() {
	pierwsza();
});

var x = "#tresc, table, th, td, #tresc a, header, footer, footer a, .ciemnahr, body, #galeria, .tytul, li, ul, .lista-zaw";

function pierwsza() {
	if (getValue() == 0) {
		$(x).removeClass("dark");
		$(".darkmodebutton").text("WYŁ");
		console.log("wykryto tryb " + getValue());
	} else if (getValue() == 1) {
		$(x).addClass("dark");
		$(".darkmodebutton").text("WŁ");
		console.log("wykryto tryb " + getValue());
	}
}
$(".darkmodebutton").on("click", function() {
	if (getValue() == 1) {
		$("body").css("display", "none");
		$(document.body).fadeIn(500);
		$(x).removeClass("dark");
		$(".darkmodebutton").text("WYŁ");
		off();
		console.log(getValue());
	} else {
		$("body").css("display", "none");
		$(document.body).fadeIn(500);
		$(x).addClass("dark");
		$(".darkmodebutton").text("WŁ");
		on();
		console.log(getValue());
	}
});

function off() {
	localStorage.setItem('ciemnosc', '0');
}

function on() {
	localStorage.setItem('ciemnosc', '1');
}

function getValue() {
	return localStorage.getItem('ciemnosc');
}