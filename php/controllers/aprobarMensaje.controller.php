<?php
include_once('../bootstrap.php');
include_once('../includes/defined.php');
include_once('../clases/Archivo.php');
include_once('../clases/class.phpmailer.php');
$usuario = Doctrine::getTable('usuario')->findOneByCodigo($_POST['codigo']);

if (!$usuario || $usuario->id != Usuario::admin()->id) {
	echo ('error');
	exit();
}

if ($mensaje = Doctrine::getTable('mensaje')->find($_POST['id'])) {
	$mensaje->estado = Estado::aceptada();
	$mensaje->save();
	
	/*$asunto = $mensaje->asunto;
	$cuerpo = utf8_encode($mensaje->contenido);
	$cuerpo .= '<p>Para responder este mensaje ingres&aacute; a tu cuenta de <strong>Conexi&oacute;n Reciclado</strong></p>';
	
	$mailTemplate = Archivo::leer(RUTA_LOCAL.'mail-template.html');
	$mailTemplate = str_replace('<!--{mail}-->', $cuerpo, $mailTemplate);
	$mailTemplate = str_replace('<!--{asunto}-->', $asunto, $mailTemplate);
	
	$mail = new phpmailer();
	$mail->PluginDir = RUTA_LOCAL."php/clases/include/";
	$mail->Mailer = "smtp";
	$mail->Host = "a2plcpnl0310.prod.iad2.secureserver.net";
	$mail->SMTPAuth = true;
	$mail->Username = "info@conexionreciclado.com.ar"; 
	$mail->Password = "incore2050!";
	$mail->Port = "465";
	$mail->SMTPSecure = "ssl";
	$mail->isSMTP();
	$mail->From = "info@conexionreciclado.com.ar";
	$mail->FromName = "Conexión Reciclado";
	$mail->Timeout=30;
	$mail->AddAddress($mensaje->producto->publicacion->owner->email);
	$mail->IsHTML(true);
	$mail->Subject = $asunto;
	$mail->Body = $mailTemplate;
	$exito = $mail->Send();
	
	
	$intento=1; 
	while ((!$exito) && ($intento <= 3)) {
	sleep(3);
		$exito = $mail->Send();
		$intento++;	
	}*/
	
	echo ('bien');
} else {
	echo ('error');
}
?>