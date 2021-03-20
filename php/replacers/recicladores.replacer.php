<?php
$html = str_replace('${categoriaToSelect}', utf8_decode(Categoria::toSmartSelect()), $html);
$html = str_replace('${provinciaToSelect}', Provincia::toSmartSelect(), $html);
$html = str_replace('${tipoToSelect}', TipoReciclador::toSmartSelect(), $html);

//casos
$recicladoresHtml = '';
if (count($recicladores)) {
    foreach ($recicladores as $reciclador) {
        $recicladoresHtml .= '<p class="tituloNaranjaFaq" style="margin-top: 30px;">'.htmlentities(utf8_decode($reciclador['nombre'])).'</p>';
        $recicladoresHtml .= '<p><span style="color: #666">Categor&iacute;as</span></p>';
        $recicladoresHtml .= '<p style="margin-left: 15px">'.utf8_decode($reciclador->categoriasToHtml()).'</p>';
        if ($reciclador['tel']) $recicladoresHtml .= '<div style="width: 290px; float: left"><p><span style="color: #666">Tel&eacute;fono: </span>'.$reciclador['tel'].'</p></div>';
        if ($reciclador['email']) $recicladoresHtml .= '<div style="width: 290px; float: left"><p><span style="color: #666">Email: </span>'.$reciclador['email'].'</p></div>';
        if ($reciclador['web']) $recicladoresHtml .= '<div style="width: 290px; float: left"><p><span style="color: #666">Web: </span><a href="'.$reciclador['web'].'" target="_blank">'.str_replace('http://', '', $reciclador['web']).'</a></p></div>';
        if ($reciclador['provincia']) $recicladoresHtml .= '<div style="width: 290px; float: left"><p><span style="color: #666">Provincia: </span>'.htmlentities(utf8_decode($reciclador['provincia'])).'</p></div>';
        if ($reciclador['localidad']) $recicladoresHtml .= '<div style="width: 290px; float: left"><p><span style="color: #666">Localidad: </span>'.htmlentities(utf8_decode($reciclador['localidad'])).'</p></div>';
        $recicladoresHtml .= '<p class="clear">&nbsp;</p><div class="lineaPunteada" style="margin-top: 0"></div>';
    }
} else {
    $recicladoresHtml = '<p style="color:#000; margin-top: 30px">La b&uacute;squeda no arraj&oacute; ning&uacute;n resultado.</p>';
}
$html = str_replace('${recicladores}', $recicladoresHtml, $html);
$html = preg_replace('/\${*[A-Za-z0-9_]*\}*/', '', $html);
?>
