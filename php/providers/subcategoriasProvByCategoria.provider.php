<?php
include_once('../bootstrap.php');
//$conn->setCollate('utf8_unicode_ci');
//$conn->setCharset('utf8');
$subcategorias = Doctrine_Query::create()
        ->select('id, value')
        ->from('SubcategoriaProveedor s')
        ->innerJoin('s.categoria c WITH c.id = ?', $_POST['categoria'])
        ->execute(array(), Doctrine::HYDRATE_ARRAY)
;
header("Content-type: application/json");
echo(json_encode($subcategorias));
?>