<?php
include_once('../includes/defined.php');
include_once('../bootstrap.php');
if ( !($usuario = Doctrine::getTable('usuario')->findOneByCodigo($_POST['codigo']))) {
	echo ('usuarioInvalido.error.php');
	exit();
}
if ( !($propiedad = Doctrine::getTable('propiedad')->find($_POST['propiedadId']))) {
	echo ('propiedadInvalido.error.php');
	exit();
}
if ($_POST['accion'] == 'btnDejarDeSeguir') {
	$q = Doctrine_Query::create()
		->delete('Favorito')
		->where('user_id = '.$usuario->id)
		->andWhere('favorito_id = '.$propiedad->publicacion->id);
	$q->execute();
	echo('dejar');
	exit();
}

//valida que el usuario no pueda seguir un propiedad que ya esta siguiendo
if ($usuario->inFavoritos($propiedad)) {
	echo ('seguirRepetido.error.php');
	exit();
} else if ($propiedad->publicacion->owner->id == $usuario->id){
	echo ('seguirPropiedadPropio.error.php');
	exit();
} else {
	$usuario->favoritos[] = $propiedad->publicacion;
	$usuario->save();
	exit();
}


?>