<?php
include_once('../includes/definer.php');
include_once(INC.'../php/bootstrap.php');

$orderColumn = array(
    's.nombre',
    'cat.value',
    's.id'
);
$recordsTotal = Doctrine_Query::create()
        ->select('count(s.id)')
        ->from('Sponsor s')
        ->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR)
;

$data = Doctrine_Query::create()
        ->select('
            s.id,
            CONCAT("row", s.id) as DT_RowId,
            CONCAT("
                <a href=\"#\" data-id=\"",s.id,"\" class=\"btn btn-danger borrarNosApoyan\"><i class=\"fa fa-trash-o\"></i></a>
                <a href=\"nos-apoyan/",s.slug,"\" class=\"btn btn-primary\"><i class=\"fa fa-pencil\"></i></a>
            "
            ) as acciones,
            convert(cast(s.nombre as binary) using utf8) as nombre,
            cat.value as categoria
        ')
        ->from('Sponsor s')
        ->innerJoin('s.categoria as cat')
        ->limit($_GET['length'])
        ->offset($_GET['start'])
        ->orderBy($orderColumn[$_GET['order'][0]['column']].' '.$_GET['order'][0]['dir'])
;

//busqueda
if ($_GET['search']['value']) {
    $data->andWhere('s.nombre like ?', array($_GET['search']['value'].'%'));
}
//fin busqueda

//echo(json_encode($productos)); exit();
$restul = array(
    'recordsTotal'=>$recordsTotal,
    'recordsFiltered'=>$recordsTotal,
    'data'=>$data->execute(array(), Doctrine::HYDRATE_ARRAY)
);
header("Content-type: application/json;charset=utf-8");
echo(json_encode($restul));
?>