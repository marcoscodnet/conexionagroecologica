<?php

foreach ($subcategorias as $subcategoria) {
    $html .= $template;
   

	$botonBorrarAdmin = '<div class="botonesArticulo" style="float: left !important; margin-top:5px"><a href="javascript:void(0)" onClick="borrar('.$subcategoria->id.',\'RelUsuarioInteresesSubcategoria\')" class="btnBorrarAdmin">BORRAR</a></div>';
    $html = str_replace('<!--{categoria}-->', utf8_encode($subcategoria->categoria->contenido), $html);
    $html = str_replace('<!--{subcategoria}-->', utf8_encode($subcategoria->contenido), $html);
    
    $html = str_replace('<!--{borrarSubcategoria}-->', $botonBorrarAdmin, $html);
};

?>