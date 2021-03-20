<?php
if (!isset($conn)) include('../bootstrap.php');
if (!defined('RUTA')) include('../includes/defined.php');
if (!class_exists('Paginador')) include('../clases/Paginador.php');
$cuantos = 8;
$pagina = (isset($_POST['pagina']))?$_POST['pagina']:1;
$desde = ($pagina-1)*$cuantos;

$q = Doctrine_Query::create()
        ->select('e.id, e.titulo, e.organizador, DATE_FORMAT(e.fecha, "%d-%m-%Y a las %H:%i hs") as fecha, e.direccion, e.web, e.telefono, e.email, e.fb, e.tw, cat.value as categoria, prov.contenido as provincia')
        ->from('Evento e')
        ->innerJoin('e.categoria as cat')
        ->innerJoin('e.provincia as prov')
        ->orderBy('e.fecha asc')
;
if (isset($_POST['categoria']) && $_POST['categoria']) $q->addWhere('cat.id = ?', $_POST['categoria']);
if (isset($_POST['provincia']) && $_POST['provincia']) $q->addWhere('prov.id = ?', $_POST['provincia']);
$q2 = $q->copy();
$total = $q->removeDqlQueryPart('select')->addSelect('count(e.id)')->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR);
$eventos = $q2->limit($cuantos)->offset($desde)->execute(array(), Doctrine::HYDRATE_ARRAY);
if (!count($eventos)) exit();
$html = '${eventos}';
include(RUTA_LOCAL.'php/replacers/eventos.replacer.php');
$html .= Paginador::crearNumeritos($cuantos, $total, 'paginador', $pagina);
echo($html);
?>
