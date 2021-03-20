<?php
$texto = '225de';
function encriptar ($texto) {
	$letras = "abcdefghijklmnopqrstuvwxyz";
	$texto = strrev($texto);
	$encrypt = '';
	for ($i=0; $i<strlen($texto); $i++) {
		$ord = ord($texto{$i});
		$encrypt .= $ord;
		if ($i != (strlen($texto) - 1)) {
			$letra = $letras{rand(0,strlen($letras)-1)};
			$encrypt .= $letra;
		}
	}
	return $encrypt;
}

function desencriptar ($texto) {
	$desencrypt = '';
	$texto = preg_replace('/[a-z]/', '-', $texto);
	$textoArray = array_reverse(explode('-', $texto));
	foreach ($textoArray as $letra) {
		$desencrypt .= chr($letra);
	}
	return $desencrypt;
}

$uno = encriptar ($texto);
echo ('<p>'.$uno.'</p>');
$dos = desencriptar ($uno);
echo ('<p>'.$dos.'</p>');
?>