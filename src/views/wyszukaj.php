<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="utf-8">
	<title>Kosmiczne zdjęcia - Wyszukiwarka</title>
	<meta content="Najciekawsze zdjęcia z kosmosu!" name="description">
	<meta content="zdjecia,kosmos,konkurs,astrofotografia,planety,komety,gwiazdy" name="keywords">
	<meta content="Damian Jankowski" name="author">
	<meta content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=yes" name="viewport">
	<link href="static/css/main.css" rel="Stylesheet" type="text/css">
	<link href="static/css/fontello.css" rel="Stylesheet" type="text/css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="static/js/fade-in.js"></script>
	<script src="static/js/ajax.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Balsamiq%20Sans" rel='stylesheet'>
	<link href="static/images/favicon.ico" rel="Shortcut icon">
	<meta content="noindex, nofollow" name="robots">
	<noscript>
		<style>
			body{display:block}#tepacz,.darkmodediv{display:none}
		</style>
	</noscript>
</head>
<body>
	<div id="cointainer">
		<div class="darkmodediv">
			<svg class="noc" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
			<rect fill="none" height="24" width="24"></rect>
			<path d="M9.37,5.51C9.19,6.15,9.1,6.82,9.1,7.5c0,4.08,3.32,7.4,7.4,7.4c0.68,0,1.35-0.09,1.99-0.27C17.45,17.19,14.93,19,12,19 c-3.86,0-7-3.14-7-7C5,9.07,6.81,6.55,9.37,5.51z M12,3c-4.97,0-9,4.03-9,9s4.03,9,9,9s9-4.03,9-9c0-0.46-0.04-0.92-0.1-1.36 c-0.98,1.37-2.58,2.26-4.4,2.26c-2.98,0-5.4-2.42-5.4-5.4c0-1.81,0.89-3.42,2.26-4.4C12.92,3.04,12.46,3,12,3L12,3z"></path></svg><span class="darkmodebutton">WYŁ</span>
		</div>
		<header>
			<svg viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
			<path d="M0 0h24v24H0V0z" fill="none"></path>
			<path class="tytul" d="M14.12 4l1.83 2H20v12H4V6h4.05l1.83-2h4.24M15 2H9L7.17 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2h-3.17L15 2zm-3 7c1.65 0 3 1.35 3 3s-1.35 3-3 3-3-1.35-3-3 1.35-3 3-3m0-2c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5z"></path></svg> <span class="tytul">Kosmiczne zdjęcia!</span>
			<hr class="ciemnahr">
		</header>
		<nav>
			<ul>
				<li>
					<a href="glowna"><i class="icon-home"></i>Strona Główna</a>
				</li>
				<li>
					<a href="przeslij"><i class="icon-upload"></i>Prześlij</a>
				</li>
				<li class="lista">
					<a class="lista-guzik active" href="#"><i class="icon-art-gallery"></i>Galeria &darr;</a>
					<div class="lista-zaw">
						<a class="active" href="galeria"><i class="icon-lock"></i>Zgłoszone zdjęcia</a> <a href="galeria-2020">2020</a> <a href="galeria-2019">2019</a>
					</div>
				</li>
				<li class="prawo">
					<a href="o-mnie"><i class="icon-adult"></i>Autor</a>
				</li>
			</ul>
		</nav>
		<div id="galeria">
			<hr class="ciemnahr">
			
			<h1>Wyszukaj zdjęcie</h1>
			<p>Minimum 3 znaki:</p>
			<input id="search" placeholder="Zacznij wpisywać tytuł" type="text"/><br>
			<div id="result"></div>
			<div class='srodek'>
            <button onclick='window.location.href="galeria"'>Powrót</button><br>
				<br><button id="tepacz" onclick='window.scrollTo({top: 0, behavior: "smooth"});'>Do góry &uarr;</button>
			</div>
			<hr class="ciemnahr">
		</div>
		<footer>
			2021-2022 &copy; Damian Jankowski — Kosmiczne zdjęcia! <i class="icon-mail-alt"></i> <a href="mailto:s188597@student.pg.edu.pl">s188597@student.pg.edu.pl</a>
		</footer>
	</div>
	<script src="static/js/darkmode.js">
	</script>
</body>
</html>