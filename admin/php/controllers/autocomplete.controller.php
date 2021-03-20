<?php
include('../includes/definer.php');
include(INC.'../php/bootstrap.php');
$tags = Doctrine_Query::create()
        ->select("CONCAT(s.contenido, ' (', c.contenido, ')') as label, s.contenido as value, s.id")
        ->from('Subcategoria s')
        ->innerJoin('s.categoria c')
        ->where('s.contenido like ?', $_GET['term'].'%')
        ->limit(5)
        ->offset(0)
        ->orderBy('s.contenido')
        ->execute(array(), Doctrine::HYDRATE_ARRAY);
header("Content-type: application/json");
echo(json_encode($tags));
?>