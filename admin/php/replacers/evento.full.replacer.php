<?php
$html = str_replace('${accion}', $accion, $html);
$html = str_replace('${imgprefix}', time() . '' . rand(1, 99999), $html);
$html = str_replace('${icon}', $icon, $html);
$html = str_replace('${id}', $evento->id, $html);
$html = str_replace('${title}', $evento->titulo, $html);
$html = str_replace('${titulo}', $evento->titulo, $html);
$html = str_replace('${dia}', $evento->date->dia, $html); 
$html = str_replace('${hora}', $evento->date->hora, $html);
$html = str_replace('${categoriaToSelect}', utf8_encode(CategoriaEvento::toSmartSelect($evento)), $html);
$html = str_replace('${organizador}', $evento->organizador, $html);
$html = str_replace('${telefono}', $evento->telefono, $html);
$html = str_replace('${direccion}', $evento->direccion, $html);
$html = str_replace('${provinciaToSelect}', utf8_encode(Provincia::toSmartSelect($evento)), $html);
$html = str_replace('${email}', $evento->email, $html);
$html = str_replace('${web}', $evento->web, $html);
$html = str_replace('${facebook}', $evento->fb, $html);
$html = str_replace('${twitter}', $evento->tw, $html);

$html = preg_replace('/\${*[A-Za-z0-9]*\}*/', '', $html);
?>