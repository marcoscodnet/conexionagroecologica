<?php
if (!isset($conn)) include('../bootstrap.php');
if (!defined('RUTA')) include('../includes/defined.php');
if (!class_exists('Paginador')) include('../clases/Paginador.php');
if (!class_exists('Texto')) include('../clases/Texto.php');

$cuantos = 8;
$pagina = (isset($_POST['pagina']))?$_POST['pagina']:1;
$desde = ($pagina-1)*$cuantos;

$q = Doctrine_Query::create()
        ->select('c.id, c.slug, c.titulo, c.descripcion, cat.contenido as categoria, sub.contenido as subcategoria, u.value as ubicacion, i.ruta as imagen')
        ->from('Caso c')
        ->innerJoin('c.ubicacion as u')
        ->innerJoin('c.imagenes as i')
        ->leftJoin('c.subcategoria as sub')
        ->leftJoin('sub.categoria as cat')
        ->orderBy('c.titulo, i.orden')
;
if (isset($_POST['categoria']) && $_POST['categoria']) $q->addWhere('cat.id = ?', $_POST['categoria']);
if (isset($_POST['subcategoria']) && $_POST['subcategoria']) $q->addWhere('sub.id = ?', $_POST['subcategoria']);
if (isset($_POST['ubicacion']) && $_POST['ubicacion']) $q->addWhere('u.id = ?', $_POST['ubicacion']);
$q2 = $q->copy();
$total = $q->removeDqlQueryPart('select')->addSelect('count(c.id)')->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR);
$casos = $q2->limit($cuantos)->offset($desde)->execute(array(), Doctrine::HYDRATE_ARRAY);

if (!count($casos)) exit();
$html = '${casosExitosos}';
$casoItem = file_get_contents(RUTA_LOCAL.'tpl/casos-exitosos-item.tpl');
include(RUTA_LOCAL.'php/replacers/casosExitosos.replacer.php');
$html .= Paginador::crearNumeritos($cuantos, $total, 'paginador', $pagina);
echo utf8_encode($html);
?>
