<?php
$html = str_replace('${titulo}', (utf8_decode($caso->titulo)), $html);
$html = str_replace('${categoria}', ($caso->subcategoria->categoria->contenido), $html);
$html = str_replace('${subcategoria}', ($caso->subcategoria->contenido), $html);
$html = str_replace('${ubicacion}', (utf8_decode($caso->ubicacion->value)), $html);
$html = str_replace('${descripcion}', nl2br((utf8_decode($caso->descripcion))), $html);

//imagenes
$imagenesGrTpl = '';
$imagenesChTpl = '';
$i=0;
foreach ($caso->sortedImages() as $imagen) {
    $active = (!$i)?'active ':'';
    $imagenesGrTpl .= '
        <a href="content/casos-exitosos/'.$imagen['ruta'].'" class="galleryBox" rel="galleryBox" title="'.(utf8_decode($caso->titulo)).'">
           <div class="zoomHover" style="display: block;"></div>
           <img width="160" src="content/casos-exitosos/thumb/'.$imagen['ruta'].'" alt="'.(utf8_decode($caso->titulo)).'" class="'.$active.'galeria">
       </a>
    ';
    $imagenesChTpl .= '
        <img width="70" alt="'.(utf8_decode($caso->titulo)).'" src="content/casos-exitosos/thumb/'.$imagen['ruta'].'" id="img'.$i.'" class="fadeFotos">
    ';
    $i++;
}
$html = str_replace('${imagenesGrTpl}', $imagenesGrTpl, $html);
$html = str_replace('${imagenesChTpl}', $imagenesChTpl, $html);

$html = preg_replace('/\${*[A-Za-z0-9_]*\}*/', '', $html);
?>