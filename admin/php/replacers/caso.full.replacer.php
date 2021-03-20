<?php
$html = str_replace('${accion}', $accion, $html);
$html = str_replace('${icon}', $icon, $html);
$html = str_replace('${id}', $caso->id, $html);
$html = str_replace('${imgprefix}', time() . '' . rand(1, 99999), $html);
$html = str_replace('${title}', $caso->titulo, $html);
$html = str_replace('${titulo}', $caso->titulo, $html);
$html = str_replace('${descripcion}', $caso->descripcion, $html);
$html = str_replace('${checked}',  ($caso->destacado)?'checked="checked"':'', $html);
/*$html = str_replace('${subcategoriaToSelect}', Subcategoria::toSmartSelect($caso), $html);
$html = str_replace('${categoriaToSelect}', Categoria::toSmartSelect($caso->subcategoria), $html);*/
$html = str_replace('${ubicacionToSelect}', Ubicacion::toSmartSelect($caso), $html);


//imagenes
$images = '';
foreach ($caso->sortedImages() as $img) {
    $images .= $imagesTpl;
    $images = str_replace('${id}', $img['id'], $images);
    $images = str_replace('${src}', URL.'../content/casos-exitosos/thumb/'.$img['ruta'], $images);
}
$html = str_replace('${imagenes}', $images, $html);


$html = preg_replace('/\${*[A-Za-z0-9_]*\}*/', '', $html);
?>