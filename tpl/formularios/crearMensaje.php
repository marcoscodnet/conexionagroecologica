<?php
session_start();
include_once('../../php/includes/defined.php');
$inputs = '
	<input type="hidden" name="n" value="' . $_SESSION['codigoUsuario'] . '" />
        <input type="hidden" name="a" value="' . $_GET['a'] . '" />
        <input type="hidden" name="b" value="' . $_GET['b'] . '" />
        <input type="hidden" name="c" value="' . $_GET['c'] . '" />
        <input type="hidden" name="d" value="' . $_GET['d'] . '" />
        <input type="hidden" name="e" value="' . $_GET['e'] . '" />
        <input type="hidden" name="f" value="' . $_GET['f'] . '" />
';
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link type="text/css" href="../../css/reset.css" rel="stylesheet" />
        <link type="text/css" href="../../css/mensajes.colorbox.css" rel="stylesheet" />
        <link type="text/css" href="../../css/formularios.css" rel="stylesheet" />
        <!--[if lte IE 7]><style type="text/css">@import url("../css/ie.css");</style><![endif]-->
        <!--[if IE 6]><style type="text/css">@import url("css/ieold.css");</style><![endif]-->
        <!--[if (gte IE 6)&(lte IE 8)]>
        <noscript><link rel="stylesheet" href="[../css/style.css]" /></noscript>
        <![endif]-->
        <script type="text/javascript">
            window.onload = function () {
                var div = document.getElementsByTagName('div')[0];
                var loader = document.createElement('div');
                loader.className = 'loader';
                document.forms[0].onsubmit = function () {
                    div.getElementsByTagName('p')[0].innerHTML = 'CARGANDO';
                    this.style.display = 'none';
                    div.appendChild(loader);
                    return true;
                }
            }
        </script>
    </head>
    <body>
        <div class="formTemplate formResponder">
            <div class="formEncabezado">
                <p>Mensaje</p>
            </div>
            <form id="form_contacto" name="form_contacto" method="post" action="<?php echo(RUTA . 'php/controllers/crearMensaje.controller.php') ?>">
                <div class="camposContainer">
                    <p style="float:none">Asunto:</p>
                    <input type="text" name="asunto" />
                    <p style="float:none">Mensaje:</p>
                    <textarea  style="float:none; width:320px; height:160px; margin-top:10px" name="contenido" id="pregunta" cols="" rows=""></textarea>
                    <?php echo($inputs); ?>
                </div>
                <div class="camposContainer">
                    <p><input class="btn naranja" type="submit" value="Enviar" /></p>
                </div>
                <div class="clear"></div>
            </form>
            <div class="clear"></div>
        </div>
    </body>
</html>