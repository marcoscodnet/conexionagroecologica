<?php
$html = str_replace('${accion}', $accion, $html);
$html = str_replace('${imgprefix}', time() . '' . rand(1, 99999), $html);
$html = str_replace('${icon}', $icon, $html);
$html = str_replace('${title}', 'Nuevo Proveedor', $html);
$html = str_replace('${subcategoriaToSelect}', '<select id="selectSubcategoriaProveedor" name="subcategoria"><option value="0">Elegir</optino></select>', $html);
$html = str_replace('${categoriaToSelect}', utf8_encode(CategoriaProveedor::toSmartSelect()), $html);
$html = str_replace('${localidadToSelect}', '<select id="selectLocalidad" name="localidad"><option value="0">Elegir</optino></select>', $html);
$html = str_replace('${provinciaToSelect}', utf8_encode(Provincia::toSmartSelect()), $html);
$html = preg_replace('/\${*[A-Za-z0-9]*\}*/', '', $html);
?>