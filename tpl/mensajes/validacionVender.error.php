<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link type="text/css" href="../../css/reset.css" rel="stylesheet" />
        <link type="text/css" href="../../css/mensajes.colorbox.css" rel="stylesheet" />
        <link type="text/css" href="../../css/formularios.css" rel="stylesheet" />
        <script type="text/javascript">
            window.onload = function () {
                var mensaje = document.getElementById('mensaje');
                mensaje.innerHTML = window.parent.mensajes;
            }
        </script>
    </head>

    <body>
        <div class="formTemplate formValidacionVenderError">
            <div class="formEncabezado">
                <p><span class="iconsSprite iconError">ERROR</span></p>
            </div>
            <div class="camposContainer" id="mensaje">
            </div>
            <div class="clear"></div>
        </div>

    </body>
</html>