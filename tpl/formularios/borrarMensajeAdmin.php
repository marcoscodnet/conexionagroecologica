<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link type="text/css" href="../../css/reset.css" rel="stylesheet" />
        <link type="text/css" href="../../css/mensajes.colorbox.css" rel="stylesheet" />
        <link type="text/css" href="../../css/formularios.css" rel="stylesheet" />
        <script type="text/javascript" src="../../js/jquery-1.6.1.min.js"></script>
        <script type="text/javascript">
		$(document).ready(function () {
			$('form').submit(function () {						  
				$('.formEncabezado p').html('POR FAVOR ESPERE');
				$('.camposContainer:eq(0)').html('');
				$('.camposContainer form').hide();
				$('.camposContainer:eq(0)').attr('class', 'loader');
				return true;
			})
		})
		window.parent.bindColorbox('reload');
		</script>
    </head>

    <body>
        <div class="formTemplate formBorrarMensajeAdmin">
            <div class="formEncabezado">
                <p>Borrar Mensaje</p>
            </div>
            <div class="camposContainer">
                <p>Exprese los motivos por los cuales va a dar de baja esta mensaje.</p>
            </div>
            <div class="camposContainer">
                <form action="../../php/controllers/borrarMensajeAdmin.controller.php" id="borrarForm" method="post">
                    <textarea name="motivos" style="width:300px; height:150px"></textarea>
                    <input type="submit" name="enviador" value="" class="formBtnSprite btnBorrar" style="float:right; margin-top:10px; margin-right:20px" />
                    <input type="hidden" name="id" value="<?php echo($_GET['id']); ?>" />
                    <input type="hidden" name="rm" value="<?php echo($_SESSION['codigoUsuario']); ?>" />
                </form>
            </div>
            <div class="clear"></div>
        </div>

    </body>
</html>