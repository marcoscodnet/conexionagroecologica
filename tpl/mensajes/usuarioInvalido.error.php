<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link type="text/css" href="../../css/reset.css" rel="stylesheet" />
        <link type="text/css" href="../../css/mensajes.colorbox.css" rel="stylesheet" />
        <link type="text/css" href="../../css/formularios.css" rel="stylesheet" />
    </head>

    <body>
        <div class="formTemplate formUsuarioInvalidoError">
            <div class="formEncabezado">
                <p>El servidor no responde Usuaro no v&aacute;lido</p>
            </div>
            <div class="camposContainer">
                <p><b>El usuario no se encuentra registrado</b></p>
                <br/>
                <p>Su usuario no est&aacute; autorizado para realizar esta acci&oacute;n.</p>
                <p>Si usted es un usuario registrado por favor <a href="../../tpl/formularios/login.php">inicie sesi&oacute;n.</a></p>
                <p>Si aun no se encuentra registrado puede hacerlo accediendo a este <a href="tpl/formularios/registrarse.php" onclick='parent.$.colorbox({href:"tpl/formularios/registrarse.php", iframe:true, innerWidth:400, innerHeight:450}); return false;'>link</a></p>
            </div>
            <div class="clear"></div>
        </div>

    </body>
</html>