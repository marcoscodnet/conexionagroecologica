<?php
$provinciaAnt = '';
foreach ($localidades as $localidad) {
	$botonBorrarAdmin = '<div class="botonesArticulo" style="float: left !important; margin-top:5px"><a href="javascript:void(0)" onClick="borrar('.$localidad->provincia->id.',\'RelUsuarioInteresesLocalidad\')" class="btnBorrarAdmin">BORRAR</a></div>';
    $html .= $template;
	
   if ($provinciaAnt!=$localidad->provincia->contenido) {
	   //echo $provinciaAnt.' - '.$localidad->provincia->contenido.'<br>';
	   $caja='<div class="cajaSubcategorias"> 

    <div style="color:#000"><p>'.utf8_encode($localidad->provincia->contenido).' </p></div> 
    
    <div class="botonesCajaPerfil">
    	'.$botonBorrarAdmin.'
    </div> 
    <div class="clear"></div>'; 
	   /*$html = str_replace('<!--{provincia}-->', utf8_encode($localidad->provincia->contenido), $html);
		$html = str_replace('<!--{localidad}-->', utf8_encode($localidad->contenido), $html);
   		$html = str_replace('<!--{borrarLocalidad}-->', $botonBorrarAdmin, $html);*/
		$html = str_replace('<!--{contenido}-->', $caja, $html);
   		$provinciaAnt = $localidad->provincia->contenido;
   }
   else $html = str_replace('<!--{contenido}-->', '', $html);
	

    
    
    //$html = str_replace('<!--{borrarLocalidad}-->', $botonBorrarAdmin, $html);
    
};

?>