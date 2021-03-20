<?php
session_start();
include_once('../../php/includes/defined.php');
if (isset($_SESSION['log']) && $_SESSION['log'] == 'usuarioValido') {
    $inputs = '<input type="hidden" name="n" value="' . $_SESSION['codigoUsuario'] . '" /><br />';
} else {
	echo ('error');
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link type="text/css" href="../../css/reset.css" rel="stylesheet" />
        <link type="text/css" href="../../css/formularios.css" rel="stylesheet" />
        <link type="text/css" href="../../css/mensajes.colorbox.css" rel="stylesheet" />
        <!--[if lte IE 7]><style type="text/css">@import url("../css/ie.css");</style><![endif]-->
        <!--[if IE 6]><style type="text/css">@import url("css/ieold.css");</style><![endif]-->
        <!--[if (gte IE 6)&(lte IE 8)]>
        <noscript><link rel="stylesheet" href="[../css/style.css]" /></noscript>
        <![endif]-->
        <script type="text/javascript" src="../../js/jquery.js"></script>
        <script type="text/javascript" src="../../js/validadores.js"></script>
        <script type="text/javascript">
            window.onload = function () {
				$('#passDistinto, #campoObligatorio').hide();
				$('input').focus(function () {
					$('#passDistinto, #campoObligatorio').hide();
				})
                var div = document.getElementsByTagName('div')[0];
                var loader = document.createElement('div');
                loader.className = 'loader';
				var pass1 = document.getElementById('passNueva');
				var pass2 = document.getElementById('passNueva2');
                document.forms[0].onsubmit = function () {
                    if (pass1.value == pass2.value) {
						if (passActual.value && pass1.value && pass2.value) {
							div.getElementsByTagName('p')[0].innerHTML = 'CARGANDO';
							this.style.display = 'none';
							div.appendChild(loader);
                        	return true;
						} else {
							$('#campoObligatorio').show();
							return false;
						}
                    } else {
						$('#passDistinto').show();
                        return false;
                    }
                }
            }
        </script>
    </head>
    <body>
        <div class="formTemplate formCompartir">
            <div class="formEncabezado">
                <p>Cambiar contrase&ntilde;a</p>
            </div>
            <form id="form_compartir" name="form_contacto" method="post" action="<?php echo(RUTA . 'php/controllers/cambiarPass.controller.php') ?>">
                <div class="camposContainer">
                    <label for="passActual">Ingrese su contrase&ntilde;a actual:</label>
                    <input type="password" value="" name="passActual" maxlength="42" id="passActual" /><br />
                    <label for="passNueva">Ingrese su nueva contrase&ntilde;a:</label>
                    <input type="password" value="" name="passNueva" maxlength="42" id="passNueva" /><br />
                    <label for="passNueva2">Vuelva a ingresar la nueva contrase&ntilde;a:</label>
                    <input type="password" value="" name="passNueva2" maxlength="42" id="passNueva2" /><br />
                    <?php echo($inputs); ?>
                     <p id="passDistinto" class="mensaje">Las contrase&ntilde;as no coinciden</p>
                     <p id="campoObligatorio" class="mensaje">Los tres campos son obligatorios</p>
                </div>
                <div class="clear"></div>
               
                <div class="camposContainer">
                    <input class="formBtnSprite btnEnviar" type="submit" id="aceptar" name="login" value=" " />
                </div>
                <div class="clear"></div>
            </form>
            <div class="clear"></div>
        </div>
    </body>
</html>