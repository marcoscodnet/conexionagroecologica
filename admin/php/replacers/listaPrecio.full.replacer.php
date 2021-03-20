<?php
$html = str_replace('${accion}', $accion, $html);
$html = str_replace('${icon}', $icon, $html);
$html = str_replace('${id}', $listaPrecio->id, $html);
$html = str_replace('${title}', $listaPrecio->material, $html);
$html = str_replace('${material}', $listaPrecio->material, $html);
$html = str_replace('${preciokg}', $listaPrecio->precio_kg, $html);
$html = str_replace('${variacionprecio}', $listaPrecio->variacion_precio, $html);
$html = str_replace('${variacionporcentaje}', $listaPrecio->variacion_porcentaje, $html);
$selectAcopiados = ($listaPrecio->tipo == 'Acopiador')?'selected="selected"':''; 
$selectReciclador = ($listaPrecio->tipo == 'Reciclador')?'selected="selected"':'';
$html = str_replace('${selectAcopiados}', $selectAcopiados, $html);
$html = str_replace('${selectReciclador}', $selectReciclador, $html);





$html = preg_replace('/\${*[A-Za-z0-9_]*\}*/', '', $html);
?>