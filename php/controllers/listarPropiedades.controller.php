<?php
include_once('../bootstrap.php');
include_once('../clases/Archivo.php');
include_once('../clases/Texto.php');
include_once('../clases/Paginador.php');

$pagina = $_POST['pagina']-1;
$cuantos = 10;
$desde = $pagina * $cuantos;

$hectareaX = $_POST['hectareaX'];
$hectareaY = $_POST['hectareaY'];
$posiblesUsoSuelo = array();
foreach($_POST as $campo => $valor){ 
	
	if (strpos($campo, 'osibles')) {
		
		$arreglo=explode('_', $campo);
		$posiblesUsoSuelo[]=$arreglo[1];
	}
}
$ids = join(",",$posiblesUsoSuelo);  

$q = Doctrine_Query::create()
        ->select('p.*')
        ->from('Propiedad p')
        //->leftJoin('p.subcategoria s')
        ->leftJoin('p.publicacion pb')
        ->leftJoin('pb.estado e')
        /*->leftJoin('s.categoria c')
        ->leftJoin('p.sugerencia sg')
        ->leftJoin('p.periodicidad r')*/
        ->leftJoin('p.direccion d')
        ->leftJoin('d.localidad l')
        ->leftJoin('l.provincia prov')
        ->where('pb.finalizacion >= "' . date('Y-m-d') . '"')
        ->andWhere('e.contenido = "aceptada" or e.contenido = "comprada"')
        ->orderBy('pb.inicio desc')
;
        

/*if (isset($_POST['categoria']) && $_POST['categoria']) $q->addWhere ('c.id = ?', $_POST['categoria']);
if (isset($_POST['subcategoria']) && $_POST['subcategoria']) $q->addWhere ('s.id = ?', $_POST['subcategoria']);
if (isset($_POST['periodicidad']) && $_POST['periodicidad']) $q->addWhere ('r.id = ?', $_POST['periodicidad']);*/
if (isset($_POST['provincia']) && $_POST['provincia']) $q->addWhere ('prov.id = ?', $_POST['provincia']);
if (isset($_POST['localidad']) && $_POST['localidad']) $q->addWhere ('l.id = ?', $_POST['localidad']);
if ($ids) {
	$ids ='('.$ids.')';
	$q->addWhere("p.id_posible_uso_suelo In ".$ids);
	//$q->setParameter('ids', $ids);
}
if ($hectareaX) {
   $q->addWhere('p.hectareas >= ?', $hectareaX);
    
}
if ($hectareaY) {
   $q->addWhere('p.hectareas <= ?', $hectareaY);
    
}

$q2 = $q->copy();
$total = $q->removeDqlQueryPart('select')->addSelect('count(p.id)')->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR);
$propiedades = $q2->limit($cuantos)->offset($desde)->execute();

// Mostrar resultado
$template = Archivo::leer('../../tpl/listarPropiedades.php');
$html = '';
include_once('../replacers/listarPropiedades.replacer.php');

$html .= Paginador::crearNumeritos ($cuantos, $total, 'listarPropiedades', $_POST['pagina']);
echo ($html);
?>