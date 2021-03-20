<?php
$html = str_replace('${accion}', $accion, $html);
$html = str_replace('${imgprefix}', time() . '' . rand(1, 99999), $html);
$html = str_replace('${icon}', $icon, $html);
$html = str_replace('${title}', 'Nuevo Evento', $html);
$html = str_replace('${categoriaToSelect}', utf8_encode(CategoriaEvento::toSmartSelect()), $html);
$html = str_replace('${provinciaToSelect}', utf8_encode(Provincia::toSmartSelect()), $html);
$html = preg_replace('/\${*[A-Za-z0-9]*\}*/', '', $html);
?>