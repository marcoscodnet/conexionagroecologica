<?php
include_once('../includes/definer.php');
include_once(INC.'../php/bootstrap.php');

$orderColumn = array(
    'c.titulo',
    'u.value',
    'c.id'
);
$recordsTotal = Doctrine_Query::create()
        ->select('count(c.id)')
        ->from('Caso c')
        ->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR)
;

$data = Doctrine_Query::create()
        ->select('
            c.id,
            CONCAT("row", c.id) as DT_RowId,
            CONCAT("
                <a href=\"#\" data-id=\"",c.id,"\" class=\"btn btn-danger borrarCaso\"><i class=\"fa fa-trash-o\"></i></a>
                <a href=\"caso/",c.slug,"\" class=\"btn btn-primary\"><i class=\"fa fa-pencil\"></i></a>
                <!--<a href=\"puntopunto/caso/",c.slug,"\" class=\"btn btn-primary\"><i class=\"fa fa-eye\"></i></a>-->
            "
            ) as acciones,
            c.titulo as titulo,
            c.destacado as destacado,
            
            u.value as ubicacion
        ')
        ->from('Caso c')
        ->innerJoin('c.ubicacion as u')
        /*->leftJoin('c.subcategoria as sub')
        ->leftJoin('sub.categoria as cat')*/
        ->limit($_GET['length'])
        ->offset($_GET['start'])
        ->orderBy($orderColumn[$_GET['order'][0]['column']].' '.$_GET['order'][0]['dir'])
;

//busqueda
if ($_GET['search']['value']) {
    $data->andWhere('c.titulo like ?', array($_GET['search']['value'].'%'));
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