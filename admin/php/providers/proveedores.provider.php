<?php
include_once('../includes/definer.php');
include_once(INC.'../php/bootstrap.php');

$orderColumn = array(
    'p.nombre',
    'cat.value',
    'sub.value',
    'p.id'
);
$recordsTotal = Doctrine_Query::create()
        ->select('count(p.id)')
        ->from('Proveedor p')
        ->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR)
;

$data = Doctrine_Query::create()
        ->select('
            p.id,
            CONCAT("row", p.id) as DT_RowId,
            CONCAT("
                <a href=\"#\" data-id=\"",p.id,"\" class=\"btn btn-danger borrarProveedor\"><i class=\"fa fa-trash-o\"></i></a>
                <a href=\"proveedor/",p.slug,"\" class=\"btn btn-primary\"><i class=\"fa fa-pencil\"></i></a>
                <!--<a href=\"puntopunto/proveedor/",p.slug,"\" class=\"btn btn-primary\"><i class=\"fa fa-eye\"></i></a>-->
            "
            ) as acciones,
            p.nombre as nombre,
            cat.value as categoria,
            sub.value as subcategoria
        ')
        ->from('Proveedor p')
        ->innerJoin('p.subcategoria as sub')
        ->innerJoin('sub.categoria as cat')
        ->limit($_GET['length'])
        ->offset($_GET['start'])
        ->orderBy($orderColumn[$_GET['order'][0]['column']].' '.$_GET['order'][0]['dir'])
;

//busqueda
if ($_GET['search']['value']) {
    $data->andWhere('p.nombre like ?', array($_GET['search']['value'].'%'));
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