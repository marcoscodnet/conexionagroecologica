<?php
include_once('../bootstrap.php');
/*include_once('../clases/Archivo.php');
include_once('../clases/Texto.php');*/




$usuario = Doctrine::getTable('usuario')->findOneByCodigo($_POST['codigo']);

if ($usuario->id) {
	$usuario_intereses = Doctrine::getTable('UsuarioIntereses')->findOneByid_usuario($usuario->id);
	echo $usuario_intereses->id.' - '.$_POST['id'].' - '.$_POST['tabla'].'<br>';
	if(!$_POST['tabla']) {
		$q =Doctrine_Query::create()
		->delete('RelUsuarioInteresesSubcategoria')
		->where('id_usuario_intereses = ?', $usuario_intereses->id)
		->execute();
		$q =Doctrine_Query::create()
		->delete('RelUsuarioInteresesLocalidad')
		->where('id_usuario_intereses = ?', $usuario_intereses->id)
		->execute();
	}
	elseif ($_POST['tabla']=='RelUsuarioInteresesLocalidad') {
		$q =Doctrine_Query::create()
		->select('r.*')
		->from('RelUsuarioInteresesLocalidad r')
		->innerJoin('r.localidad l')
		->where('r.id_usuario_intereses = ?', $usuario_intereses->id)
		->andWhere('l.id_provincia = ?', $_POST['id']);
		//->execute();
		//echo $q->getSQLQuery();
		$result = $q->execute();
       $result->delete(); 
	}
	else{
		$q =Doctrine_Query::create()
		->delete('RelUsuarioInteresesSubcategoria')
		->where('id_usuario_intereses = ?', $usuario_intereses->id)
		->andWhere('id_subcategoria = ?', $_POST['id'])
		->execute();
	}
	
}





?>