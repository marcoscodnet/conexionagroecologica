<?php
include_once('../bootstrap.php');
include_once('../includes/defined.php');
include_once('../clases/Archivo.php');
include_once('../clases/class.phpmailer.php');

$asunto = 'Conulta on line';
$cuerpo = '<p><strong>Nombre: </strong>'.$_POST['nombre'].'</p>';
if (isset($_POST['empresa']) && $_POST['empresa']) $cuerpo .= '<p><strong>Empresa: </strong>'.$_POST['empresa'].'</p>';
$cuerpo .= '<p><strong>Email: </strong>'.$_POST['email'].'</p>';
if (isset($_POST['telefono']) && $_POST['telefono']) $cuerpo .= '<p><strong>Tel&eacute;fono: </strong>'.$_POST['telefono'].'</p>';
$cuerpo .= '<p><strong>Consulta: </strong></p><p>'.nl2br($_POST['consulta']).'</p>';

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
$mail->AddAddress('info@conexionagroecologica.com');

$mail->Subject = $asunto;
$mail->Body = $mailTemplate;
$exito = $mail->Send();

header('location: '.RUTA.'consultas#success');
?>