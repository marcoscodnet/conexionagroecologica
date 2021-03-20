<?php
include_once('../bootstrap.php');
$subcategorias = Doctrine_Query::create()
        ->select('id, contenido')
        ->from('Subcategoria s')
        ->innerJoin('s.categoria c WITH c.id = ?', $_POST['categoria'])
        ->execute(array(), Doctrine::HYDRATE_ARRAY)
;
header("Content-type: application/json");
echo(json_encode($subcategorias));
?>