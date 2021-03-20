<?php
session_start();
include_once('../bootstrap.php');
include_once('../clases/FileImage.php');
include_once('../clases/Validador.php');
include_once('../clases/Archivo.php');
include_once('../includes/defined.php');
include_once('../clases/class.phpmailer.php');

if (isset($_POST['propiedadId']) && $_POST['propiedadId'] != 0) {
	$propiedad = Doctrine::getTable('propiedad')->find($_POST['propiedadId']);
	if ($propiedad && $propiedad->publicacion->owner->codigo != $_SESSION['codigoUsuario'] && Usuario::admin()->codigo !=  $_SESSION['codigoUsuario']) {
		session_destroy();
		header('location: '.RUTA);
		exit();
	} else {
		$modificar = true;
		//$propiedad->imagenes->delete();
	}
} else {
    $propiedad = new Propiedad();
	$modificar = false;
}

include_once('../comprobadores/publicar.comprobador.php');

$usoSuelo = Doctrine::getTable('UsoSuelo')->find($_POST['usoSuelo']);
$tipoUsoSuelo = Doctrine::getTable('TipoUsoSuelo')->find($_POST['tipoUsoSuelo']);
$posibleUsoSuelo = Doctrine::getTable('PosibleUsoSuelo')->find($_POST['posibleUsoSuelo']);
$tipoContrato = Doctrine::getTable('TipoContrato')->find($_POST['tipoContrato']);
$accesoAgua = Doctrine::getTable('AccesoAgua')->find($_POST['accesoAgua']);


/*$cantidad = new Cantidad ();
$cantidad->valor = $_POST['cantidadValor'];
$cantidad->medida = Doctrine::getTable('medida')->find($_POST['cantidadMedida']);*/

//precio
/*if (isset($_POST['tipo_precio'])) {
    if ($_POST['tipo_precio'] == 1) {
        $sugerencia = new Sugerencia ();
        $sugerencia->precio = 0;
        $sugerencia->medida = NULL;
        $propiedad->sugerencia = $sugerencia;
    } else {
        $propiedad->sugerencia = NULL;
    }
} else {
    $sugerencia = new Sugerencia ();
    $sugerencia->precio = $_POST['sugerenciaPrecio'];
    $sugerencia->medida = ($_POST['sugerenciaMedida'] != 0)?Doctrine::getTable('medida')->find($_POST['sugerenciaMedida']):NULL;
    $propiedad->sugerencia = $sugerencia;
}*/
//fin precio

//$periodicidad = Doctrine::getTable('periodicidad')->find($_POST['periodicidad']);
/*$fuente = Doctrine::getTable('fuente')->find($_POST['fuente']);
$frecuencia = Doctrine::getTable('frecuencia')->find($_POST['frecuencia']);*/
$direccion = new Direccion ();
/*$direccion->calle = (isset($_POST['calle']))?$_POST['calle']:'';
$direccion->numero = (isset($_POST['nro']))?$_POST['nro']:'';*/
//$direccion->codigoPostal = 0;
$direccion->localidad = Doctrine::getTable('localidad')->find($_POST['localidad']);


$propiedad->latitud = $_POST['latitud'];
$propiedad->longitud = $_POST['longitud'];



if (isset($_POST['casa_disponible'])) {
	$propiedad->casa_disponible =1;
}
else $propiedad->casa_disponible =0;
if (isset($_POST['vive_terreno'])) {
	$propiedad->vive_terreno =1;
}
else $propiedad->vive_terreno =0;
//$finalizacion = (isset($_POST['renovar']))?'':$_POST['finalizacion']; 

//$propiedad = ($_POST['propiedadId'] != 0)?Doctrine::getTable('propiedad')->find($_POST['propiedadId']):new Propiedad ();
$propiedad->usoSuelo = $usoSuelo;
$propiedad->otro_uso_suelo = $_POST['otro_uso_suelo'];
$propiedad->tipoUsoSuelo = $tipoUsoSuelo;
$propiedad->otro_tipo_uso_suelo = $_POST['otro_tipo_uso_suelo'];
$propiedad->hectareas = $_POST['hectareas'];
$propiedad->tipoContrato = $tipoContrato;
$propiedad->posibleUsoSuelo = $posibleUsoSuelo;
$propiedad->accesoAgua = $accesoAgua;
$propiedad->titulo = $_POST['titulo'];
$propiedad->descripcion = $_POST['descripcion'];
$propiedad->direccion = $direccion;
/*$propiedad->condiciones = $_POST['condiciones'];
$propiedad->requerimentos = $_POST['requerimentos'];*/

//$propiedad->periodo = (isset($_POST['periodo']))?$_POST['periodo']:'';
//$propiedad->procedencia = $_POST['dondeProviene'];
/*$propiedad->enContactoCon = Doctrine::getTable('encontactocon')->find($_POST['enContactoCon']);
$propiedad->detalle = (isset($_POST['detalle']))?$_POST['detalle']:'';*/
$propiedad->save();

$usuario = Doctrine::getTable('usuario')->findOneByCodigo($_POST['codigo']);
if (!$usuario) {
	session_destroy();
	header('location: '.RUTA);
	exit();
}

Doctrine_Manager::connection()->flush();

if ($modificar) {
	//$propiedad->publicacion->finalizacion = $finalizacion;
	$propiedad->publicacion->estado = Estado::pendiente();
	$propiedad->publicacion->save();
} else {
	$usuario->publicar($propiedad, '');
}

/*IMAGENES*/
$imgCode = ($modificar)?$propiedad->id:$_SESSION['codigoUsuario'];
//$imgCode = $_SESSION['codigoUsuario'];
$i=0;
//$_Log = fopen("debug.log", "a+") or die("Operation Failed!");
foreach (glob(RUTA_IMAGENES.'propiedad'.$imgCode.'*') as $img) {
    $imageName = str_replace(RUTA_IMAGENES, '', $img);
	//echo $imageName."<br>";
    $ext = explode('.', $imageName);
   $imageModel = Doctrine::getTable('imagen')->findOneByRuta($imageName);
   if($imageModel){
		$i++;
	   $imageModel->ruta = 'propiedad'.$propiedad->id.'.'.$i.'.'.end($ext);
		//$propiedad->imagenes[] = $imagen;
		//print_r($imageModel);
		$imageModel->orden = $i;
		$imageModel->propiedad = $propiedad;
		//var_dump($imageModel);
		/*ob_start();
		var_dump($ima);
		fputs($_Log, ob_get_clean());
		ob_end_clean();*/
		
	   $imageModel->save();

	   rename(RUTA_IMAGENES.'gr/'.$imageName, RUTA_IMAGENES.'gr/'.'propiedad'.$propiedad->id.'.'.$i.'.'.end($ext));
		rename(RUTA_IMAGENES.'ch/'.$imageName, RUTA_IMAGENES.'ch/'.'propiedad'.$propiedad->id.'.'.$i.'.'.end($ext));
		rename(RUTA_IMAGENES.$imageName, RUTA_IMAGENES.'propiedad'.$propiedad->id.'.'.$i.'.'.end($ext));
   }
}
//fclose($_Log);

//$propiedad->save();
echo(3);

/*for ($i=1; $i<=4; $i++) {
	$nombreGif = 'propiedad'.$propiedad->id.'.'.$i.'.gif';
	$nombrePng = 'propiedad'.$propiedad->id.'.'.$i.'.png';
	$nombreJpg = 'propiedad'.$propiedad->id.'.'.$i.'.jpeg';
	
	if ($modificar) {
		$rutaGif = 'propiedad'.$propiedad->id.'.'.$i.'.gif';
		$rutaPng = 'propiedad'.$propiedad->id.'.'.$i.'.png';
		$rutaJpg = 'propiedad'.$propiedad->id.'.'.$i.'.jpeg';
	} else {	
		$rutaGif = 'propiedad'.$_SESSION['codigoUsuario'].'.'.$i.'.gif';
		$rutaPng = 'propiedad'.$_SESSION['codigoUsuario'].'.'.$i.'.png';
		$rutaJpg = 'propiedad'.$_SESSION['codigoUsuario'].'.'.$i.'.jpeg';
	}
	
	if (is_file(RUTA_IMAGENES.'gr/'.$rutaGif)) {
		$imagen = new Imagen ();
		$imagen->ruta = $nombreGif;
		$propiedad->imagenes[] = $imagen;
		$imagen->save();
		rename(RUTA_IMAGENES.'gr/'.$rutaGif, RUTA_IMAGENES.'gr/'.$nombreGif);
		rename(RUTA_IMAGENES.'ch/'.$rutaGif, RUTA_IMAGENES.'ch/'.$nombreGif);
		rename(RUTA_IMAGENES.$rutaGif, RUTA_IMAGENES.$nombreGif);
	}
	if (is_file(RUTA_IMAGENES.'gr/'.$rutaPng)) {
		$imagen = new Imagen ();
		$imagen->ruta = $nombrePng;
		$propiedad->imagenes[] = $imagen;
		$imagen->save();
		rename(RUTA_IMAGENES.'gr/'.$rutaPng, RUTA_IMAGENES.'gr/'.$nombrePng);
		rename(RUTA_IMAGENES.'ch/'.$rutaPng, RUTA_IMAGENES.'ch/'.$nombrePng);
		rename(RUTA_IMAGENES.$rutaPng, RUTA_IMAGENES.$nombrePng);
	}
	if (is_file(RUTA_IMAGENES.'gr/'.$rutaJpg)) {
		$imagen = new Imagen ();
		$imagen->ruta = $nombreJpg;
		$propiedad->imagenes[] = $imagen;
		$imagen->save();
		rename(RUTA_IMAGENES.'ch/'.$rutaJpg, RUTA_IMAGENES.'ch/'.$nombreJpg);
		rename(RUTA_IMAGENES.'gr/'.$rutaJpg, RUTA_IMAGENES.'gr/'.$nombreJpg);
		rename(RUTA_IMAGENES.$rutaJpg, RUTA_IMAGENES.$nombreJpg);
	}
	$propiedad->save();
}*/

$contenidoMail = 'La publicaci&oacute;n <a href="'.RUTA.'articulo.php?id='.$propiedad->id.'">'.$propiedad->titulo.'</a> ya se encuentra cargada y est&aacute; a la espera de ser aprobada por el administrador.';
	
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
$mail->AddAddress($propiedad->publicacion->owner->email);
$mail->IsHTML(true);
$mail->CharSet = 'UTF-8';
$mail->Subject = "Publicación cargada - ".$propiedad->titulo;
$mail->Body = $mailTemplate;
/*$exito = $mail->Send();

$intento=1; 
while ((!$exito) && ($intento <= 3)) {
	sleep(3);
	$exito = $mail->Send();
	$intento++;	
}*/


header('location: '.RUTA.'articulo.php?id='.$propiedad->id);
?>