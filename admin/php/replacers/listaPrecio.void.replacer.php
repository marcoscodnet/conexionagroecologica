<?php
$html = str_replace('${accion}', $accion, $html);
$html = str_replace('${icon}', $icon, $html);
$html = str_replace('${title}', 'Nuevo Precio', $html);
$html = str_replace('${preciokg}', 0, $html);
$html = str_replace('${variacionprecio}', 0, $html);
$html = str_replace('${variacionporcentaje}', 0, $html);

$html = preg_replace('/\${*[A-Za-z0-9]*\}*/', '', $html);
?>