<?php
include('../includes/definer.php');
include(INC.'../php/bootstrap.php');

$response = array('success'=>TRUE);
$sponsors = Doctrine_Query::create()
        ->select('count(s.id)')
        ->from('Sponsor s')
        ->where('p.id_categoria = ?', $_POST['id'])
        ->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR)
;
if ($sponsors != 0) {
    $response['success'] = FALSE;
    $response['errorMessage'] = 'No se puede borrar esta categor&iacute;a porque hay uno o m&aacute;s sponsors que pertenecen a la misma.';
}

if ($response['success']) {
    Doctrine_Query::create()->delete('CategoriaSponsor')->where('id = ?', $_POST['id'])->execute();
}
header('Content-type: application/json');
echo(json_encode($response));
?>