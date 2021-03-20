<?php
$html = str_replace('${accion}', $accion, $html);
$html = str_replace('${icon}', $icon, $html);
$html = str_replace('${imgprefix}', time() . '' . rand(1, 99999), $html);
$html = str_replace('${title}', 'Nuevo Sponsor', $html);
$html = str_replace('${imagen}', $imagen, $html);
$html = str_replace('${categoriaToSelect}', CategoriaSponsor::toSmartSelect(), $html);
$html = str_replace('${sizeToSelect}', Sponsor::sizeToSelect(), $html);

$html = preg_replace('/\${*[A-Za-z0-9_]*\}*/', '', $html);
?>