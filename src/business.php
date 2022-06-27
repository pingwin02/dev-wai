<?php

require '../../vendor/autoload.php';

use MongoDB\BSON\ObjectID;

function get_db()
{
    $mongo = new MongoDB\Client(
        "mongodb://localhost:27017/wai",
        [
            'username' => 'wai_web',
            'password' => 'w@i_w3b',
        ]);

    $db = $mongo->wai;

    return $db;
}

function clear_base()
{
    $db = get_db();

    $db->files->drop();
    
    $path = "images_sent/";
    
    $files = array_diff(scandir($path), array('.', '..'));
    foreach ($files as $file) {
        unlink($path.$file);
    }
}

function clear_users_base() {
    $db = get_db();
    session_unset();
    session_destroy();
    $params = session_get_cookie_params();
    setcookie(session_name(),'', time() - 42000,
    $params["path"], $params["domain"],
    $params["secure"], $params["httponly"]
    );
    $db->users->drop();
}
function save_checked()
{
	$cart = &get_cart();

	$db = get_db();

	for ($i=1;$i<=$db->files->count()+1;$i++) {
		if (isset($_POST[$i]))
		{
			if($_POST[$i]=='on')
			$cart[$i] = 1;
		}
		if (!isset($cart[$i])) {
			$cart[$i] = 0;
		}
	}

}

function delete_checked()
{
	$cart = &get_cart();

	$db = get_db();

	for ($i=1;$i<=$db->files->count()+1;$i++) {
		if (isset($_POST[$i]))
		{
			if($_POST[$i]=='on')
			$cart[$i] = 0;
		}
	}

}
function getAccount($login) {
    $db = get_db();
   return $db->users->findOne(['login' => $login]);
}

function verifyRegistrationForm($postArr) {
    if ($postArr['password_again']==""||$postArr['password']==""||$postArr['login']=="") {
        return 3;
    }

    if($postArr['password_again'] != $postArr['password']) {
        return 2;
    }

    $hash = password_hash($postArr['password'], PASSWORD_DEFAULT);

    $account = [
        'login' => $postArr['login'],
        'password' => $hash,
    ];
    
     $db = get_db();

     $current = getAccount($postArr['login']);
     
     if($current === NULL){ 
         $db->users->insertOne($account);
         return 0;
     } else{
        return 1;
     }

}

function verifyLoginForm($postArr) {

    if ($postArr['password']==""||$postArr['login']=="") {
        return false;
    }
    $login = $postArr['login'];
    $password = $postArr['password'];

    $db = get_db();

    $user = $db->users->findOne(['login' => $login]);

    if($user == null || !password_verify($password, $user['password'])){
        return false;
    }

    
    $_SESSION["logged_in"] = 1;
    $_SESSION["account_id"] = $login;
    return true;

}

function add_photo()
{
    $db = get_db();

    $filename = $_FILES["nazwa_plik"]["name"];
    $filename_min = "min-".$_FILES["nazwa_plik"]["name"];
    $filename_water = "water-".$_FILES["nazwa_plik"]["name"];
    $autor = $_POST["nazwa_autor"];

    if (isset($_SESSION["account_id"]))
        $user = $_SESSION["account_id"];
    else
        $user = session_id();

    $miejsce = $_POST["miejsce"];
    $data = $_POST["data-js"];
    $komentarz = $_POST["komentarz"];
    $tytul=$_POST['nazwa_tytul'];
    $widocznosc=$_POST['widocznosc'];

  $fileDbObject = [
    'id' => $db->files->count()+1,
    'autor' => $autor,
    'user' => $user,
    'nazwa' => $tytul,
    'miejsce' => $miejsce,
    'komentarz' => $komentarz,
    'data' => $data,
    'filename' => $filename,
    'filename-min' => $filename_min,
    'filename-water' => $filename_water,
    'widocznosc' => $widocznosc,
  ];

  $db->files->insertOne($fileDbObject);
}

function ajax_search() {

	$db = get_db();
	
	//wyswietlanie wyników
	if (isset($_POST['q']))
	{
	
		$fraza=$_POST['q'];

        if (strlen($fraza)<3) {
            exit;
        }

		$query_search=['nazwa'=>['$regex' => $fraza, '$options' => 'i']];

     //prywatne/publiczne
	
	if (isset($_SESSION["account_id"]))
	{
		$user=$_SESSION["account_id"];
		if ($user=='admin') //gdy admin
		{
			;
		}
		else //gdy inny zalogowany
		{
		
			$query_search=['$and' => [$query_search,['$or' => [['widocznosc'=>"1"], ['user'=>$user]]]]];
		}
		
	}
	else 
	{
		$user=session_id(); //gdy niezalogowany
		$query_search=['$and' => [$query_search,['$or' => [['widocznosc'=>"1"], ['user'=>$user]]]]];
	
	}
	
		$files = $db->files->find($query_search);
        $czujka=0;
        foreach ($files as $file) {
                $czujka=1;
				echo "<figure class='zdj baza'>
				<a href='images_sent/".$file['filename-water']."' target='_blank'><img alt='".$file['nazwa']."' title='".$file['komentarz']."' src='images_sent/".$file['filename-min']."'></a>
				<figcaption>
				<strong>#".$file['id']." ".$file['nazwa']."</strong>";
                if ($file['widocznosc']==0) echo "<br><em style=color:red> [prywatne]</em>";
                echo "<br>Autor: ".$file['autor']."<br>
                    ".$file['miejsce']."<br>
                    ".$file['data']."
                </figcaption>
			</figure>";
		}
        if ($czujka==0)
        {
            echo "<h3>Nie znaleziono zdjęcia o podanym tytule</h3>";
        }
	}

}