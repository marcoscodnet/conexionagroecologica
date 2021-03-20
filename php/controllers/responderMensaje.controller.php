<?php
include_once('../bootstrap.php');
$usuario = Doctrine::getTable('usuario')->findOneByCodigo($_POST['n']);
$mensajeOriginal = Doctrine::getTable('mensaje')->find($_POST['id']);
$contenido = '
----------------------
Fecha: '.$mensajeOriginal->fecha.'
De: '.$mensajeOriginal->emisor->toString();
;

$mensaje = new Mensaje ();
$mensaje->fecha = date('Y-m-d');
$mensaje->asunto = 'Re: '.$mensajeOriginal->asunto;
$mensaje->contenido = $_POST['contenido'].$contenido;
$mensaje->estado = Estado::noLeido();
$mensaje->emisor = $usuario;
$mensaje->receptor = $mensajeOriginal->emisor;
$mensaje->mensaje = $mensajeOriginal;
$mensaje->save();

header('location: ../../tpl/mensajes/responderMensaje.exito.php');
?>