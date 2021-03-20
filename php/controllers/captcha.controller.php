<?php
session_start();
$md5 = md5(microtime() * mktime());
$_SESSION['captcha'] = substr($md5,0,5);
$im = imagecreatetruecolor(160, 50);
$colorFondo = imagecolorallocate($im, 173, 176, 231);
imagefill($im, 0, 0, $colorFondo);
$colorTexto = imagecolorallocate($im, 75, 78, 159);
imagestring($im, 5, 50, 20,  $_SESSION['captcha'], $colorTexto);
header('Content-Type: image/jpeg');
imagejpeg($im);
imagedestroy($im);
?>