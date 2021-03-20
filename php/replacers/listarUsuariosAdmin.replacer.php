<?php
$pagina = $_POST['pagina'] - 1;

$cuantos = 21;
$desde = $pagina * $cuantos;
//print_r($_POST);
$q = Doctrine_Query::create()
        ->select('count(u.id)')
        ->from('Usuario u')
        ->leftJoin('u.localidad l')
        ->leftJoin('l.provincia prov')
        ->where('u.id <> 1')
        ->andWhere('u.id <> 2');
if ($_POST['productor']==1) {
	$q->andWhere('u.productor = 1');
}  
if (isset($_POST['provincia']) && ($_POST['provincia']!='')&& ($_POST['provincia']!='undefined')) {
	$q->addWhere ('prov.id = ?', $_POST['provincia']);
	if (isset($_POST['localidad']) && ($_POST['localidad']!='')&& ($_POST['localidad']!='undefined')) $q->addWhere ('l.id = ?', $_POST['localidad']);
}


$total = $q->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR);

$q = Doctrine_Query::create()
        ->select('u.*')
        ->from('Usuario u')
        ->leftJoin('u.localidad l')
        ->leftJoin('l.provincia prov')
        ->where('u.id <> 1')
        ->andWhere('u.id <> 2')
        ->limit($cuantos) //cuantos trae
        ->offset($desde) //a partir de donde empieza a traer
        ->orderBy('u.nombre');
if ($_POST['productor']==1) {
	$q->andWhere('u.productor = 1');
}          
if (isset($_POST['provincia']) && ($_POST['provincia']!='')&& ($_POST['provincia']!='undefined')){
	$q->addWhere ('prov.id = ?', $_POST['provincia']);
	if (isset($_POST['localidad']) && ($_POST['localidad']!='')&& ($_POST['localidad']!='undefined')) $q->addWhere ('l.id = ?', $_POST['localidad']);
}

$usuarios=$q->execute();

foreach ($usuarios as $usuario) {
    if ($usuario->codigo == Usuario::admin()->codigo || $usuario->codigo == Usuario::syst()->codigo)
        continue;
    $a = rand(1, 200);
    $b = time();
    $c = rand(1, 200);
    $d = md5('passAdmin');
    $e = rand(1, 200);
    $html .= $template;
    $html = str_replace('<!--{a}-->', $a, $html);
    $html = str_replace('<!--{b}-->', $b, $html);
    $html = str_replace('<!--{c}-->', $c, $html);
    $html = str_replace('<!--{d}-->', $d, $html);
    $html = str_replace('<!--{e}-->', $e, $html);
    $html = str_replace('<!--{usuarioId}-->', $usuario->id, $html);
    $html = str_replace('<!--{usuarioToString}-->', utf8_encode($usuario->toString()), $html);
    $html = str_replace('<!--{mailToString}-->', ($usuario->email), $html);
    $html = str_replace('<!--{mailToTelefono}-->', 'Telefono: '.($usuario->telefonoToString().' Celular: '.$usuario->celularToString()), $html);
    //$html = str_replace('<!--{usuarioReputacion}-->', $usuario->reputacion, $html);
    $html = preg_replace('/<!-+\{*[A-Za-z0-9]*\}*-+>/', '', $html);
}

$html .= Paginador::crearNumeritos($cuantos, $total, 'listarMensajesAdmin', $_POST['pagina']);
?>