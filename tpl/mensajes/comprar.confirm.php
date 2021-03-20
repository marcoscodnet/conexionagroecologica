<?php
session_start();
include_once('../../php/includes/defined.php');
if (isset($_SESSION['log']) && $_SESSION['log'] == 'usuarioValido') {
    $data = '<input type="hidden" name="g" value="' . $_SESSION['codigoUsuario'] . '" id="g" /><br />';
    $data .= '<input type="hidden" name="id" value="' . $_GET['productoId'] . '" id="id" />';
} else {
    exit();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link type="text/css" href="../../css/reset.css" rel="stylesheet" />
        <link type="text/css" href="../../css/mensajes.colorbox.css" rel="stylesheet" />
        <link type="text/css" href="../../css/formularios.css" rel="stylesheet" />
        <script type="text/javascript" src="../../js/jquery.js"></script>
        <script type="text/javascript" src="../../js/jquery.colorbox.js"></script>
        <script type="text/javascript">
            window.onload = function () {
                $('#aceptar').click(function () {
                    $.ajax({
                        type:'POST',
                        url:'../../php/controllers/comprar.controller.php',
                        data: 'productoId='+$('#id').val()+'&codigoUsuario='+$('#g').val(),
                        beforeSend:function () {
                            $('.encabezadoMensaje p').html('POR FAVOR ESPERE');
                            $('.contenidoMensaje').html('');
                            $('.contenidoMensaje').attr('class', 'loader');
                        },
                        success:function (ok) {
                            window.location = ok;
                        },
                        errro:function () {
                            window.location = 'server.error.php';
                        }
                    })
                })
                $('#cancelar').click(function () {
                    window.parent.cerrarColorbox();
                })
            }
        </script>
    </head>

    <body>        
        <div class="formTemplate formComprar">
            <div class="formEncabezado">
                <p><span class="iconsSprite iconAtencion">Atenci&oacute;n</span></p>
            </div>
            <div class="camposContainer">
                <p><b>Contactar al generador de este subproducto</b></p>
                <br/>
                <p>&iquest;Est&aacute; seguro que desea contactar al generador de este subproducto?</p>
            </div>
            <div class="camposContainer">
                <p><a class="btnCancelar" href="javascript:void(0)" id="cancelar">Cancelar</a>
                   <a class="formBtnSprite btnAceptar" href="javascript:void(0)" id="aceptar"></a></p>
                <?php echo ($data) ?>
            </div>
            <div class="clear"></div>
        </div>


    </body>
</html>