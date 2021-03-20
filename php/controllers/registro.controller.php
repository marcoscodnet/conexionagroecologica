<?php
include_once('../bootstrap.php');
include('../clases/Archivo.php');
include('../clases/Validador.php');
include('../includes/defined.php');
include_once('../clases/class.phpmailer.php');
include_once('../clases/ConexionMailer.php');
$modificar = isset($_POST['fg']);
$validacionError = ($modificar)?'validacion.error.php':Archivo::leer('../../tpl/mensajes/validacion.error.php');

//validar usuario repetido
if (!$modificar && Doctrine::getTable('usuario')->findOneByEmail($_POST['email'])) {
	$respuesta = Archivo::leer('../../tpl/mensajes/registroRepetido.error.php');
	echo ($respuesta);
	exit();
}

//validacion del formulario

//if (!$_POST['nombre'] || !$_POST['apellido'] || !$_POST['email'] || !$_POST['company']) {
if (!$_POST['nombre'] || !$_POST['apellido'] || !$_POST['email']) {
	echo ($validacionError);
	exit();
}
$nombre = ($modificar)?utf8_decode($_POST['nombre']):$_POST['nombre'];
$apellido = ($modificar)?utf8_decode($_POST['apellido']):$_POST['apellido'];
//$company = ($modificar)?utf8_decode($_POST['company']):$_POST['company'];
if (!Validador::validarTexto($nombre) || !Validador::validarTexto($apellido)) {
	echo ($validacionError);
	exit();
}

/*if (!Validador::validarTextoYNumero($company)) {
	echo ($validacionError);
	exit();
}*/

/*if (!Validador::validarNumero($_POST['cuit'])) {
	echo ($validacionError);
	exit();
}*/
//fin validacion

/*$punto = new Punto ();
$punto->valor = 0;
$punto->save();*/

$usuario = ($modificar)?Doctrine::getTable('usuario')->findOneByCodigo($_POST['fg']):new Usuario();
$usuario->nombre = $_POST['nombre'];
//$usuario->puntos[] = $punto;
$usuario->apellido = $_POST['apellido'];
$usuario->email = $_POST['email'];
//$usuario->company = $_POST['company'];
//$usuario->razon = $_POST['razon'];
//$usuario->cuit = $_POST['cuit'];
if (isset($_POST['propietario'])) {
	$usuario->propietario =1;
}
else $usuario->propietario =0;
if (isset($_POST['productor'])) {
	$usuario->productor =1;
}
else $usuario->productor =0;
if (isset($_POST['datos_disponibles'])) {
	$usuario->datos_disponibles =1;
}
else $usuario->datos_disponibles =0;
if($_POST['localidad']){
	$usuario->localidad = Doctrine::getTable('localidad')->find($_POST['localidad']);
}
if (!$modificar) {
	$usuario->pass = $_POST['pass'];
	$usuario->asignarCodigo();
}

if ($_POST['telefonoNumero'] && $_POST['telefonoNumero'] != 'area') {
	if (!Validador::validarNumero($_POST['telefonoArea']) || !Validador::validarNumero($_POST['telefonoNumero'])) {
		echo ($validacionError);
		exit();
	}
	if ($modificar && $_POST['telefonoArea'] != $usuario->telefono->area && $_POST['telefonoNumero'] != $usuario->telefono->numero) {
		$tel = new Telefono();
		$tel->tipo = 1;
		$tel->area = $_POST['telefonoArea'];
		$tel->numero = $_POST['telefonoNumero'];
		$usuario->telefono = $tel;
	}
	if (!$modificar && $_POST['telefonoNumero']) {
		$tel = new Telefono();
		$tel->tipo = 1;
		$tel->area = $_POST['telefonoArea'];
		$tel->numero = $_POST['telefonoNumero'];
		$usuario->telefono = $tel;
	}
}

if ($_POST['celularNumero'] && $_POST['celularNumero'] != 'area') {
	if (!Validador::validarNumero($_POST['celularArea']) || !Validador::validarNumero($_POST['celularNumero'])) {
		echo ($validacionError);
		exit();
	}
	if ($modificar && $_POST['celularArea'] != $usuario->celular->area && $_POST['celularNumero'] != $usuario->celular->numero) {
		$cel = new Telefono();
		$cel->tipo = 2;
		$cel->area = $_POST['celularArea'];
		$cel->numero = $_POST['celularNumero'];
		$usuario->celular = $cel;
	}
	if (!$modificar && $_POST['celularNumero']) {
		$cel = new Telefono();
		$cel->tipo = 2;
		$cel->area = $_POST['celularArea'];
		$cel->numero = $_POST['celularNumero'];
		$usuario->celular = $cel;
	}
}
Doctrine_Manager::connection()->flush();

//mail de bienvenida
if (!$modificar) {
	include_once('../clases/class.phpmailer.php');
        //MAIL PARA EL USUARIO REGISTRADO
        //mensaje de bienvenida
	$mensaje = '
		<p>Estimado/a '.htmlentities($_POST['nombre']).' '.htmlentities($_POST['apellido']).':</p>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;Bienvenido a la comunidad <strong>Conexi&oacute;n Agroecol&oacute;gica</strong>.
		Ya se encuentra habilitado para publicar.</p>
	';
	$mailTemplate = Archivo::leer(RUTA_LOCAL.'mail-template.html');
	$mailTemplate = str_replace('<!--{mail}-->', $mensaje, $mailTemplate);
	$mailTemplate = str_replace('<!--{asunto}-->', "Bienvenido", $mailTemplate);
	//instaciacion de la clase mailer
        $mail = new ConexionMailer();
	$mail->AddAddress($_POST['email']);
	$mail->Subject = "Bienvenido";
	$mail->Body = $mailTemplate;
        //envio de email
	$exito = $mail->Send();
	$intento=1; 
	while ((!$exito) && ($intento <= 3)) {
	sleep(5);
		$exito = $mail->Send();
		$intento++;	
	}
        
        //MAIL PARA EL ADMIN
        //mensaje
        $mensaje = '<p>'.htmlentities($_POST['nombre']).' '.htmlentities($_POST['apellido']).' se sum&oacute; a la comunidad de <strong>Conexi&oacute;n Agroec&oacute;logica</strong></p>';
        $subject = 'Un nuevo miembro se sumó a la comunidad';
        $mailTemplate = Archivo::leer(RUTA_LOCAL.'mail-template.html');
	$mailTemplate = str_replace('<!--{mail}-->', $mensaje, $mailTemplate);
	$mailTemplate = str_replace('<!--{asunto}-->', $subject, $mailTemplate);
        //instaciacion de la clase mailer
        $mail = new ConexionMailer();
	$mail->AddAddress('info@conexionagroecologica.com');
	$mail->Subject = $subject;
	$mail->Body = $mailTemplate;
        //envio de email
	/*$exito = $mail->Send();
	$intento=1; 
	while ((!$exito) && ($intento <= 3)) {
	sleep(5);
		$exito = $mail->Send();
		$intento++;	
	}*/
	
	//respuesta de bienvenida
	$respuesta = Archivo::leer('../../tpl/mensajes/registro.exito.php');
	echo ($respuesta);
} else {
	echo ('cambiarDatos.exito.php');
}
?>