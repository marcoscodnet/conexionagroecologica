<?php
session_start();
include_once('../bootstrap.php');
include('../clases/Archivo.php');

if (isset($_POST['r'])) {
	$pass = desencriptar($_POST['r']);
	if (!isset($_POST['recordarPass'])) {
		olvidar();
		$pass = $_POST['clave'];
	}
} else {
	$pass = $_POST['clave'];
	if (isset($_POST['recordarPass'])) {
		recordar();
	} else {
		olvidar();
	}
}

$usuario = Usuario::isValido($_POST['email'], $pass);

if ($usuario) {
	$_SESSION['log'] = 'usuarioValido';
	$_SESSION['codigoUsuario'] = $usuario->codigo;
	if ($_POST['ini']==1) {
		$respuesta = Archivo::leer('../../tpl/mensajes/loginCorrectoInicial.php');
	}
	else{
		$respuesta = Archivo::leer('../../tpl/mensajes/loginCorrecto.php');
		
	}
	echo ($respuesta);
} else {
	session_destroy();
	$respuesta = Archivo::leer('../../tpl/mensajes/loginIncorrecto.php');
	echo ($respuesta);
}



//funciones de encriptado
function encriptar ($texto) {
	$texto = strrev($texto);
	$letra = '';
	$encrypt = '';
	for ($i=0; $i<strlen($texto); $i++) {
		$ord = ord($texto{$i});
		$encrypt .= $ord;
		if ($i != (strlen($texto) - 1)) {
			$letra = textoAleatoreo(rand(1,4));
			$encrypt .= $letra;
		}
	}
	return $encrypt;
}

function textoAleatoreo ($cant) {
	$letras = "abcdefghijklmnopqrstuvwxyz";
	$text = '';
	for ($i=0; $i<$cant; $i++) {
		$text .= $letras{rand(0,strlen($letras)-1)};
	}
	return $text;
}

function desencriptar ($texto) {
	$desencrypt = '';
	$texto = preg_replace('/([a-z])+/', '-', $texto);
	$textoArray = array_reverse(explode('-', $texto));
	foreach ($textoArray as $letra) {
		$desencrypt .= chr($letra);
	}
	return $desencrypt;
}

//manejo de cookies
function recordar () {
	$p = md5(rand(1,1000));
	$p = substr($p, 5, rand(1,32));
	$u = md5(rand(1,1000));
	$u = substr($u, 5, rand(1,32));
	$r = encriptar($_POST['clave']);
	setcookie('p', $p, 0, '/');
	setcookie('u', $u, 0, '/');
	setcookie('r', $r, 0, '/');
	setcookie('m', $_POST['email'], 0, '/');
}

function olvidar () {
	setcookie('p', '', 0, '/');
	setcookie('u', '', 0, '/');
	setcookie('r', '', 0, '/');
	setcookie('m', '', 0, '/');
}

?>