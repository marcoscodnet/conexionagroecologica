<?php
if (isset($_GET['id'])) { //si se esta editando
	$propiedad = Doctrine::getTable('propiedad')->find($_GET['id']);
	
	$renovar = ($propiedad->publicacion->finalizacion == '01-01-2050')?'checked="checked"':'';
	
	$html = str_replace('<!--{clase}-->', 'id="altaProducto"', $html);
	
	$html = str_replace('<!--{propiedadTitulo}-->', $propiedad->titulo, $html);
	$html = str_replace('<!--{propiedadImagen}-->', 'images/propiedades/'.$propiedad->imagenes[0]->ruta.'?i='.time(), $html);
	$html = str_replace('<!--{propiedadImagenGr}-->', $propiedad->imagenesToHTML('gr'), $html);
	$html = str_replace('<!--{propiedadImagenCh}-->', $propiedad->imagenesToHTML(), $html);
	$html = str_replace('<!--{propiedadUrl}-->', 'articulo.php?id='.$propiedad->id, $html);
	$html = str_replace('<!--{propiedadHectareas}-->', ($propiedad->hectareas), $html);
	
	$html = str_replace('<!--{propiedadLatitud}-->', ($propiedad->latitud), $html);
	$html = str_replace('<!--{propiedadLongitud}-->', ($propiedad->longitud), $html);
	
	/*$html = str_replace('<!--{propiedadCalle}-->', htmlentities($propiedad->direccion->calle), $html);
	$html = str_replace('<!--{propiedadNro}-->', htmlentities($propiedad->direccion->numero), $html);*/
	$html = str_replace('<!--{propiedadDescripcion}-->', htmlentities($propiedad->descripcion), $html);
	
	$html = str_replace('<!--{clase}-->', 'class="btnEditar"', $html);
	
	/*selects*/
	$html = str_replace('<!--{usoSueloToSelect}-->', UsoSuelo::toSelect($propiedad), $html);
	$html = str_replace('<!--{propiedadOtroUsoSuelo}-->', $propiedad->otro_uso_suelo, $html);
	$html = str_replace('<!--{tipoUsoSueloToSelect}-->', TipoUsoSuelo::toSelect($propiedad), $html);
	$html = str_replace('<!--{propiedadOtroTipoUsoSuelo}-->', $propiedad->otro_tipo_uso_suelo, $html);
	$html = str_replace('<!--{tipoContratoToSelect}-->', TipoContrato::toSelect($propiedad), $html);
	$html = str_replace('<!--{posibleUsoSueloToSelect}-->', PosibleUsoSuelo::toSelect($propiedad), $html);
	$html = str_replace('<!--{accesoAguaToSelect}-->', AccesoAgua::toSelect($propiedad), $html);
	
	$html = str_replace('<!--{provinciaToSelect}-->', $provincia->toSelect($propiedad), $html);
	$html = str_replace('<!--{localidadesToSelect}-->', $provincia->localidadesToSelect($propiedad), $html);
	$checkedCasaDisponible =($propiedad->casa_disponible)?' checked ':'';
	$checkCasaDisponible = '<input type="checkbox" id="casa_disponible" name="casa_disponible" '.$checkedCasaDisponible.'/>';
	$html = str_replace('<!--{propiedadCasaDisponible}-->', $checkCasaDisponible, $html);
	$checkedViveTerreno =($propiedad->vive_terreno)?' checked ':'';
	$checkViveTerreno = '<input type="checkbox" id="vive_terreno" name="vive_terreno" '.$checkedViveTerreno.'/>';
	$html = str_replace('<!--{propiedadViveTerreno}-->', $checkViveTerreno, $html);
	$html = str_replace('<!--{propiedadId}-->', $propiedad->id, $html);
	
	
} else { //si se esta cargando
	$html = str_replace('<!--{clase}-->', 'id="altaProducto"', $html);
	/*selects*/
	$html = str_replace('<!--{usoSueloToSelect}-->', UsoSuelo::toSelect(), $html);
	$html = str_replace('<!--{tipoUsoSueloToSelect}-->', TipoUsoSuelo::toSelect(), $html);
	$html = str_replace('<!--{tipoContratoToSelect}-->', TipoContrato::toSelect(), $html);
	$html = str_replace('<!--{posibleUsoSueloToSelect}-->', PosibleUsoSuelo::toSelect(), $html);
	$html = str_replace('<!--{accesoAguaToSelect}-->', AccesoAgua::toSelect(), $html);
	
	$html = str_replace('<!--{provinciaToSelect}-->', $provincia->toSelect(), $html);
	$html = str_replace('<!--{localidadesToSelect}-->', $provincia->localidadesToSelect(), $html);
	
	$checkCasaDisponible = '<input type="checkbox" id="casa_disponible" name="casa_disponible"/>';
	$html = str_replace('<!--{propiedadCasaDisponible}-->', $checkCasaDisponible, $html);
	
	$checkViveTerreno = '<input type="checkbox" id="vive_terreno" name="vive_terreno"/>';
	$html = str_replace('<!--{propiedadViveTerreno}-->', $checkViveTerreno, $html);
	$html = str_replace('<!--{propiedadId}-->', '0', $html);
}
$html = str_replace('<!--{codigoUsuario}-->', $_SESSION['codigoUsuario'], $html);
$html = preg_replace('/<!-+\{*[A-Za-z0-9]*\}*-+>/', '', $html);
?>