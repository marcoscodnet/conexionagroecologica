<?php
include_once('php/includes/definer.php');
include('php/checkers/login.checker.php');
include('php/clases/Exportexcel.Class.php');
include_once('../php/bootstrap.php');
/*$data = Doctrine_Query::create()
        ->select('j.updated_at as updated_at,
            CONCAT(u.nombre,\' \', u.apellido) as usuario, u.email as email, GROUP_CONCAT(DISTINCT CONCAT(c.contenido,\': \',s.contenido) SEPARATOR \' - \') as subcategorias,
            GROUP_CONCAT(DISTINCT CONCAT(p.contenido,\': \',l.contenido) SEPARATOR \' - \') as localidades
        ')
        ->from('UsuarioIntereses j')
        ->innerJoin('j.usuario u')
        ->innerJoin('j.subcategorias s')
        ->innerJoin('s.categoria c')
        ->innerJoin('j.localidades l')
        ->innerJoin('l.provincia p')
        ->groupBy('j.id')
;*/
//echo $data->getSQLQuery();
//$contenido = $data->execute(array(), Doctrine::HYDRATE_ARRAY);
//print_r($contenido);
$data = Doctrine_Query::create()
        ->select('u.*
        ')
        ->from('UsuarioIntereses u');
$usuarios = $data->execute();
$contenido = array();
foreach ($usuarios as $usuario) {
	$contenido[] = Array($usuario->updated_at,utf8_decode($usuario->usuario->nombre.' '.$usuario->usuario->apellido),$usuario->usuario->email,utf8_decode($usuario->subcategoriasToString(' - ')),utf8_decode($usuario->localidadesToString(' - ')));
}
$titulos = Array('Fecha','Usuario','E-mail','Subcategorias','Provincias');
	$oExportar = new Exportexcel('Usuarios_Intereses');
	$oExportar->GetHTMLPreview($titulos,$contenido);
?>
