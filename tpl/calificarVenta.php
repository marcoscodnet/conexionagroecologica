<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link type="text/css" href="../css/reset.css" rel="stylesheet" />
    <link type="text/css" href="../css/mensajes.colorbox.css" rel="stylesheet" />
    <link type="text/css" href="../css/formularios.css" rel="stylesheet" />
    <style type="text/css">
        .estrella strong {display:none}
        .estrella {background-image:url(../images/estrella-llena.png); width:16px; height:16px; display:block; float:left; margin-right:2px; position:relative; cursor:pointer}
        .estrellaVacia {background-image:url(../images/estrella-vacia.png); width:16px; height:16px; display:block; float:left; margin-right:2px; position:relative; cursor:pointer}
    </style>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            /*$('ul li').click(function (e) {
                $(this).nextAll('li').attr('class', 'estrellaVacia').find('strong').html('&nbsp;');
                $(this).prevAll('li').attr('class', 'estrella').find('strong').html('&bull;');
                if ($(this).attr('class') == 'estrella') {
                    $(this).attr('class', 'estrellaVacia').find('strong').html('&nbsp;');
                } else {
                    $(this).attr('class', 'estrella').find('strong').html('&bull;');
                }
            })*/
            $('#calificar').click(function () {
                var puntos = $('ul li.estrella').size();
                var id = $('#id').val();
                var gt = $('#gt').val();
                $('.camposContainer').remove();
                $('.formTemplate').append('<div class="loader"></div>');
                $.ajax({
                    type:'POST',
                    data: 'puntos='+puntos+'&id='+id+'&gt='+gt,
                    url:'../php/controllers/calificarVenta.controller.php',
                    success:function (ok) {
                        $('.loader').removeClass('loader').html(ok);
                        window.parent.bindColorbox('reload');
                        setTimeout(window.parent.cerrarColorbox, 1300);
                    },
                    errro:function () {
                        alert('Ocurrió un error, por favor inténtelo nuevamente.')
                    }
                })
            })
        })
    </script>
</head>

<body>
    <div class="formTemplate formLeerMensaje">
        <div class="formEncabezado">
            <p>Calificar</p>
        </div>
        <div class="camposContainer">
            <p><b>Califique a su comprador</b></p>
        </div>
        <div class="camposContainer">
            <p>&iquest;Desea calificar esta conexi&oacute;n como positiva?</p>
            <p><a href="javascript:void(0)" id="calificar"></a></p>
            <input type="hidden" name="id" id="id" value="<?php echo($_GET['id']); ?>" />
            <input type="hidden" name="gt" id="gt" value="<?php echo($_SESSION['codigoUsuario']); ?>" />
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>


</body>
</html>