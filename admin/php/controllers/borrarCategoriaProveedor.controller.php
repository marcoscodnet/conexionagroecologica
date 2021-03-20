<?php
include('../includes/definer.php');
include(INC.'../php/bootstrap.php');

$response = array('success'=>TRUE);
$subcategorias = Doctrine_Query::create()
        ->select('s.id')
        ->from('SubcategoriaProveedor s')
        ->innerJoin('s.categoria c WITH c.id = ?', $_POST['id'])
        ->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR)
;
if (!is_array($subcategorias)) $subcategorias = array($subcategorias);

//chequear proveedores
if (count($subcategorias)) {
    $proveedores = Doctrine_Query::create()
            ->select('count(p.id)')
            ->from('Proveedor p')
            ->whereIn('p.id_subcategoria', $subcategorias)
            ->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR)
    ;
    if ($proveedores != 0) {
        $response['success'] = FALSE;
        $response['errorMessage'] = 'No se puede borrar esta categor&iacute;a porque hay uno o m&aacute;s proveedores que pertenecen a la misma.';
    }
}

if ($response['success']) {
    if (count($subcategorias) )Doctrine_Query::create()->delete('SubcategoriaProveedor')->whereIn('id', $subcategorias)->execute();
    Doctrine_Query::create()->delete('CategoriaProveedor')->where('id = ?', $_POST['id'])->execute();
}
header('Content-type: application/json');
echo(json_encode($response));
?>