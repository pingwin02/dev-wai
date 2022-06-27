<?php

require_once '../business.php';

$db = get_db();

//stronicowanie

const PAGE_SIZE = 5; //rozmiar strony


//widoczność
if (isset($_SESSION["account_id"]))
{
    $user=$_SESSION["account_id"];
    if ($user=='admin') //gdy admin
    {
        $query_prywatne=['widocznosc'=>"2"];
        $query_wyswietlanie=[];
    }
    else //gdy inny zalogowany
    {
        $query_prywatne=['$and' => [['widocznosc'=>"0"], ['user'=>['$ne' => $user]]]];
        $query_wyswietlanie=['$or' => [['widocznosc'=>"1"], ['user'=>$user]]];
    }
    
}
else 
{
    $user=session_id();
    $query_prywatne=['$and' => [['widocznosc'=>"0"], ['user'=>['$ne' => $user]]]]; //gdy niezalogowany
    $query_wyswietlanie=['$or' => [['widocznosc'=>"1"], ['user'=>$user]]];

}

//numerowanie
if(!isset($_GET['page'])) {
    $page = 1;
}
$ilosc_wszystkie = $db->files->count();
$ilosc_prywatne = $db->files->count($query_prywatne);//z punktu widzenia użytkownika
$ilosc=$ilosc_wszystkie-$ilosc_prywatne;
if ($ilosc%PAGE_SIZE==0)
$maxIloscStrony = $ilosc/PAGE_SIZE;
else 
$maxIloscStrony = $ilosc/PAGE_SIZE+1;
settype($maxIloscStrony, "integer");

//wyswietlanie
$files = $db->files->find(
    $query_wyswietlanie,
    [
    'sort' => ['id' => 1],
    'skip' => ($page -1)* PAGE_SIZE,
    'limit' => PAGE_SIZE
    ]
);

if ($ilosc_wszystkie)
echo "<h3>Wysłano łącznie: ".$ilosc_wszystkie." zdjęć, z czego ".$ilosc_prywatne." jest dla ciebie niewidocznych.</h3><br>";
else 
echo "<h3>Brak zdjęć w bazie danych</h3><br>";
$cart=get_cart();
echo "<form action='save' method='post' enctype='multipart/form-data'>
<input type='submit' name='zapamietaj' value='Zapamiętaj wybrane'>";
$saved="\"galeria-wybrane\"";
echo "<input type='button' onclick='window.location.href=".$saved."' value='Pokaż wybrane'</input><br>";
$wyszukaj="\"wyszukaj\"";
echo "<input type='button' onclick='window.location.href=".$wyszukaj."' value='Szukaj zdjęcia'</input><br>";
foreach ($files as $file) {
    if (array_sum($cart)!=0) {
        if ($cart[$file['id']]==1) $checked='checked';
        else $checked='';
    }
    else $checked='';
        echo "<figure class='zdj baza'>
        <a href='images_sent/".$file['filename-water']."' target='_blank'><img alt='".$file['nazwa']."' title='".$file['komentarz']."' src='images_sent/".$file['filename-min']."'></a>
        <figcaption>
        <input type='checkbox' name='".$file['id']."' ".$checked.">
        <strong>#".$file['id']." ".$file['nazwa']."</strong>";
        if ($file['widocznosc']==0) echo "<br><em style=color:red> [prywatne]</em>";
        echo "<br>Autor: ".$file['autor']."<br>
            ".$file['miejsce']."<br>
            ".$file['data']."
        </figcaption>
    </figure>";
}
echo "</form>";
//przyciski do zmiany strony
if($page!=1)
echo "<a href='galeria?page=".($page-1)."'><button type='submit'><- Poprzednia strona</button></a>";
for ($i=1; $i<=$maxIloscStrony; $i++) { 
if ($page==$i) $active="class='current'"; 
else $active="";
echo "&emsp;<a ".$active." href='galeria?page=".$i."'>".$i."</a>&emsp;";
};  
if($page!=$maxIloscStrony&&$maxIloscStrony!=0)
echo "<a href='galeria?page=".($page+1)."'><button type='submit'>Następna strona -></button></a>";
