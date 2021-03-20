<?php
session_start();
include_once('../../php/includes/defined.php');
if (isset($_SESSION['log']) && $_SESSION['log'] == 'usuarioValido') {
    $data = '<input type="hidden" name="g" value="' . $_SESSION['codigoUsuario'] . '" id="g" /><br />';
    $data .= '<input type="hidden" name="id" value="' . $_GET['id'] . '" id="id" />';
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
                        url:'../../php/controllers/borrar.controller.php',
                        data: 'propiedadId='+$('#id').val()+'&g='+$('#g').val(),
                        beforeSend:function () {
                            $('.encabezadoMensaje p').html('POR FAVOR ESPERE');
                            $('.contenidoMensaje').html('');
                            $('.contenidoMensaje').attr('class', 'loader');
                        },
                        success:function (ok, textStatus) {
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
        <div class="formTemplate formBorrar">
            <div class="formEncabezado">
                <p><span class="iconsSprite iconAtencion">Atenci&oacute;n</span></p>
            </div>
            <div class="camposContainer">
                <p><b>&iquest;Est&aacute; seguro que desea borrar esta publicaci&oacute;n?</b></p>
                <br/>
                <p>Una vez eliminada, tendr&aacute; que repetir el proceso de venta para volver a publicar.</p>
            </div>
            <div class="camposContainer">
                <p><a class="formBtnSprite btnCancelar" href="javascript:void(0)" id="cancelar" style="text-indent: -9999px !important;">Cancelar</a>
                    <a class="formBtnSprite btnBorrar" href="javascript:void(0)" id="aceptar" style="text-indent: -9999px !important;">Borrar</a></p>
                <!--                       <a class="formBtnSprite btnBorrar" href="javascript:void(0)" id="aceptar">Borrar</a></p>-->
                <?php echo ($data) ?>
            </div>
            <div class="clear"></div>
        </div>
    </body>
</html>