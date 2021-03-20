<?php

foreach ($propiedades as $propiedad) {
    $html .= $template;
    //if ($propiedad->estadoPublicacion == 'comprada') { 12-01-2015
    if ($propiedad->publicacion->estado->contenido == 'comprada') {
        if ($propiedad->publicacion->transaccion->isVencida()) {
            $html = '';
            continue;
        } else {
            $estado = 'vendido';
        }
    } else {
        $estado = '';
    }

    $botonCompartir = '<div class="compartir botonesArticulo"><a href="javascript:void(0)" class="btnCompartir" id="compartir' . $propiedad->id . '">COMPARTIR</a></div>';

    $html = str_replace('<!--{propiedadTitulo}-->', utf8_encode($propiedad->titulo), $html);
    $html = str_replace('<!--{propiedadImagen}-->', 'images/propiedades/' . $propiedad->imagenes[0]->ruta, $html);
    $html = str_replace('<!--{propiedadImagenGr}-->', $propiedad->imagenesToHTML('gr'), $html);
    //$html = str_replace('<!--{propiedadImagenCh}-->', $propiedad->imagenesToHTML(), $html);
    $html = str_replace('<!--{propiedadUrl}-->', 'articulo.php?id=' . $propiedad->id, $html);
    $html = str_replace('<!--{propiedadHectareas}-->', $propiedad->hectareas, $html);
    //$html = str_replace('<!--{publicacionTiempoRestante}-->', utf8_encode($propiedad->publicacion->tiempoRestante), $html);*/
    $html = str_replace('<!--{propiedadDireccion}-->', utf8_encode($propiedad->direccion->toString()), $html);
    //$html = str_replace('<!--{propiedadSugerencia}-->', utf8_encode($propiedad->precioPorTotal()), $html);
    $html = str_replace('<!--{propiedadDescripcion}-->', utf8_encode(Texto::cortar($propiedad->descripcion, 300)), $html);
    $html = str_replace('<!--{propiedadEstado}-->', $estado, $html);
    if (isset($_POST['fg']) && $_POST['fg'] != '') {
        $usuario = Doctrine::getTable('usuario')->findOneByCodigo($_POST['fg']);
        if ($propiedad->publicacion->inSeguidores($usuario)) {
            $botonSeguir = '<div class="botonesArticulo" style="float:right !importan; width:70px"><a href="javascript:void(0);" class="btnDejarDeSeguir" id="seguir<!--{propiedadId}-->">OLVIDAR</a></div>';
        } else {
            $botonSeguir = '<div class="botonesArticulo" style="float:right !importan; width:70px"><a href="javascript:void(0);" class="btnSeguir" id="seguir<!--{propiedadId}-->">SEGUIR</a></div>';
        }
        /*if ($usuario->id == Usuario::admin()->id) {
            $html = str_replace('<!--{botonCompartir}-->', '', $html);
        } else */ if ($usuario->id == $propiedad->publicacion->owner->id) {
            $html = str_replace('<!--{botonCompartir}-->', $botonCompartir, $html);
        } else {
            $html = str_replace('<!--{botonCompartir}-->', $botonCompartir . $botonSeguir, $html);
        }
    }
    $html = str_replace('<!--{botonCompartir}-->', $botonCompartir, $html);
    $html = str_replace('<!--{propiedadId}-->', $propiedad->id, $html);
};
?>