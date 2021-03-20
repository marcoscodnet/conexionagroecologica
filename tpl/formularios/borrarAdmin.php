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
				$('.camposContainer').eq(0).html('');
				$('.camposContainer form').hide();
				$('.camposContainer').eq(0).attr('class', 'loader');
				return true;
			})
		})
		window.parent.bindColorbox('publicaciones-admin.php');
		</script>
    </head>

    <body>
        <div class="formTemplate formBorrarAdmin">
            <div class="formEncabezado">
                <p>Borrar Publicaci&oacute;n</p>
            </div>
            <div class="camposContainer">
                <p><b>Mensaje para el usuario</b></p><br/>
                <p>Exprese los motivos por los cuales va a dar de baja esta publicaci&oacute;n.</p>
            </div>
            <div class="camposContainer">
                <form action="../../php/controllers/borrarAdmin.controller.php" method="post">
                    <textarea name="contenido" style="width:300px; height:100px"></textarea>
                    <input type="submit" name="enviador" value="" class="submit formBtnSprite btnBorrar" style="float:right; margin-top:10px" />
                    <input type="hidden" name="id" value="<?php echo($_GET['id']); ?>" />
                    <input type="hidden" name="hd" value="<?php echo($_SESSION['codigoUsuario']); ?>" />
                </form>
            </div>
            <div class="clear"></div>
        </div>


    </body>
</html>