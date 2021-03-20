<?php
$html = str_replace('${accion}', $accion, $html);
$html = str_replace('${icon}', $icon, $html);
$html = str_replace('${id}', $reciclador->id, $html);
$html = str_replace('${imgprefix}', time() . '' . rand(1, 99999), $html);
$html = str_replace('${title}', $reciclador->nombre, $html);
$html = str_replace('${nombre}', $reciclador->nombre, $html);
$html = str_replace('${telefono}', $reciclador->tel, $html);
$html = str_replace('${email}', $reciclador->email, $html);
$html = str_replace('${web}', $reciclador->web, $html);
$html = str_replace('${tipoToSelect}', utf8_encode(TipoReciclador::toSmartSelect($reciclador)), $html);
$html = str_replace('${localidadToSelect}', utf8_encode(Localidad::toSmartSelect($reciclador)), $html);
$html = str_replace('${provinciaToSelect}', utf8_encode(Provincia::toSmartSelect($reciclador->localidad)), $html);
$html = str_replace('${subcategorias}', $reciclador->subcategoriasToString('|'), $html);
$html = str_replace('${direccion}', $reciclador->direccion, $html);
$html = str_replace('${latitud}', $reciclador->latitud, $html);
$html = str_replace('${longitud}', $reciclador->longitud, $html);
$html = preg_replace('/\${*[A-Za-z0-9_]*\}*/', '', $html);
?>