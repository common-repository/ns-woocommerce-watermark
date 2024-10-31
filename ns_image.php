<?php
$url_decode = urldecode(($_GET['param']));
$param_ww = array();

foreach (explode('&', $url_decode) as $chunk) {
    $param = explode("=", $chunk);
	
    if ($param) {
        $param_ww[$param[0]] = $param[1];
    }
}

// immagine che dovrà essere firmata
$immagide_da_firmare = $param_ww['image_path'];

// il watermark che utilizzeremo
$watermark = $param_ww['wt_path'];


//ricaviamo il type dell'immagine sorgente e del watermark
$img_tipo = substr($immagide_da_firmare, strlen($immagide_da_firmare)-4,4);
$img_tipo = strtolower($img_tipo);
$wtmk_tipo = substr($watermark, strlen($watermark)-4,4);
$wtmk_tipo = strtolower($wtmk_tipo);

// richiamiamo diverse funzioni a seconda del tipo di immagine
if($img_tipo == ".gif") { 
  $img_result = @imagecreatefromgif($immagide_da_firmare);
} elseif($img_tipo == ".jpg" || $img_tipo == "jpeg") { 
  $img_result = @imagecreatefromjpeg($immagide_da_firmare);
} elseif($img_tipo == ".png") { 
  $img_result = @imagecreatefrompng($immagide_da_firmare);
}else{
  die("Impossibile rilevare il formato dell'immagine"); 
} 

if(!$img_result) {
  die("Impossibile creare l'immagine");
}

// facciamo lo stesso per quanto riguarda il watermark
if($wtmk_tipo == ".gif") {
  $wtmk = @imagecreatefromgif($watermark);
} elseif($wtmk_tipo == ".jpg" || $wtmk_tipo == "jpeg") {
  $wtmk = @imagecreatefromjpeg($watermark);
} elseif($wtmk_tipo == ".png") {
  $wtmk = @imagecreatefrompng($watermark);
} else {
  die("Impossibile rilevare il formato del watermark");
}

if(!$wtmk) die("Impossibile creare il watermark");

// stabiliamo le dimensioni dell'output
$img_result_width = imagesx($img_result);
$img_result_height = imagesy($img_result); 
$wtmk_width = imagesx($wtmk);
$wtmk_height = imagesy($wtmk);
$width = (($img_result_width - $wtmk_width)/2);
$height = (($img_result_height - $wtmk_height)/2);

// creiamo un immagine che comprenda il sorgente modificato e il suo watermark 
imagecopy($img_result, $wtmk, $width, $height, 0, 0, $wtmk_width, $wtmk_height);

//visualizzazione dell'output
header("Content-type: image/".str_replace(".","",$wtmk_tipo));
imagejpeg($img_result);
imagedestroy($img_result);
imagedestroy($wtmk);
?>