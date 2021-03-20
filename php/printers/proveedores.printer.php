<?php
if (!isset($conn)) include('../bootstrap.php');
if (!defined('RUTA')) include('../includes/defined.php');
if (!class_exists('Paginador')) include('php/clases/Paginador.php');
$cuantos = 13;
$pagina = (isset($_POST['pagina']))?$_POST['pagina']:1;
$desde = ($pagina-1)*$cuantos;

$q = Doctrine_Query::create()
        ->select('p.id, p.nombre, p.tel, p.email, p.descripcion, p.web, cat.value as categoria, sub.value as subcategoria, prov.contenido as provincia, l.contenido as localidad')
        ->from('Proveedor p')
        ->innerJoin('p.subcategoria as sub')
        ->innerJoin('sub.categoria as cat')
        ->innerJoin('p.localidad as l')
        ->innerJoin('l.provincia as prov')
        ->limit($cuantos)
        ->offset($desde)
        ->orderBy('p.nombre')
;

if (isset($_POST['categoria']) && $_POST['categoria']) $q->addWhere('cat.id = ?', $_POST['categoria']);
if (isset($_POST['subcategoria']) && $_POST['subcategoria']) $q->addWhere('sub.id = ?', $_POST['subcategoria']);
if (isset($_POST['localidad']) && $_POST['localidad']) $q->addWhere('l.id = ?', $_POST['localidad']);
if (isset($_POST['provincia']) && $_POST['provincia']) $q->addWhere('prov.id = ?', $_POST['provincia']);

$q2 = $q->copy();
$total = $q->removeDqlQueryPart('select')->addSelect('count(p.id)')->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR);
$proveedores = $q2->limit($cuantos)->offset($desde)->execute(array(), Doctrine::HYDRATE_ARRAY);

$html = file_get_contents(RUTA_LOCAL.'tpl/proveedores.tpl');
include(RUTA_LOCAL.'php/replacers/proveedores.replacer.php');
$html .= Paginador::crearNumeritos($cuantos, $total, 'paginador', $pagina);
echo($html);
?>