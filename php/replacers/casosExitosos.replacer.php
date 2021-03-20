<?php
$html = str_replace('${categoriaToSelect}', utf8_decode(Categoria::toSmartSelect()), $html);
$html = str_replace('${ubicacionToSelect}', Ubicacion::toSmartSelect(), $html);

//casos
$casosHtml = '';
if (count($casos)) {
    foreach ($casos as $caso) {
        $casosHtml .= $casoItem;
        $casosHtml = str_replace('${id}', $caso['id'], $casosHtml);
        $casosHtml = str_replace('${titulo}', (utf8_decode($caso['titulo'])), $casosHtml);
        $casosHtml = str_replace('${descripcion}', (Texto::cortar(utf8_decode($caso['descripcion']), 233, '...')), $casosHtml);
        $casosHtml = str_replace('${imagen}', RUTA.'content/casos-exitosos/thumb/'.$caso['imagen'], $casosHtml);
        $casosHtml = str_replace('${href}', RUTA.'caso-exitoso/'.$caso['slug'], $casosHtml);
        $casosHtml = str_replace('${categoria}', htmlentities(utf8_decode($caso['categoria'])), $casosHtml);
        $casosHtml = str_replace('${subcategoria}', htmlentities(utf8_decode($caso['subcategoria'])), $casosHtml);
        $casosHtml = str_replace('${ubicacion}', htmlentities(utf8_decode($caso['ubicacion'])), $casosHtml);
    }
} else {
    $casosHtml = '<p style="color:#000; margin-top: 30px">La b&uacute;squeda no arraj&oacute; ning&uacute;n resultado.</p>';
}
$html = str_replace('${casosExitosos}', $casosHtml, $html);
$html = preg_replace('/\${*[A-Za-z0-9_]*\}*/', '', $html);
?>
