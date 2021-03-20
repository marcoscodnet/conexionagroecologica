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

if ($propiedad = Doctrine::getTable('propiedad')->find($_POST['id'])) {
	$propiedad->publicacion->estado = Estado::aceptada();
	$propiedad->save();
	
	$contenidoMail = 'La publicaci&oacute;n <a href="'.RUTA.'articulo.php?id='.$propiedad->id.'">'.$propiedad->titulo.'</a> ha sido aprobada por el administrador.';
	
	//mail para el usuario
	$mailTemplate = Archivo::leer(RUTA_LOCAL.'mail-template.html');
	$mailTemplate = str_replace('<!--{mail}-->', $contenidoMail, $mailTemplate);
	$mailTemplate = str_replace('<!--{asunto}-->', 'Publicaci&oacute;n cargada', $mailTemplate);
	
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
	$mail->AddAddress($propiedad->publicacion->owner->email);
	
	$mail->Subject = "Publicación aprobada - ".$propiedad->titulo;
	$mail->Body = $mailTemplate;
        
	$exito = $mail->Send();
	
	$intento=1; 
	while ((!$exito) && ($intento <= 3)) {
	sleep(3);
		$exito = $mail->Send();
		$intento++;	
	}
	
	echo ('bien');
} else {
	echo ('error');
}
?>