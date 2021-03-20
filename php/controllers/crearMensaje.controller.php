<?php
include_once('../bootstrap.php');
include_once('../includes/defined.php');
include_once('../clases/Archivo.php');
include_once('../clases/class.phpmailer.php');
include_once('../clases/ConexionMailer.php');

$emisor = Doctrine::getTable('usuario')->findOneByCodigo($_POST['n']);
$receptor = Doctrine::getTable('usuario')->find($_POST['f']);
$mensaje = new Mensaje ();
$mensaje->fecha = date('Y-m-d');
$mensaje->asunto = utf8_decode($_POST['asunto']);
$mensaje->contenido = utf8_decode(substr($_POST['contenido'], 0, 140));
$mensaje->estado = Estado::noLeido();
$mensaje->emisor = $emisor;
$mensaje->receptor = $receptor;
$mensaje->save();

$asunto = ($mensaje->asunto);
$cuerpo = ($mensaje->contenido);
$cuerpo .= '<p>Para responder este mensaje ingres&aacute; a tu cuenta de <strong>Conexi&oacute;n Reciclado</strong></p>';

$mailTemplate = Archivo::leer(RUTA_LOCAL.'mail-template.html');
$mailTemplate = str_replace('<!--{mail}-->', $cuerpo, $mailTemplate);
$mailTemplate = str_replace('<!--{asunto}-->', $asunto, $mailTemplate);

$mail = new ConexionMailer();
$mail->AddAddress($receptor->email);
$mail->Subject = $asunto;
$mail->Body = $mailTemplate;
$exito = $mail->Send();

if ($exito) {
	$html = Archivo::leer(RUTA_LOCAL.'tpl/mensajes/compartir.exito.php');
} else {
	$html = Archivo::leer(RUTA_LOCAL.'tpl/mensajes/compartir.error.php');
}
echo ($html);
?>