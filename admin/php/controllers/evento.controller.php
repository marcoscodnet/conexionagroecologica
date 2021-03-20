<?php
include_once('../includes/definer.php');
include(INC.'../php/bootstrap.php');

$evento = ($_POST['id'])?Doctrine::getTable('evento')->find($_POST['id']):$evento = new Evento();

//INFO
$evento->titulo = $_POST['titulo'];
$evento->fecha = formatDate($_POST['dia']);
$evento->id_categoria = $_POST['categoria'];

$evento->organizador = $_POST['organizador'];
$evento->telefono = $_POST['telefono'];
$evento->direccion = $_POST['direccion'];
$evento->id_provincia = $_POST['provincia'];

$evento->email = $_POST['email'];
$evento->web = addhttp($_POST['web']);
$evento->fb = addhttp($_POST['facebook']);
$evento->tw = addhttp($_POST['twitter']);

$evento->save();

$accion = ($_POST['id'])?'#edit':'#new';
header('location: '.URL.'eventos'.$accion);

function addhttp($url) {
    if ($url && !preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}

function formatDate ($dia) {
    $date = preg_replace('/([0-9]{2})-([0-9]{2})-([0-9]{4})/','$3-$2-$1', $dia).' 00:00:00';
    /*if (strpos($hora, 'PM')) {
        $date .= preg_replace('/([0-9]{1,2}):([0-9]{1,2}) (AM|PM)/e','("$1" + 12).":$2"', $hora);
    } else {
        $date .= preg_replace('/([0-9]{1,2}):([0-9]{1,2}) (AM|PM)/','$1:$2', $hora);
    }*/
    return $date;
}
?>