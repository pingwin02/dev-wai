<?php
require_once '../business.php';

$db = get_db();
//wyswietlanie
$files = $db->files->find(
    [],
    [
    'sort' => ['id' => -1],
    ]
);
$cart=get_cart();
if (array_sum($cart)==0)
{
echo "<h3>Brak wybranych zdjęć</h3><br>";
}
else
{
    echo "<form action='delete' method='post' enctype='multipart/form-data'>
    <input type='submit' name='zapamietaj' value='Usuń zaznaczone z zapamiętanych'>";
    $usun="\"usun-wybrane\"";
    echo "<input type='reset' onclick='window.location.href=".$usun."' value='Zresetuj wybór zdjęć'</input><br>";
    foreach ($files as $file) {
        if ($cart[$file['id']]==1) {
        echo "<figure class='zdj baza'>
        <a href='images_sent/".$file['filename-water']."' target='_blank'><img alt='".$file['nazwa']."' title='".$file['komentarz']."' src='images_sent/".$file['filename-min']."'></a>
        <figcaption>
        <input type='checkbox' name='".$file['id']."'>
        <strong>#".$file['id']." ".$file['nazwa']."</strong>";
        if ($file['widocznosc']==0) echo "<br><em style=color:red> [prywatne]</em>";
        echo "<br>Autor: ".$file['autor']."<br>
            ".$file['miejsce']."<br>
            ".$file['data']."
        </figcaption>
    </figure>";
    }
}
    echo "</form>";
}