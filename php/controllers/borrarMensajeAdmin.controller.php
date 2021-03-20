<?php
include_once('../bootstrap.php');
include_once('../includes/defined.php');
include_once('../clases/Archivo.php');
include_once('../clases/class.phpmailer.php');

$mensaje = Doctrine::getTable('mensaje')->find($_POST['id']);
$admin = Doctrine::getTable('usuario')->findOneByCodigo($_POST['rm']);

if ($mensaje && $admin && Usuario::admin()->id == $admin->id) {
	$mensaje->estado = Estado::borrada();
	$mensaje->save();
	
	$asunto = 'El administrador borr� un mensaje de su casilla';
	$contenido = $_POST['motivos'];
	
	//mensaje para el emisor
	$mensajeEmisor = new Mensaje();
	$mensajeEmisor->fecha = date('Y-m-d');
	$mensajeEmisor->asunto = $asunto;
	$mensajeEmisor->contenido = $contenido;
	$mensajeEmisor->estado = Estado::noLeido();
	$mensajeEmisor->emisor = Usuario::syst();
	$mensajeEmisor->receptor = $mensaje->emisor;
	
	//mensaje para el receptor
	$mensajeReceptor = new Mensaje();
	$mensajeReceptor->fecha = date('Y-m-d');
	$mensajeReceptor->asunto = $asunto;
	$mensajeReceptor->contenido = $contenido;
	$mensajeReceptor->estado = Estado::noLeido();
	$mensajeReceptor->emisor = Usuario::syst();
	$mensajeReceptor->receptor = $mensaje->receptor;
	
	Doctrine_Manager::connection()->flush();

	//mail para el ambos
	$mailTemplate = Archivo::leer(RUTA_LOCAL.'mail-template.html');
	$mailTemplate = str_replace('<!--{mail}-->', nl2br(htmlentities($contenido)), $mailTemplate);
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
	$mail->AddAddress($mensaje->emisor->email);

	$mail->Subject = $asunto;
	$mail->Body = $mailTemplate;
	
	//envio para el emisor
	$exito = $mail->Send();
	$intento=1; 
	while ((!$exito) && ($intento <= 3)) {
	sleep(3);
		$exito = $mail->Send();
		$intento++;	
	}
	
	//envio para el receptor
	$mail->ClearAddresses();
	$mail->AddAddress($mensaje->receptor->email);
	$exito = $mail->Send();
	$intento=1; 
	while ((!$exito) && ($intento <= 3)) {
	sleep(3);
		$exito = $mail->Send();
		$intento++;	
	}

	$exito = Archivo::leer(RUTA_LOCAL.'tpl/mensajes/borrarMensaje.exito.php');
	echo ($exito);
} else {
	echo ('Error');
}
?>