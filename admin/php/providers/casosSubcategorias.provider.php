<?php
include_once('../includes/definer.php');
include_once(INC.'../php/bootstrap.php');

$orderColumn = array(
    's.contenido',
    's.id'
);
$recordsTotal = Doctrine_Query::create()
        ->select('count(s.id)')
        ->from('Subcategoria s')
        ->innerJoin('s.categoria c WITH c.id = ?', $_GET['id'])
;
$recordsFiltered = $recordsTotal->copy();

$data = Doctrine_Query::create()
        ->select('
            s.id,
            CONCAT("row", s.id) as DT_RowId,
            CONCAT("
                <a href=\"#\" data-id=\"",s.id,"\" class=\"btn btn-danger borrarSubcategoria\"><i class=\"fa fa-trash-o\"></i></a>
                <a href=\"#\" data-id=\"",s.id,"\" data-value=\"",s.contenido,"\" class=\"btn btn-primary editarSubcategoria\"><i class=\"fa fa-pencil\"></i></a>
            "
            ) as acciones,
            s.contenido as subcategoria
        ')
        ->from('Subcategoria s')
        ->innerJoin('s.categoria c WITH c.id = ?', $_GET['id'])
        ->limit($_GET['length'])
        ->offset($_GET['start'])
        ->orderBy($orderColumn[$_GET['order'][0]['column']].' '.$_GET['order'][0]['dir'])
;

//busqueda
if ($_GET['search']['value']) {
    $data->andWhere('s.contenido like ?', array($_GET['search']['value'].'%'));
    $recordsFiltered->andWhere('s.contenido like ?', array($_GET['search']['value'].'%'));
}
//fin busqueda

//echo(json_encode($productos)); exit();
$restul = array(
    'recordsTotal'=>$recordsTotal->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR),
    'recordsFiltered'=>$recordsFiltered->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR),
    'data'=>$data->execute(array(), Doctrine::HYDRATE_ARRAY)
);
echo(json_encode($restul));
?>