<?php
include_once('../bootstrap.php');
/*include_once('../clases/Archivo.php');
include_once('../clases/Texto.php');*/

if ($_POST['categoria']!=-1) {
	$q = Doctrine_Query::create()
        ->select('s.*')
        ->from('Subcategoria s')     
        ->innerJoin('s.categoria c')
        ->where('1= 1');
        

	if (isset($_POST['categoria']) && $_POST['categoria']) $q->addWhere ('c.id = ?', $_POST['categoria']);
	if (isset($_POST['subcategoria']) && $_POST['subcategoria']) $q->addWhere ('s.id = ?', $_POST['subcategoria']);
	
	//echo $q->getSQLQuery();
	$subcategorias = $q->execute();
}
if ($_POST['provincia']!=-1) {
	$q = Doctrine_Query::create()
        ->select('s.*')
        ->from('Localidad s')     
        ->innerJoin('s.provincia c')
        ->where('1= 1');

	if (isset($_POST['provincia']) && $_POST['provincia']) $q->addWhere ('c.id = ?', $_POST['provincia']);
	if (isset($_POST['localidad']) && $_POST['localidad']) $q->addWhere ('s.id = ?', $_POST['localidad']);
	
	$localidades = $q->execute();
}



$usuario = Doctrine::getTable('usuario')->findOneByCodigo($_POST['fg']);

if ($usuario->id) {
	$usuario_intereses = Doctrine::getTable('UsuarioIntereses')->findOneByid_usuario($usuario->id);
	if (!$usuario_intereses) {	
		$usuario_intereses = new UsuarioIntereses();
		
	}
	$usuario_intereses->id_usuario = $usuario->id;
	$usuario_intereses->updated_at = date("Y-m-d H:i:s");
	//print_r($usuario_intereses->subcategorias); 
    foreach ($subcategorias as $subcategoria) {
        if ($subcategoria = Doctrine::getTable('Subcategoria')->find($subcategoria->id)) {
        	//echo $subcategoria->contenido;
            $usuario_intereses->subcategorias[] = $subcategoria;
        }
    
	}
	foreach ($localidades as $localidad) {
        if ($localidad = Doctrine::getTable('Localidad')->find($localidad->id)) {
        	
            $usuario_intereses->localidades[] = $localidad;
        }
    
	}
	$usuario_intereses->save();
}





?>