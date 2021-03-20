<?php
$html = str_replace('${accion}', $accion, $html);
$html = str_replace('${imgprefix}', time() . '' . rand(1, 99999), $html);
$html = str_replace('${icon}', $icon, $html);
$html = str_replace('${title}', 'Nueva Caso de Éxito', $html);
/*$html = str_replace('${subcategoriaToSelect}', '<select id="selectSubcategoria" name="subcategoria"><option value="0">Elegir</optino></select>', $html);
$html = str_replace('${categoriaToSelect}', Categoria::toSmartSelect(), $html);*/
$html = str_replace('${ubicacionToSelect}', Ubicacion::toSmartSelect(), $html);
$html = preg_replace('/\${*[A-Za-z0-9]*\}*/', '', $html);
?>