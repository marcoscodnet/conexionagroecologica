<?php
session_start();
include_once('../bootstrap.php');
include_once('../includes/defined.php');
include_once('../clases/Archivo.php');

if ($_SESSION['captcha'] != $_POST['captcha']) {
	header('location: '.RUTA.'recuperar-pass.php?r=0');
	exit();
}

$usuario = Doctrine::getTable('usuario')->findOneByEmail($_POST['lastName']);

if ($usuario) {
	include_once('../../tpl/confirmarRecuperarPass.mail.php');
	include_once('../clases/class.phpmailer.php');
	$mailTemplate = Archivo::leer(RUTA_LOCAL.'mail-template.html');
	$mailTemplate = str_replace('<!--{mail}-->', $html, $mailTemplate);
	$mailTemplate = str_replace('<!--{asunto}-->', "Recuperar contrase&ntilde;a", $mailTemplate);
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
	$mail->AddAddress($_POST['lastName']);
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Subject = "Recuperar contraseña";
	$mail->Body = $mailTemplate;
	$exito = $mail->Send();
	
	$intento=1; 
	while ((!$exito) && ($intento <= 3)) {
	sleep(5);
		$exito = $mail->Send();
		$intento++;	
	}
		
	if(!$exito) {
		header('location: '.RUTA.'recuperar-pass.php?r=1');
	} else {
		header('location: '.RUTA.'recuperar-pass.php?r=2');
	}

} else {
	header('location: '.RUTA.'recuperar-pass.php?r=3');
}


?>