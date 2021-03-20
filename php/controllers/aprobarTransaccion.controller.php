<?php
include_once('../bootstrap.php');
include_once('../includes/defined.php');
include_once('../clases/class.phpmailer.php');
include_once('../clases/Archivo.php');

function br2nl($str) {
   $str = preg_replace("/(\r\n|\n|\r)/", "", $str);
   return preg_replace("=<br */?>=i", "\n", $str);
}

$usuario = Doctrine::getTable('usuario')->findOneByCodigo($_POST['codigo']);

if (!$usuario || $usuario->id != Usuario::admin()->id) {
	echo ('error');
	exit();
}

if ($propiedad = Doctrine::getTable('propiedad')->find($_POST['id'])) {
	$transaccion = $propiedad->publicacion->transaccion;
	$transaccion->estado = Estado::aceptada();
	$transaccion->publicacion->estado = Estado::borrada();
	
	$contenidoMensajeComprador = 'La compra de la propiedad '.$transaccion->publicacion->propiedad->titulo.' se realizó con éxito.<br /> Estos son los datos del vendedor para que puede ponerse en contacto con él: <br />Nombre: '.$transaccion->vendedor->toString().'<br />Email.: '.$transaccion->vendedor->email.'<br />Teléfono: '.$transaccion->vendedor->telefonoToString();
	
	$contenidoMensajeVendedor = 'La venta de la propiedad '.$transaccion->publicacion->propiedad->titulo.' se realizó con éxito.<br /> Estos son los datos del comprador para que puede ponerse en contacto con él: <br />Nombre: '.$transaccion->comprador->toString().'<br />Email.: '.$transaccion->comprador->email.'<br />Teléfono: '.$transaccion->comprador->telefonoToString();
	
	//mensaje para el comprador
	$mensajeComprador = new Mensaje();
	$mensajeComprador->fecha = date('Y-m-d');
	$mensajeComprador->asunto = 'Transacción exitosa';
	$mensajeComprador->contenido = br2nl($contenidoMensajeComprador);
	$mensajeComprador->estado = Estado::noLeido();
	$mensajeComprador->emisor = Usuario::syst();
	$mensajeComprador->receptor = $transaccion->comprador;
	
	//mensaje para el vendedor
	$mensajeVendedor = new Mensaje();
	$mensajeVendedor->fecha = date('Y-m-d');
	$mensajeVendedor->asunto = 'Transacción exitosa';
	$mensajeVendedor->contenido = br2nl($contenidoMensajeVendedor);
	$mensajeVendedor->estado = Estado::noLeido();
	$mensajeVendedor->emisor = Usuario::syst();
	$mensajeVendedor->receptor = $transaccion->vendedor;
	
	Doctrine_Manager::connection()->flush();
	
	//mail para el comprador
	$mailTemplate = Archivo::leer(RUTA_LOCAL.'mail-template.html');
	$mailTemplate = str_replace('<!--{mail}-->', $contenidoMensajeComprador, $mailTemplate);
	$mailTemplate = str_replace('<!--{asunto}-->', "Conexi&oacute;n exitosa - ".($transaccion->publicacion->propiedad->titulo), $mailTemplate);
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
	$mail->AddAddress($transaccion->comprador->email);

	$mail->Subject = "Conexión exitosa - ".$transaccion->publicacion->propiedad->titulo;
	$mail->Body = $mailTemplate;
	$exito = $mail->Send();
	
	$intento=1; 
	while ((!$exito) && ($intento <= 3)) {
	sleep(3);
		$exito = $mail->Send();
		$intento++;	
	}
	
	//mail para el vendedor
	$mailTemplate = Archivo::leer(RUTA_LOCAL.'mail-template.html');
	$mailTemplate = str_replace('<!--{mail}-->', $contenidoMensajeVendedor, $mailTemplate);
	$mailTemplate = str_replace('<!--{asunto}-->', "Conexi&oacute;n exitosa - ".($transaccion->publicacion->propiedad->titulo), $mailTemplate);
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
	$mail->Subject = "Conexión exitosa - ".$transaccion->publicacion->propiedad->titulo;
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