<?php
include_once('../../php/bootstrap.php');
include_once('../../php/includes/defined.php');

function desencriptar($texto) {
    $desencrypt = '';
    $texto = preg_replace('/([a-z])+/', '-', $texto);
    $textoArray = array_reverse(explode('-', $texto));
    foreach ($textoArray as $letra) {
        $desencrypt .= chr($letra);
    }
    return $desencrypt;
}

$val = '';
$hidden = '';
$mail = '';
$checked = '';
if (isset($_COOKIE['r'])) {
    $val = 'passwdpasswd';
    $checked = 'checked="checked"';
    $hidden = '
		<input type="hidden" value="' . $_COOKIE['r'] . '" name="r" />
		<input type="hidden" value="' . $_COOKIE['u'] . '" name="u" />
		<input type="hidden" value="' . $_COOKIE['p'] . '" name="p" />
	';
    $usuario = Usuario::isValido($_COOKIE['m'], desencriptar($_COOKIE['r']));
    if ($usuario) {
        $mail = $usuario->email;
    } else {
        $mail = '';
    }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link type="text/css" href="../../css/reset.css" rel="stylesheet" />
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
                    div.getElementsByTagName('p')[1].style.display = 'none';
                    div.getElementsByTagName('p')[2].style.display = 'none';
                    this.style.display = 'none';
                    div.appendChild(loader);
                    return true;
                }
            }
        </script>
    </head>
    <body>
        <div class="formTemplate formNoLogin">
            <div class="formEncabezado">
                <p>Acceso denegado</p>
            </div>
            <form id="form_no_login" name="form_contacto" method="post" action="<?php echo(RUTA . 'php/controllers/login.controller.php') ?>">
                <div class="camposContainer">
                    <p class="aviso"><b>Debe estar logueado para poder acceder a esta secci&oacute;n</b></p>
                    <p class="volver"><a href="javascript:parent.history.go(-1)">Volver</a></p>
                    <label for="email">E-mail</label>
                    <input type="text" value="<?php echo ($mail); ?>" name="email" maxlength="42" id="email" /><br />
                    <label for="clave">Clave</label>
                    <input type="password" value="<?php echo ($val); ?>" name="clave" maxlength="42" id="clave" /><br />
                </div>
                <div class="clear"></div>
                <div class="camposContainer">
                    <p><a href="recuperar-pass.php" onClick="parent.window.location = '../../recuperar-pass.php'; return false" >&iquest;Olvid&oacute; su contrase&ntilde;a?</a>
                        <label for="recuperarPass" class="recordarContrasena aviso">Recordar contrase&ntilde;a</label>
                        <input class="recordarContrasena" type="checkbox" <?php echo ($checked); ?> name="recordarPass" id="recuperarPass"/></p>
                </div>
                <div class="camposContainer">
                    <p><a class="formBtnSprite btnRegistro" href="injertos/formularios/registrarse.php" onclick='parent.$.colorbox({href:"tpl/formularios/registrarse.php", iframe:true, innerWidth:400, innerHeight:650}); return false;'></a>
                        <input class="formBtnSprite btnLogin" type="submit" name="login" value=" " id="login" />
                </div>
                <div class="clear"></div>
                <?php echo($hidden); ?>
            </form>
            <div class="clear"></div>
        </div>
    </body>
</html>