<?php
$html = str_replace('${categoriaToSelect}', utf8_decode(CategoriaProveedor::toSmartSelect()), $html);
$html = str_replace('${provinciaToSelect}', Provincia::toSmartSelect(), $html);

//casos
$proveedoresHtml = '';

if (count($proveedores)) {
    foreach ($proveedores as $proveedor) {
    	$descripcion='';
        $proveedoresHtml .= '<p class="tituloNaranjaFaq" style="margin-top: 30px;">'.(utf8_decode($proveedor['nombre'])).'</p>';
        if ($proveedor['tel']) $tel = $proveedor['tel'];
        $proveedoresHtml .= '<div style="width: 290px; float: left"><p><span style="color: #666">Tel&eacute;fono: </span>'.$tel.'</p></div>';
        if ($proveedor['email']) $email = $proveedor['email'];
        $proveedoresHtml .= '<div style="width: 290px; float: left"><p><span style="color: #666">Email: </span>'.$email.'</p></div>';
        if ($proveedor['web']) $web = $proveedor['web'];
        $proveedoresHtml .= '<div style="width: 290px; float: left"><p><span style="color: #666">Web: </span><a href="'.$web.'" target="_blank">'.str_replace('http://', '', $proveedor['web']).'</a></p></div>';
        if ($proveedor['provincia']) $pcia = htmlentities(utf8_decode($proveedor['provincia']));
        $proveedoresHtml .= '<div style="width: 290px; float: left"><p><span style="color: #666">Provincia: </span>'.$pcia.'</p></div>';
        if ($proveedor['localidad']) $localidad = htmlentities(utf8_decode($proveedor['localidad']));
        $proveedoresHtml .= '<div style="width: 290px; float: left"><p><span style="color: #666">Localidad: </span>'.$localidad.'</p></div>';
        if ($proveedor['descripcion']) $descripcion = htmlentities(utf8_decode($proveedor['descripcion']));
        $proveedoresHtml .= '<div style="width: 290px; float: left"><p><span style="color: #666">Descripci&oacute;n: </span>'.$descripcion.'</p></div>';
        $proveedoresHtml .= '<p class="clear">&nbsp;</p><div class="lineaPunteada" style="margin-top: 0"></div>';
    }
} else {
    $proveedoresHtml = '<p style="color:#000; margin-top: 30px">La b&uacute;squeda no arraj&oacute; ning&uacute;n resultado.</p>';
}
$html = str_replace('${proveedores}', $proveedoresHtml, $html);
$html = preg_replace('/\${*[A-Za-z0-9_]*\}*/', '', $html);
?>
