<?php
include_once('../includes/definer.php');
include_once('../../../php/bootstrap.php');

$orderColumn = array(
    'r.material',
    'r.precio_kg',
    'r.variacion_precio',
	'r.variacion_porcentaje',
	'r.tipo',
    'r.id'
);
$recordsTotal = Doctrine_Query::create()
        ->select('count(r.id)')
        ->from('ListaPrecio r')
;
$recordsFiltered = $recordsTotal->copy();

$data = Doctrine_Query::create()
        ->select('
            r.id,
            CONCAT("row", r.id) as DT_RowId,
            CONCAT("
                <a href=\"#\" data-id=\"",r.id,"\" class=\"btn btn-danger borrarListaPrecio\"><i class=\"fa fa-trash-o\"></i></a>
                <a href=\"recicladores/listaPrecio/",r.slug,"\" class=\"btn btn-primary\"><i class=\"fa fa-pencil\"></i></a>
            "
            ) as acciones,
            r.material as material,
            r.precio_kg as precio_kg,
            r.variacion_precio as variacion_precio,
            r.variacion_porcentaje as variacion_porcentaje,
			r.tipo as tipo,
        ')
        ->from('ListaPrecio r')
        ->limit($_GET['length'])
        ->offset($_GET['start'])
        ->orderBy($orderColumn[$_GET['order'][0]['column']].' '.$_GET['order'][0]['dir'])
;

//busqueda
if ($_GET['search']['value']) {
    $data->andWhere('r.material like ?', array($_GET['search']['value'].'%'));
    $recordsFiltered->andWhere('r.material like ?', array($_GET['search']['value'].'%'));
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