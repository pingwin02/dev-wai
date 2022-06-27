var linki = ["https://heavens-above.com", "https://spotthestation.nasa.gov/tracking_map.cfm", "https://facebook.com/ZGlowaWGwiazdach/", "https://play.google.com/store/apps/details?id=com.vitotechnology.StarWalk2"]
var nazwa = ["Heavens Above", "Live ISS Map", "Z Głową W Gwiazdach", "Star Walk 2"]
var opisy = ["serwis internetowy pozwalający na określenie terminów przelotów satelitów oraz generujący prognozy ich widoczności dla dowolnego punktu na Ziemi", "strona pokazująca aktualne położenie Międzynarodowej Stacji Kosmicznej (ISS)", "blog popularyzatora astronomii Karola Wójcickiego. Warto go śledzić, by być na bieżąco", "aplikacja na telefon ułatwiająca obserwację nieba. Istnieje również jej bezpłatna wersja"]
var btnlinki = document.getElementById("linki");
$(document).ready(function() {
	pierwsza1();
});

function pierwsza1() {
	if (getValue1() == 0) {
		btnlinki.innerHTML = 'Rozwiń';
		console.log("Zwinięte " + getValue1());
	} else if (getValue1() == 1) {
		rozwiniecie();
		btnlinki.innerHTML = 'Zwiń';
		console.log("Rozwinięte " + getValue1());
	}
}
$("#linki").on("click", function() {
	if (getValue1() == 1) {
		zwiniecie();
		btnlinki.innerHTML = 'Rozwiń';
		off1();
		console.log(getValue1());
	} else {
		rozwiniecie();
		btnlinki.innerHTML = 'Zwiń';
		on1();
		console.log(getValue1());
	}
});

function rozwiniecie() {
	for (var i = 0; i < 4; i++) {
		var linia = document.createElement("UL");
		var link = document.createElement("A");
		link.href = linki[i];
		link.target = "_blank";
		var tekst = document.createTextNode(nazwa[i]);
		var opis = document.createTextNode(" - " + opisy[i]);
		linia.appendChild(link);
		link.appendChild(tekst);
		linia.appendChild(opis);
		linia.id = "#" + i;
		linia.className = "rozwlista";
		document.getElementById("myDIV").appendChild(linia);
	}
}

function zwiniecie() {
	for (var i = 0; i < 4; i++) {
		var linia = document.getElementById("#" + i);
		document.getElementById("myDIV").removeChild(linia);
	}
}

function off1() {
	sessionStorage.setItem('stan_zwiniecia', '0');
}

function on1() {
	sessionStorage.setItem('stan_zwiniecia', '1');
}

function getValue1() {
	return sessionStorage.getItem('stan_zwiniecia');
}