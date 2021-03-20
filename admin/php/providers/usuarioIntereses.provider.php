<?php
include_once('../includes/definer.php');
include_once('../../../php/bootstrap.php');
 
$orderColumn = array(
    'j.updated_at',
    'j.id'
);
$recordsTotal = Doctrine_Query::create()
        ->select('count(j.id)')
        ->from('UsuarioIntereses j')
        ->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR)
;

$data = Doctrine_Query::create()
        ->select('
            j.id,
            CONCAT("row", j.id) as DT_RowId,
           	j.updated_at as updated_at,
            CONCAT(u.nombre,\' \', u.apellido) as usuario, u.email as email, GROUP_CONCAT(DISTINCT CONCAT(c.contenido,\': \',s.contenido) SEPARATOR \' - \') as subcategorias,
            GROUP_CONCAT(DISTINCT p.contenido SEPARATOR \' - \') as localidades
        ')
        ->from('UsuarioIntereses j')
        ->innerJoin('j.usuario u')
        ->innerJoin('j.subcategorias s')
        ->innerJoin('s.categoria c')
        ->innerJoin('j.localidades l')
        ->innerJoin('l.provincia p')
        ->limit($_GET['length'])
        ->offset($_GET['start'])
        ->orderBy($orderColumn[$_GET['order'][0]['column']].' '.$_GET['order'][0]['dir'])
        ->groupBy('j.id')
;
//echo $data->getSQLQuery();
//busqueda
if ($_GET['search']['value']) {
    $data->andWhere('u.nombre like ?', array($_GET['search']['value'].'%'));
    $data->orWhere('u.apellido like ?', array($_GET['search']['value'].'%'));
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