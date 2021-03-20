<?php
include_once('../bootstrap.php');
include_once('../includes/defined.php');
include_once('../clases/class.phpmailer.php');

$usuario = Doctrine::getTable('usuario')->findOneByCodigo($_POST['m']);

if ($codigo = Doctrine::getTable('codigo')->findOneByContenido($_POST['iquest'])) {
	$codigo->delete();
} else {
	echo (6);
	exit();
}

$md5 = md5(microtime() * mktime());
$pass = substr($md5,0,6);

include_once('../clases/class.phpmailer.php');
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
$mail->AddAddress($usuario->email);
$mail->IsHTML(true);
$mail->CharSet = 'UTF-8';
$mail->Subject = "Recuperar contraseña";
$mail->Body = '<p>Nueva contrase&ntilde;a: '.$pass;
$exito = $mail->Send();

$intento=1; 
while ((!$exito) && ($intento <= 3)) {
sleep(5);
	$exito = $mail->Send();
	$intento++;	
}
	
if(!$exito) {
	echo (5);
} else {
	$usuario->pass = $pass;
	$usuario->save();
	echo (4);
}
?>