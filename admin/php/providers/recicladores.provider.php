<?php
include_once('../includes/definer.php');
include_once('../../../php/bootstrap.php');

$orderColumn = array(
    'r.nombre',
    'r.web',
    'r.email',
    'r.id'
);
$recordsTotal = Doctrine_Query::create()
        ->select('count(r.id)')
        ->from('Reciclador r')
;
$recordsFiltered = $recordsTotal->copy();

$data = Doctrine_Query::create()
        ->select('
            r.id,
            CONCAT("row", r.id) as DT_RowId,
            CONCAT("
                <a href=\"#\" data-id=\"",r.id,"\" class=\"btn btn-danger borrarReciclador\"><i class=\"fa fa-trash-o\"></i></a>
                <a href=\"reciclador/",r.slug,"\" class=\"btn btn-primary\"><i class=\"fa fa-pencil\"></i></a>
            "
            ) as acciones,
            r.nombre as nombre,
            r.web as web,
            r.email as email
        ')
        ->from('Reciclador r')
        ->limit($_GET['length'])
        ->offset($_GET['start'])
        ->orderBy($orderColumn[$_GET['order'][0]['column']].' '.$_GET['order'][0]['dir'])
;

//busqueda
if ($_GET['search']['value']) {
    $data->andWhere('r.nombre like ?', array($_GET['search']['value'].'%'));
    $recordsFiltered->andWhere('r.nombre like ?', array($_GET['search']['value'].'%'));
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