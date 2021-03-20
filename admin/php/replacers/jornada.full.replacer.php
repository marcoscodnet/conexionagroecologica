<?php
$html = str_replace('${accion}', $accion, $html);
$html = str_replace('${icon}', $icon, $html);
$html = str_replace('${id}', $jornada->id, $html);
$html = str_replace('${imgprefix}', time() . '' . rand(1, 99999), $html);
$html = str_replace('${title}', $jornada->titulo, $html);
$html = str_replace('${titulo}', $jornada->titulo, $html);
$html = str_replace('${descripcion}', $jornada->descripcion, $html);
$html = str_replace('${blog}', $jornada->blog, $html);

//imagenes
$images = '';
foreach ($jornada->sortedImages() as $img) {
    $images .= $imagesTpl;
    $images = str_replace('${id}', $img['id'], $images);
    $images = str_replace('${src}', URL.'../content/jornadas-exitosas/thumb/'.$img['ruta'], $images);
}
$html = str_replace('${imagenes}', $images, $html);


$html = preg_replace('/\${*[A-Za-z0-9_]*\}*/', '', $html);
?>