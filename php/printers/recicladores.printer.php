<?php
if (!isset($conn)) include('../bootstrap.php');
if (!defined('RUTA')) include('../includes/defined.php');
if (!class_exists('Paginador')) include('php/clases/Paginador.php');
$cuantos = 13;
$pagina = (isset($_POST['pagina']))?$_POST['pagina']:1;
$desde = ($pagina-1)*$cuantos;

$q = Doctrine_Query::create()
        ->select('p.id, p.nombre, p.tel, p.email, p.web, p.direccion, p.latitud, p.longitud, cat.contenido as categoria, sub.contenido as subcategoria, prov.contenido as provincia, l.contenido as localidad')
        ->from('Reciclador p')
        ->leftJoin('p.subcategorias as sub')
        ->leftJoin('sub.categoria as cat')
        ->leftJoin('p.localidad as l')
        ->leftJoin('l.provincia as prov')
        ->limit($cuantos)
        ->offset($desde)
        ->orderBy('p.nombre')
;
//echo ($q->getSqlQuery());
if (isset($_POST['categoria']) && $_POST['categoria']) $q->addWhere('cat.id = ?', $_POST['categoria']);
if (isset($_POST['subcategoria']) && $_POST['subcategoria']) $q->addWhere('sub.id = ?', $_POST['subcategoria']);
if (isset($_POST['localidad']) && $_POST['localidad']) $q->addWhere('l.id = ?', $_POST['localidad']);
if (isset($_POST['provincia']) && $_POST['provincia']) $q->addWhere('prov.id = ?', $_POST['provincia']);
if (isset($_POST['tipo']) && $_POST['tipo']) $q->addWhere('p.id_tipo = ?', $_POST['tipo']);
$q2 = $q->copy();
$total = $q->removeDqlQueryPart('select')->addSelect('count(p.id)')->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR);
$recicladores = $q2->limit($cuantos)->offset($desde)->execute();

$html = file_get_contents(RUTA_LOCAL.'tpl/recicladores.tpl');
include(RUTA_LOCAL.'php/replacers/recicladores.replacer.php');
$html .= Paginador::crearNumeritos($cuantos, $total, 'paginador', $pagina);
echo($html);
?>