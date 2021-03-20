<?php
include_once('../bootstrap.php');
include_once('../includes/defined.php');
include_once('../clases/Archivo.php');
include_once('../clases/class.phpmailer.php');
$producto = Doctrine::getTable('producto')->find($_POST['productoId']);

if (isset($_POST['n'])) {
	$usuario = Doctrine::getTable('usuario')->findOneByCodigo($_POST['n']);
	$nombre = $usuario->toString().' ('.$usuario->email.')';
} else {
	$from = $_POST['destinador'];
	$nombre = $_POST['nombre'].' ('.$from = $_POST['destinador'].')';
}

$asunto = $nombre.' te quiere recomendar la siguiente publicaci�n.';
$cuerpo = htmlentities($nombre).' te recomienda que veas la publicaci&oacute;n <strong>"'.htmlentities($producto->titulo).'"</strong><br />Para poder acceder hace click en el siguiente v&iacute;nculo: <a href="'.RUTA.'articulo.php?id='.$producto->id.'">'.htmlentities($producto->titulo).'</a>';

//mail para el comprador
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
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
$mail->AddAddress($_POST['email']);

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