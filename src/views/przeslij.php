<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="utf-8">
	<title>Kosmiczne zdjęcia - Prześlij</title>
	<meta content="Najciekawsze zdjęcia z kosmosu!" name="description">
	<meta content="zdjecia,kosmos,konkurs,astrofotografia,planety,komety,gwiazdy" name="keywords">
	<meta content="Damian Jankowski" name="author">
	<meta content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=yes" name="viewport">
	<link href="static/css/main.css" rel="Stylesheet" type="text/css">
	<link href="static/css/fontello.css" rel="Stylesheet" type="text/css">
	<link href="https://code.jquery.com/ui/1.13.0/themes/smoothness/jquery-ui.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
	<script src="static/js/datepicker-pl.js"></script>
	<script src="static/js/warning.js"></script>
	<script src="static/js/fade-in.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Balsamiq%20Sans" rel='stylesheet'>
	<link href="static/images/favicon.ico" rel="Shortcut icon">
	<meta content="noindex, nofollow" name="robots">
	<noscript>
		<style>
		body{display:block}#tepacz,.darkmodediv,#dialog_button,#datepicker,.datepicker{display:none}#nojs-reset,#data,.data{display:inline-block}
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
					<a class="active" href="przeslij"><i class="icon-upload"></i>Prześlij</a>
				</li>
				<li class="lista">
					<a class="lista-guzik" href="#"><i class="icon-art-gallery"></i>Galeria &darr;</a>
					<div class="lista-zaw">
						<a href="galeria"><i class="icon-lock"></i>Zgłoszone zdjęcia</a> <a href="galeria-2020">2020</a> <a href="galeria-2019">2019</a>
					</div>
				</li>
				<li class="prawo">
					<a href="o-mnie"><i class="icon-adult"></i>Autor</a>
				</li>
			</ul>
		</nav>
		<div id="tresc">
			<hr class="ciemnahr">
			<div class="srodek">
				<h1>By przesłać własne zdjęcie wypełnij ten formularz:</h1>
				<?php
				if (isset($_SERVER["CONTENT_LENGTH"])&&($_SERVER["CONTENT_LENGTH"]>((int)ini_get('post_max_size') * 1024 * 1024))) {
					$resultCode=1;
				}
				if(isset($resultCode)) {
						switch ($resultCode) {
							case 0:
								echo " <p style=color:green;>Wysłano!</p>";
							break;
							case 1:
								echo " <p style=color:red;>Błąd przesyłania: Plik za duży!</p>";
							break;
							case 2:
								echo " <p style=color:red;>Błąd przesyłania: Plik musi być zdjęciem w formacie .jpg lub .png!</p>";
							break;
							case 3:
								echo " <p style=color:red;>Błąd przesyłania: Plik już istnieje!</p>";
							break;
							case 4:
								echo " <p style=color:red;>Błąd przesyłania: Uszkodzony plik!</p>";
							break;
							case 5:
								echo " <p style=color:red;>Błąd przesyłania: Problem z wysłaniem pliku</p>";
							break;
					}
				}    
				?>
				<form action="przeslij" id="przesylanie" method="post" enctype="multipart/form-data">
					<fieldset>
						<legend>Dane osobowe</legend> <label for="autor">Autor:</label> <input id="id_autor" maxlength="60" name="nazwa_autor" <?php if (isset($_SESSION["logged_in"])) {echo "value='".$_SESSION["account_id"]."' readonly title='Zmiana zablokowana'";}?> placeholder="Podaj imię i nazwisko" required type="text"><br>
						<label for="email">Adres email:</label> <input id="email" name="email" placeholder="Podaj adres mail" required type="email"><br class="zlam-smartfon">
						<label for="tel">Numer telefonu:</label> <input id="tel" name="tel" placeholder="123-456-789" title="Opcjonalnie" type="tel" size="11" maxlength="11" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}">
					</fieldset>
					<fieldset>
						<legend>Dane dot. zdjęcia</legend> <label for="tytul">Podaj tytuł zdjęcia:</label> <input id="id_tytul" name="nazwa_tytul" title="Tytuł będzie wyświetlony w galerii zdjęć" maxlength="30" minlength="3" placeholder="Podaj tytuł zdjęcia" required size="30" type="text"><br>
						<label for="miejsce">Miejsce wykonania zdjęcia:</label> <input id="miejsce" maxlength="30" name="miejsce" placeholder="Podaj miejsce" required title="Podaj pełną nazwę miejsca" type="text"><br>
						<label class="data" for="data">Data zrobienia zdjęcia:</label> <input id="data" min="2021-01-01" name="data" required title="Zdjęcie musi być nowe" type="date" value="2021-01-01"> <label class="datepicker" for="datepicker">Data zrobienia zdjęcia:</label><input id="datepicker" name="data-js" placeholder="Kliknij, aby wybrać datę" type="text" required><br>
						<label for="znak-wodny">Znak wodny:</label> <input id="znak-wodny" size="30" maxlength="30" name="znak-wodny" placeholder="Podaj treść znaku wodnego" required type="text"><br>
						<input id="id_plik" name="nazwa_plik" required title="Akceptowane są tylko pliki .jpg .png. Max 1 MB" type="file"><br><br>
						Ustaw widoczność zdjęcia:<br>
						<label for="pub">Publiczne</label> <input type="radio" id="pub" name="widocznosc" value="1"  <?php if (!isset($_SESSION["logged_in"])) {echo "title='Zmiana dostępna tylko dla zalogowanych' ";}?> checked>
						<label for="pryw">Prywatne</label> <input type="radio" id="pryw" name="widocznosc" value="0" <?php if (!isset($_SESSION["logged_in"])) {echo "title='Zmiana dostępna tylko dla zalogowanych' disabled";}?>><br><br>
						<label class="srodek" for="komentarz">Komentarz:</label><br><textarea id="komentarz" name="komentarz" rows="5" cols="55" maxlength="1000" placeholder="Dodaj komentarz do zdjęcia (opcjonalnie)" title="Napisz coś o sobie, o zdjęciu, czy było ono zaplanowane..."></textarea>
					</fieldset>
					<fieldset>
						<legend>Zgody</legend> <input id="zgoda" name="zgoda" required title="Zgodnie z Rozporządzeniem Parlamentu Europejskiego i Rady (UE) 2016/679 z dnia 27 kwietnia 2016 r." type="checkbox">Wyrażam zgodę na przetwarzanie moich danych osobowych dla potrzeb konkursu.<br><br>
						Czy chcesz otrzymać wyniki konkursu na adres mailowy?<br>
						<label for="Tak">Tak</label> <input type="radio" id="Tak" name="wyniki_mail" value="1" checked>
						<label for="Nie">Nie</label> <input type="radio" id="Nie" name="wyniki_mail" value="0">
					</fieldset>
					<?php
					if (isset($_SESSION["logged_in"])) {
						echo "<p>Wysyłasz jako <strong>".$_SESSION["account_id"]."</strong></p>";
					}
					else {
						echo "<p>Wysyłasz jako <strong>anonim</strong></p>";
					}
					?>
					<input type="submit" name="submit" value="Wyślij"><input id="dialog_button" type="button" value="Wyczyść"><input id="nojs-reset" type="reset" value="Wyczyść">
				</form>
			</div>
			<div id="dialog" style="display:none" title="Wyczyść">
				<p class="srodek">Czy jesteś pewny?</p>
			</div>
			<hr>
			<div class="srodek">
				Najlepsze fotografie zostaną wybrane i będą widoczne w galerii. Zobacz zdjęcia z <select name="lata" onchange="location = this.value;">
					<option value="#">
						Wybierz rok
					</option>
					<option value="galeria-2020">
						2020
					</option>
					<option value="galeria-2019">
						2019
					</option>
				</select> roku.
			</div>
			<h2 class="srodek">Laureaci konkursu z poprzednich lat</h2>
			<table>
				<tr>
					<th>Rok</th>
					<th>Autor</th>
					<th>Fotografowany obiekt</th>
				</tr>
				<tr>
					<td rowspan="5">2020</td>
					<td>Jakub Bliski</td>
					<td>Wenus</td>
				</tr>
				<tr>
					<td>Karolina Zimna</td>
					<td>Zorza polarna</td>
				</tr>
				<tr>
					<td>Maciej Mały</td>
					<td>Merkury</td>
				</tr>
				<tr>
					<td>Damian Jankowski</td>
					<td>Starlinki</td>
				</tr>
				<tr>
					<td>Stefan Lato</td>
					<td>Kometa NEOWISE</td>
				</tr>
				<tr>
					<td rowspan="5">2019</td>
					<td>Paweł Gazowy</td>
					<td>Jowisz</td>
				</tr>
				<tr>
					<td>Damian Jankowski</td>
					<td>Zaćmienie Słońca</td>
				</tr>
				<tr>
					<td>Michał Gorący</td>
					<td>Słońce</td>
				</tr>
				<tr>
					<td>Krzysztof Czarny</td>
					<td>Czarna Dziura</td>
				</tr>
				<tr>
					<td>Szymon Mleczny</td>
					<td>Droga Mleczna</td>
				</tr>
			</table>
			<div class="srodek">
				<button id="tepacz" onclick='window.scrollTo({top: 0, behavior: "smooth"});'>Do góry &uarr;</button>
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