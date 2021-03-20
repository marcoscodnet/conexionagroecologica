<?php
$html = str_replace('${categoriaToSelect}', utf8_decode(CategoriaEvento::toSmartSelect()), $html);
$html = str_replace('${provinciaToSelect}', Provincia::toSmartSelect(), $html);

//casos
$eventosHtml = '';
if (count($eventos)) {
    foreach ($eventos as $evento) {
        $eventosHtml .= '<p class="tituloNaranjaFaq" style="margin-top: 30px;">'.$evento['titulo'].'</p>';
        if ($evento['organizador']) $eventosHtml .= '<div style="width: 290px; float: left"><p><span style="color: #666">Organizador: </span>'.$evento['organizador'].'</p></div>';
        if ($evento['fecha']) $eventosHtml .= '<div style="width: 290px; float: left"><p><span style="color: #666">Fecha: </span>'.$evento['fecha'].'</p></div>';
        if ($evento['direccion']) $eventosHtml .= '<div style="width: 290px; float: left"><p><span style="color: #666">Direcci&oacute;n: </span>'.$evento['direccion'].'</p></div>';
        if ($evento['provincia']) $eventosHtml .= '<div style="width: 290px; float: left"><p><span style="color: #666">Provincia: </span>'.$evento['provincia'].'</p></div>';
        if ($evento['web']) $eventosHtml .= '<div style="width: 290px; float: left"><p><span style="color: #666">Web: </span><a href="'.$evento['web'].'" target="_blank">'.str_replace('http://', '', $evento['web']).'</a></p></div>';
        if ($evento['telefono']) $eventosHtml .= '<div style="width: 290px; float: left"><p><span style="color: #666">Web: </span>'.$evento['telefono'].'</p></div>';
        if ($evento['email']) $eventosHtml .= '<div style="width: 290px; float: left"><p><span style="color: #666">Email: </span>'.$evento['email'].'</p></div>';
        if ($evento['fb']) $eventosHtml .= '<div style="width: 290px; float: left"><p><span style="color: #666">Facebook: </span><a href="'.$evento['fb'].'" target="_blank">'.str_replace('http://', '', $evento['fb']).'</a></p></div>';
        if ($evento['tw']) $eventosHtml .= '<div style="width: 290px; float: left"><p><span style="color: #666">Twitter: </span><a href="'.$evento['tw'].'" target="_blank">'.str_replace('http://', '', $evento['tw']).'</a></p></div>';
        $eventosHtml .= '<p class="clear">&nbsp;</p><div class="lineaPunteada" style="margin-top: 0"></div>';
    }
} else {
    $eventosHtml = '<p style="color:#000; margin-top: 30px">La b&uacute;squeda no arraj&oacute; ning&uacute;n resultado.</p>';
}

$html = str_replace('${eventos}', $eventosHtml, $html);
$html = preg_replace('/\${*[A-Za-z0-9_]*\}*/', '', $html);
?>
