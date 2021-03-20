<?php
session_start();
include_once('../../php/includes/defined.php');
if (isset($_SESSION['log']) && $_SESSION['log'] == 'usuarioValido') {
    $data = '<input type="hidden" name="g" value="' . $_SESSION['codigoUsuario'] . '" id="g" /><br />';
    $data .= '<input type="hidden" name="mensajeId" value="' . $_GET['id'] . '" id="id" />';
	$data .= '<input type="hidden" name="controller" value="' . $_GET['controller'] . '" id="controller" />';
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
        <script type="text/javascript" src="../../js/jquery.js"></script>
        <script type="text/javascript" src="../../js/jquery.colorbox.js"></script>
        <link type="text/css" href="../../css/formularios.css" rel="stylesheet" />
        <script type="text/javascript">
            window.onload = function () {
                $('#aceptar').click(function () {
                    $.ajax({
                        type:'POST',
                        url:'../../php/controllers/'+$('#controller').val()+'.controller.php',
                        data: 'mensajeId='+$('#id').val()+'&g='+$('#g').val(),
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
        <div class="formTemplate formBorrarMensaje">
            <div class="formEncabezado">
                <p><span class="iconsSprite iconAtencion">Atenci&oacute;n</span></p>
            </div>
            <div class="camposContainer">
                <p><b>Esta acci&oacute;n es irreversible.</b></p>
                <br/>
                <p>&iquest;Est&aacute; seguro que desea borrar este mensaje en forma definitiva?</p>
            </div>
            <div class="camposContainer">
                <p>
                	<a class="formBtnSprite btnCancelar" href="javascript:void(0)" id="cancelar"></a>
                    <a class="formBtnSprite btnBorrar" href="javascript:void(0)" id="aceptar"></a>
                </p>
                <?php echo ($data) ?>
            </div>
            <div class="clear"></div>
        </div>


    </body>
</html>