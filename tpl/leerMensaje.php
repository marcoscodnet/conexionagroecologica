<?php
session_start();
include_once('../php/bootstrap.php');
$mensaje = Doctrine::getTable('mensaje')->find($_GET['id']);
if ($_SESSION['codigoUsuario'] == $mensaje->receptor->codigo) {
	echo('<script type="text/javascript">');
	echo('window.parent.bindColorbox("reload")');
	echo('</script>');
	if ($mensaje->estado->id == Estado::noLeido()->id) {
		$mensaje->estado = Estado::leido();
		$mensaje->save();
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link type="text/css" href="../css/reset.css" rel="stylesheet" />
        <link type="text/css" href="../css/mensajes.colorbox.css" rel="stylesheet" />
        <link type="text/css" href="../css/formularios.css" rel="stylesheet" />
        <script type="text/javascript">
            window.onload = function () {
                var $_GET = getUrlVars();
                var responder = document.getElementById('responder');
                responder.onclick = function () {
                    window.location = 'formularios/responderMensaje.php?id='+$_GET['id'];
                }
            }

            /*obtiene los valores de las variables get*/
            function getUrlVars() {
                var vars = [], hash;
                var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
                for(var i = 0; i < hashes.length; i++) {
                    hash = hashes[i].split('=');
                    vars.push(hash[0]);
                    vars[hash[0]] = hash[1];
                }
                return vars;
            }
            /* --- fin --- */
        </script>
    </head>

    <body>
        <div class="formTemplate formLeerMensaje">
            <div class="formEncabezado">
                <p><span class="iconsSprite iconMensajes">Mensaje</span></p>
            </div>
            <div class="camposContainer">
                <p><b><?php echo(($mensaje->asunto)); ?></b></p>
            </div>
            <div class="camposContainer">
                <p><strong>Enviado el: </strong><?php echo($mensaje->fecha); ?><br />
                    <strong>De: </strong><?php echo(($mensaje->emisor->toString())); ?></p>
                <p><?php echo(nl2br(($mensaje->contenido))); ?></p>
                <div class="botones">
                    <p><a style="width:90px" href="javascript:void(0)" id="responder">RESPONDER</a>
                    <?php //echo ($data) ?>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>


    </body>
</html>