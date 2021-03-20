<?php
include_once('../includes/definer.php');
include_once('../../../php/bootstrap.php');
 
$orderColumn = array(
    'j.titulo',
    'j.id'
);
$recordsTotal = Doctrine_Query::create()
        ->select('count(j.id)')
        ->from('Jornada j')
        ->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR)
;

$data = Doctrine_Query::create()
        ->select('
            j.id,
            CONCAT("row", j.id) as DT_RowId,
            CONCAT("
                <a href=\"#\" data-id=\"",j.id,"\" class=\"btn btn-danger borrarJornada\"><i class=\"fa fa-trash-o\"></i></a>
                <a href=\"jornada/",j.slug,"\" class=\"btn btn-primary\"><i class=\"fa fa-pencil\"></i></a>
            "
            ) as acciones,
            j.titulo as titulo,
            j.blog as blog
        ')
        ->from('Jornada j')
        ->limit($_GET['length'])
        ->offset($_GET['start'])
        ->orderBy($orderColumn[$_GET['order'][0]['column']].' '.$_GET['order'][0]['dir'])
;

//busqueda
if ($_GET['search']['value']) {
    $data->andWhere('j.titulo like ?', array($_GET['search']['value'].'%'));
}
//fin busqueda

//echo(json_encode($data)); exit();
$result = array(
    'recordsTotal'=>$recordsTotal,
    'recordsFiltered'=>$recordsTotal,
    'data'=>$data->execute(array(), Doctrine::HYDRATE_ARRAY)
);
echo(str_replace('puntopunto', '..', json_encode($result)));
?>