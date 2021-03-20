<?php
$html = str_replace('${accion}', $accion, $html);
$html = str_replace('${icon}', $icon, $html);
$html = str_replace('${id}', $proveedor->id, $html);
$html = str_replace('${imgprefix}', time() . '' . rand(1, 99999), $html);
$html = str_replace('${title}', $proveedor->nombre, $html);
$html = str_replace('${nombre}', $proveedor->nombre, $html);
$html = str_replace('${telefono}', $proveedor->tel, $html);
$html = str_replace('${email}', $proveedor->email, $html);
$html = str_replace('${web}', $proveedor->web, $html);
$html = str_replace('${descripcion}', $proveedor->descripcion, $html);
$html = str_replace('${subcategoriaToSelect}', utf8_encode(SubcategoriaProveedor::toSmartSelect($proveedor)), $html);
$html = str_replace('${categoriaToSelect}', utf8_encode(CategoriaProveedor::toSmartSelect($proveedor->subcategoria)), $html);
$html = str_replace('${localidadToSelect}', utf8_encode(Localidad::toSmartSelect($proveedor)), $html);
$html = str_replace('${provinciaToSelect}', utf8_encode(Provincia::toSmartSelect($proveedor->localidad)), $html);
$html = preg_replace('/\${*[A-Za-z0-9_]*\}*/', '', $html);
?>