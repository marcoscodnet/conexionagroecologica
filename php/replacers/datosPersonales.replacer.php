<?php
$html = str_replace('<!--{usuarioNombre}-->', utf8_encode($usuario->nombre), $html);
$html = str_replace('<!--{usuarioApellido}-->', utf8_encode($usuario->apellido), $html);
$html = str_replace('<!--{usuarioEmail}-->', $usuario->email, $html);
$html = str_replace('<!--{telefonoArea}-->', $usuario->telefono->area, $html);
$html = str_replace('<!--{telfonoNumero}-->', $usuario->telefono->numero, $html);
$html = str_replace('<!--{celularArea}-->', $usuario->celular->area, $html);
$html = str_replace('<!--{celularNumero}-->', $usuario->celular->numero, $html);
$html = str_replace('<!--{usuarioCompany}-->', utf8_encode($usuario->company), $html);
$html = str_replace('<!--{usuarioCuit}-->', $usuario->cuit, $html);
$html = str_replace('<!--{usuarioRazon}-->', utf8_encode($usuario->razon), $html);
$html = str_replace('<!--{codigoUsuario}-->', $usuario->codigo, $html);

$checked = ($usuario->propietario)?'<input class="propietario" type="checkbox" name="propietario" id="propietario" checked />':'<input class="propietario" type="checkbox" name="propietario" id="propietario"/>';
$html = str_replace('<!--{propietarioCheck}-->', $checked, $html);
$checked = ($usuario->productor)?'<input class="propietario" type="checkbox" name="productor" id="productor" checked />':'<input class="propietario" type="checkbox" name="productor" id="productor"/>';
$html = str_replace('<!--{productorCheck}-->', $checked, $html);
$checked = ($usuario->datos_disponibles)?'<input class="propietario" type="checkbox" name="datos_disponibles" id="datos_disponibles" checked />':'<input class="propietario" type="checkbox" name="datos_disponibles" id="datos_disponibles"/>';
$html = str_replace('<!--{datosDisponiblesCheck}-->', $checked, $html);


?>