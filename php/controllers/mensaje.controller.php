<?php
include_once('../bootstrap.php');
include_once('../includes/defined.php');
include_once('../clases/Archivo.php');
include_once('../clases/class.phpmailer.php');

$usuario = Doctrine::getTable('usuario')->findOneByCodigo($_POST['codigo']);
$producto = Doctrine::getTable('producto')->find($_POST['articuloId']);
$mensaje = new Mensaje ();
$mensaje->fecha = date('Y-m-d');
$mensaje->asunto = utf8_decode($_POST['asunto']);
$mensaje->contenido = utf8_decode($_POST['contenido']);
$mensaje->estado = Estado::noLeido();
$mensaje->emisor = $usuario;
$mensaje->receptor = $producto->publicacion->owner;
$mensaje->producto = $producto;
$mensaje->save();

$asunto = $mensaje->asunto;
$cuerpo = ($mensaje->contenido);
$cuerpo .= '<p>Para responder este mensaje ingres&aacute; a tu cuenta de <strong>Conexi&oacute;n Reciclado</strong></p>';

$mailTemplate = Archivo::leer(RUTA_LOCAL.'mail-template.html');
$mailTemplate = str_replace('<!--{mail}-->', $cuerpo, $mailTemplate);
$mailTemplate = str_replace('<!--{asunto}-->', $asunto, $mailTemplate);

$mail = new PHPMailer();
$mail->PluginDir = RUTA_LOCAL."php/clases/include/";
$mail->Mailer = "smtp";
$mail->Host = "a2plcpnl0310.prod.iad2.secureserver.net";
	$mail->SMTPAuth = true;
	$mail->Username = "info@conexionagroecologica.com"; 
	$mail->Password = "incoag2050!";
	$mail->Port = "465";
	$mail->SMTPSecure = "ssl";
	$mail->isSMTP();
	$mail->From = "info@conexionagroecologica.com";
	$mail->FromName = "Conexión Agroecológica";
	$mail->Timeout=30;
$mail->AddAddress($producto->publicacion->owner->email);
$mail->IsHTML(true);
$mail->CharSet = 'UTF-8';
$mail->Subject = $asunto;
$mail->Body = $mailTemplate;
//$exito = $mail->Send();
$exito=1;
if ($exito) {
	$html = Archivo::leer(RUTA_LOCAL.'tpl/mensajes/compartir.exito.php');
} else {
	$html = Archivo::leer(RUTA_LOCAL.'tpl/mensajes/compartir.error.php');
}
//$html = Archivo::leer(RUTA_LOCAL.'tpl/mensajes/compartir.exito.php');
echo ($html);
?>