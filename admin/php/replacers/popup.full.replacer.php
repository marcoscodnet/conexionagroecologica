<?php
$html = str_replace('${accion}', $accion, $html);
$html = str_replace('${icon}', $icon, $html);
$html = str_replace('${id}', $popup->id, $html);
$html = str_replace('${imgprefix}', time() . '' . rand(1, 99999), $html);
$html = str_replace('${titulo}', $popup->titulo, $html);
$html = str_replace('${ruta}', $popup->ruta, $html);

$html = str_replace('${checked}',  ($popup->popup_activo)?'checked="checked"':'', $html);

//imagenes
$images = '';
foreach ($popup->sortedImages() as $img) {
    $images .= $imagesTpl;
    $images = str_replace('${id}', $img['id'], $images);
    $images = str_replace('${src}', URL.'../content/popups-conexion/thumb/'.$img['ruta'], $images);
}
$html = str_replace('${imagenes}', $images, $html);

$html = preg_replace('/\${*[A-Za-z0-9_]*\}*/', '', $html);
?>