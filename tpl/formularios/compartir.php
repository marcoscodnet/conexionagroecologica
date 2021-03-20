<?php
session_start();
include_once('../../php/includes/defined.php');
if (isset($_SESSION['log']) && $_SESSION['log'] == 'usuarioValido') {
    $campos = '<input type="hidden" name="n" value="' . $_SESSION['codigoUsuario'] . '" /><br />';
} else {
    $campos = '<label for="nombre">Tu nombre</label>';
    $campos .= '<input type="text" value="" name="nombre" maxlength="42" id="nombre" />';
    $campos .= '<label for="destinador">Tu e-mail</label>';
    $campos .= '<input type="text" value="" name="destinador" maxlength="42" id="destinador" />';
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
                vaciar('Ingrese un e-mail', '#email');
                var div = document.getElementsByTagName('div')[0];
                var loader = document.createElement('div');
                loader.className = 'loader';
                document.forms[0].onsubmit = function () {
                    if (validarEmail('email')) {
                        div.getElementsByTagName('p')[0].innerHTML = 'CARGANDO';
                        this.style.display = 'none';
                        div.appendChild(loader);
                        return true;
                    } else {
                        return false;
                    }
                }
            }
            function vaciar (texto, selector) {
                $(selector)
                .focus(function () {
                    if ($(this).val() == texto || $(this).val() == 'El e-mail ingresado no es válido') {$(this).val('')}
                })
                .blur(function () {
                    if ($(this).val() == '') {$(this).val(texto)}
                })
            }
        </script>
    </head>
    <body>
        <div class="formTemplate formCompartir">
            <div class="formEncabezado">
                <p><span class="iconsSprite iconCompartir">Compartir</span></p>
            </div>
            <form id="form_compartir" name="form_contacto" method="post" action="<?php echo(RUTA . 'php/controllers/compartir.controller.php') ?>">
                <div class="camposContainer">
                    <label for="email">Ingrese el e-mail del destinatario:</label>
                    <input type="text" value="" name="email" maxlength="42" id="email" /><br />
                    <?php echo $campos; ?>
                </div>
                <div class="clear"></div>
                <div class="camposContainer">
                    <input class="formBtnSprite btnEnviar" type="submit" id="aceptar" name="login" value=" " />
                </div>
                <div class="clear"></div>
                <input type="hidden" name="productoId" value="<?php echo($_GET['id']); ?>" />
            </form>
            <div class="clear"></div>
        </div>
    </body>
</html>