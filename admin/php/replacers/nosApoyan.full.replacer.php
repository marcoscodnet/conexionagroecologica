<?php
$html = str_replace('${accion}', $accion, $html);
$html = str_replace('${icon}', $icon, $html);
$html = str_replace('${imgprefix}', time() . '' . rand(1, 99999), $html);
$html = str_replace('${imagen}', $imagen, $html);
$html = str_replace('${imagenId}', $sponsor->imagen->id, $html);
$html = str_replace('${id}', $sponsor->id, $html);
$html = str_replace('${title}', $sponsor->nombre, $html);
$html = str_replace('${nombre}', htmlspecialchars($sponsor->nombre), $html);
$html = str_replace('${link}', htmlspecialchars($sponsor->link), $html);
$html = str_replace('${categoriaToSelect}', CategoriaSponsor::toSmartSelect($sponsor), $html);
$html = str_replace('${sizeToSelect}', Sponsor::sizeToSelect($sponsor), $html);

$html = preg_replace('/\${+[A-Za-z0-9_]*\}+/', '', $html);
?>