<?php
include_once('../includes/definer.php');
include_once(INC.'../php/bootstrap.php');
$conn->setCollate('utf8_unicode_ci');
$conn->setCharset('utf8');
$subcategorias = Doctrine_Query::create()
        ->select('id, contenido')
        ->from('Localidad s')
        ->innerJoin('s.provincia p WITH p.id = ?', $_POST['provincia'])
        ->execute(array(), Doctrine::HYDRATE_ARRAY)
;
header("Content-type: application/json");
echo(json_encode($subcategorias));
?>