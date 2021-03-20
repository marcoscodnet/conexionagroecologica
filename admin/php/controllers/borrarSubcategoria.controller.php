<?php
include('../includes/definer.php');
include(INC.'../php/bootstrap.php');

$response = array('success'=>TRUE);

//chequear productos
$productos = Doctrine_Query::create()
        ->select('count(p.id)')
        ->from('Producto p')
        ->innerJoin('p.publicacion pb')
        ->where('p.id_subcategoria = ?', $_POST['id'])
        ->andWhere('pb.id_estado <> ?', 7)
        ->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR)
;
if ($productos != 0) {
    $response['success'] = FALSE;
    $response['errorMessage'] = 'No se puede borrar esta subcategor&iacute;a porque hay uno o m&aacute;s productos que pertenecen a la misma.';
}

//chequear casos
if ($response['success']) {
    $casos = Doctrine_Query::create()
            ->select('count(c.id)')
            ->from('Caso c')
            ->where('c.id_subcategoria = ?', $_POST['id'])
            ->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR)
    ;
    if ($casos != 0) {
        $response['success'] = FALSE;
        $response['errorMessage'] = 'No se puede borrar esta subcategor&iacute;a porque hay uno o m&aacute;s casos que pertenecen a la misma.';
    }
}

//chequear reciclador
if ($response['success']) {
    $recicladores = Doctrine_Query::create()
            ->select('count(r.id)')
            ->from('Reciclador r')
            ->innerJoin('r.subcategorias as s')
            ->where('s.id = ?', $_POST['id'])
            ->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR)
    ;
    if ($recicladores != 0) {
        $response['success'] = FALSE;
        $response['errorMessage'] = 'No se puede borrar esta categor&iacute;a porque hay uno o m&aacute;s recicladores que pertenecen a la misma.';
    }
}

if ($response['success']) {
    Doctrine_Query::create()->delete('Subcategoria')->where('id = ?', $_POST['id'])->execute();
}
header('Content-type: application/json');
echo(json_encode($response));
?>
