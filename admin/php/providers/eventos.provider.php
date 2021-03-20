<?php
include_once('../includes/definer.php');
include_once(INC.'../php/bootstrap.php');

$orderColumn = array(
    'e.titulo',
    'e.fecha',
    'c.value',
    'e.contenido',
    'e.id'
);
$recordsTotal = Doctrine_Query::create()
        ->select('count(e.id)')
        ->from('Evento e')
        ->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR)
;

$data = Doctrine_Query::create()
        ->select('
            e.id,
            CONCAT("row", e.id) as DT_RowId,
            CONCAT("
                <a href=\"#\" data-id=\"",e.id,"\" class=\"btn btn-danger borrarEvento\"><i class=\"fa fa-trash-o\"></i></a>
                <a href=\"evento/",e.slug,"\" class=\"btn btn-primary\"><i class=\"fa fa-pencil\"></i></a>
                <!--<a href=\"puntopunto/evento/",e.slug,"\" class=\"btn btn-primary\"><i class=\"fa fa-eye\"></i></a>-->
            "
            ) as acciones,
            e.titulo as titulo,
            DATE_FORMAT(e.fecha, "%d-%m-%Y") as fecha,
            cat.value as categoria,
            prov.contenido as provincia,
        ')
        ->from('Evento e')
        ->innerJoin('e.categoria as cat')
        ->innerJoin('e.provincia as prov')
        ->limit($_GET['length'])
        ->offset($_GET['start'])
        ->orderBy($orderColumn[$_GET['order'][0]['column']].' '.$_GET['order'][0]['dir'])
;

//busqueda
if ($_GET['search']['value']) {
    $data->andWhere('e.titulo like ?', array($_GET['search']['value'].'%'));
}
//fin busqueda

//echo(json_encode($productos)); exit();
$restul = array(
    'recordsTotal'=>$recordsTotal,
    'recordsFiltered'=>$recordsTotal,
    'data'=>$data->execute(array(), Doctrine::HYDRATE_ARRAY)
);
echo(str_replace('puntopunto', '..', json_encode($restul)));
?>