<?php
include_once('../includes/definer.php');
include_once('../../../php/bootstrap.php');

$orderColumn = array(
    'p.titulo',
    'p.id'
);
$recordsTotal = Doctrine_Query::create()
        ->select('count(p.id)')
        ->from('popup p')
        ->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR)
;

$data = Doctrine_Query::create()
        ->select('
            p.id,
            CONCAT("row", p.id) as DT_RowId,
            CONCAT("
                <a href=\"#\" data-id=\"",p.id,"\" class=\"btn btn-danger borrarPopup\"><i class=\"fa fa-trash-o\"></i></a>
                <a href=\"popup/",p.slug,"\" class=\"btn btn-primary\"><i class=\"fa fa-pencil\"></i></a>
            "
            ) as acciones,
            p.titulo as titulo,
            p.popup_activo as popup_activo,
            p.ruta as ruta
        ')
        ->from('popup p')
        ->limit($_GET['length'])
        ->offset($_GET['start'])
        ->orderBy($orderColumn[$_GET['order'][0]['column']].' '.$_GET['order'][0]['dir'])
;

//busqueda
if ($_GET['search']['value']) {
    $data->andWhere('p.titulo like ?', array($_GET['search']['value'].'%'));
}
//fin busqueda

$restul = array(
    'recordsTotal'=>$recordsTotal,
    'recordsFiltered'=>$recordsTotal,
    'data'=>$data->execute(array(), Doctrine::HYDRATE_ARRAY)
);
echo(str_replace('puntopunto', '..', json_encode($restul)));
?>