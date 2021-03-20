<?php
include_once('../includes/definer.php');
include_once(INC.'../php/bootstrap.php');

$orderColumn = array(
    'c.contenido',
    'c.id'
);
$recordsTotal = Doctrine_Query::create()
        ->select('count(c.id)')
        ->from('Categoria c')
;
$recordsFiltered = $recordsTotal->copy();

$data = Doctrine_Query::create()
        ->select('
            c.id,
            CONCAT("row", c.id) as DT_RowId,
            CONCAT("
                <a href=\"#\" data-id=\"",c.id,"\" class=\"btn btn-danger borrarCategoria\"><i class=\"fa fa-trash-o\"></i></a>
                <a href=\"casos/categoria/",c.id,"\" class=\"btn btn-primary\"><i class=\"fa fa-pencil\"></i></a>
            "
            ) as acciones,
            c.contenido as categoria
        ')
        ->from('Categoria c')
        ->limit($_GET['length'])
        ->offset($_GET['start'])
        ->orderBy($orderColumn[$_GET['order'][0]['column']].' '.$_GET['order'][0]['dir'])
;

//busqueda
if ($_GET['search']['value']) {
    $data->andWhere('c.contenido like ?', array($_GET['search']['value'].'%'));
    $recordsFiltered->andWhere('c.contenido like ?', array($_GET['search']['value'].'%'));
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