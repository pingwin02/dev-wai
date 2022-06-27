<?php
require_once 'business.php';

function upload_photo() {
	$allowedImgTypes = array("jpg", "png");
	$target_dir = "images_sent/";
	$target_file = $target_dir.basename($_FILES["nazwa_plik"]["name"]);
	$resultCode = 0;
	$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

	//Check if POST is empty
	if ($_FILES["nazwa_plik"]["name"]==""||strlen($_POST['nazwa_tytul'])<3||$_POST["nazwa_autor"]==""||$_POST["miejsce"]==""||$_POST["data-js"]==""||$_POST['nazwa_tytul']=="") {
		$resultCode = 5;
		return $resultCode;
	}

	// Check file size
	if (filesize($_FILES['nazwa_plik']['tmp_name']) > 1048576) {
		$resultCode = 1;
		return $resultCode;
	}

	//Check extension
	if (!in_array($fileType, $allowedImgTypes)) {
		$resultCode = 2;
		return $resultCode;
	} else {
		if (@getimagesize($_FILES["nazwa_plik"]["tmp_name"]) == false) { //Check if file is corrupted
			$resultCode = 4;
			return $resultCode;
		}
	}
	
	// Check if file already exists
	if (file_exists($target_file)) {
		$resultCode = 3;
		return $resultCode;
	}
	// Check if file was uploaded correctly
	if ($_FILES["nazwa_plik"]["error"] != 0||!move_uploaded_file($_FILES["nazwa_plik"]["tmp_name"], $target_file)) {
		$resultCode = 5;
		return $resultCode;
	}
	// Begin creating files
	if ($resultCode == 0) {
			$filename = $_FILES["nazwa_plik"]["name"];
			//watermark and thumbnail
			$watermarktext = $_POST["znak-wodny"];
			$font = "static/font/BalsamiqSans-Regular.ttf";
			if ($fileType == "png") {

				$imagetobewatermark = imagecreatefrompng($target_file);
				$red = imagecolorallocatealpha($imagetobewatermark, 255, 0, 0, 75);
				imagettftext($imagetobewatermark, 50, 0, 75, 75, $red, $font, $watermarktext);
				imagepng($imagetobewatermark, "images_sent/water-".$filename."");
				$target_file = "images_sent/water-".$filename."";

				$imagetobethumbnail = imagecreatefrompng($target_file);
				$image_p = imagecreatetruecolor(200, 125);
				list($width, $height) = getimagesize($target_file);
				imagecopyresampled($image_p, $imagetobethumbnail, 0, 0, 0, 0, 200, 125, $width, $height);
				imagepng($image_p, "images_sent/min-".$filename."");
			}
			if ($fileType == "jpg") {

				$imagetobewatermark = imagecreatefromjpeg($target_file);
				$red = imagecolorallocatealpha($imagetobewatermark, 255, 0, 0, 75);
				imagettftext($imagetobewatermark, 50, 0, 75, 75, $red, $font, $watermarktext);
				imagejpeg($imagetobewatermark, "images_sent/water-".$filename."");
				$target_file = "images_sent/water-".$filename."";

				$imagetobethumbnail = imagecreatefromjpeg($target_file);
				$image_p = imagecreatetruecolor(200, 125);
				list($width, $height) = getimagesize($target_file);
				imagecopyresampled($image_p, $imagetobethumbnail, 0, 0, 0, 0, 200, 125, $width, $height);
				imagejpeg($image_p, "images_sent/min-".$filename."");
			}
			add_photo();
	}
	return $resultCode;
}

function &get_cart()
{
    if (!isset($_SESSION['cart'])) {
		$_SESSION['cart'] = [];
	}

    return $_SESSION['cart'];
}