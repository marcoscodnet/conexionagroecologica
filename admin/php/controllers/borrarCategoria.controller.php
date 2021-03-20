<?php
include('../includes/definer.php');
include(INC.'../php/bootstrap.php');

$response = array('success'=>TRUE);
$subcategorias = Doctrine_Query::create()
        ->select('s.id')
        ->from('Subcategoria s')
        ->innerJoin('s.categoria c WITH c.id = ?', $_POST['id'])
        ->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR)
;
if (!is_array($subcategorias)) $subcategorias = array($subcategorias);

//chequear productos
if (count($subcategorias)) {
    $productos = Doctrine_Query::create()
            ->select('count(p.id)')
            ->from('Producto p')
            ->innerJoin('p.publicacion pb')
            ->whereIn('p.id_subcategoria', $subcategorias)
            ->andWhere('pb.id_estado <> ?', 7)
            ->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR)
    ;
    if ($productos != 0) {
        $response['success'] = FALSE;
        $response['errorMessage'] = 'No se puede borrar esta categor&iacute;a porque hay uno o m&aacute;s productos que pertenecen a la misma.';
    }
}

//chequear casos
if ($response['success'] && count($subcategorias)) {
    $casos = Doctrine_Query::create()
            ->select('count(c.id)')
            ->from('Caso c')
            ->whereIn('c.id_subcategoria', $subcategorias)
            ->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR)
    ;
    if ($casos != 0) {
        $response['success'] = FALSE;
        $response['errorMessage'] = 'No se puede borrar esta categor&iacute;a porque hay uno o m&aacute;s casos que pertenecen a la misma.';
    }
}

//chequear reciclador
if ($response['success'] && count($subcategorias)) {
    $recicladores = Doctrine_Query::create()
            ->select('count(r.id)')
            ->from('Reciclador r')
            ->innerJoin('r.subcategorias as s')
            ->whereIn('s.id', $subcategorias)
            ->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR)
    ;
    if ($recicladores != 0) {
        $response['success'] = FALSE;
        $response['errorMessage'] = 'No se puede borrar esta categor&iacute;a porque hay uno o m&aacute;s recicladores que pertenecen a la misma.';
    }
}

if ($response['success']) {
    if (count($subcategorias) )Doctrine_Query::create()->delete('Subcategoria')->whereIn('id', $subcategorias)->execute();
    Doctrine_Query::create()->delete('Categoria')->where('id = ?', $_POST['id'])->execute();
}
header('Content-type: application/json');
echo(json_encode($response));
?>
