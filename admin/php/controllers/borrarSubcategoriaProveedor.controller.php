<?php
include('../includes/definer.php');
include(INC.'../php/bootstrap.php');

$response = array('success'=>TRUE);

//chequear proveedores
$proveedores = Doctrine_Query::create()
        ->select('count(p.id)')
        ->from('Proveedor p')
        ->where('p.id_subcategoria = ?', $_POST['id'])
        ->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR)
;
if ($proveedores != 0) {
    $response['success'] = FALSE;
    $response['errorMessage'] = 'No se puede borrar esta subcategor&iacute;a porque hay uno o m&aacute;s proveedores que pertenecen a la misma.';
}

if ($response['success']) {
    Doctrine_Query::create()->delete('SubcategoriaProveedor')->where('id = ?', $_POST['id'])->execute();
}
header('Content-type: application/json');
echo(json_encode($response));
?>
