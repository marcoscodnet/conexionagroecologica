<?php
session_start();
include_once('php/clases/Archivo.php');
include_once('php/clases/Includer.php');
include_once('php/includes/defined.php');
include_once('php/bootstrap.php');
$html = Archivo::leer('tpl/header.html');
$html = str_replace('<!--{recursoJs}-->', Includer::addJs('jquery-1.6.1.min', 'jquery.validate.min', 'Replacer', 'casosExitosos', 'loginRegister', 'cufon-yui', 'HelvLight_400.font', 'dropdown-menu', 'jquery.colorbox', 'loginRegister', 'galleryBox', 'compartir', 'validadores', 'newsletter', 'seguir'), $html);
$html = str_replace('<!--{recursoCss}-->', Includer::addCss('reset', 'winModal', 'vistas', 'colorbox', 'galleryBox'), $html);
$html = preg_replace('/<!-+\{*[A-Za-z0-9]*\}*-+>/', '', $html);
echo($html);
?>
<script>
    $(document).ready(function () {
        if (location.hash == '#success') {
            $.colorbox({
                href:'tpl/mensajes/consulta.exito.php',
                width: 410,
                height: 180
            });
        }
    })
</script>
<body>
    <!-- ENCABEZADO - LOGO - BOTONERA -->
    <div id="header-wrapper">
        <div class="contAnchoHeader">
            <?php
            include_once('php/comprobadores/encabezado.comprobador.php');
            $html = Archivo::leer('tpl/logoBotonera.html');
            $class = (isset($_SESSION['log'])) ? '' : 'class="login"';
            $vender = (isset($_SESSION['log'])) ? 'publicar.php' : 'tpl/formularios/login.php';
            $html = str_replace('<!--{comprobarVender}-->', $vender, $html);
            $html = str_replace('<!--{class}-->', $class, $html);
            echo($html);
            ?>
        </div>
    </div>
    <!-- FIN ENCABEZADO - LOGO - BOTONERA -->

    <div class="clear"></div>

    <!-- CONTENIDO HOME -->
    <div id="content-wrapper">
        <div id="contenedorBloqueSolapa">
            <div class="solapaVerdeTitulosBuscar">
                <div id=""><p>Consultas</p></div>
            </div>
            <div class="clear"></div>
            <div class="contInfoBloques">
                <div class="contResultadosBusqueda">
                    <div class="encabezadoBusqueda">
                        <p>Envianos tu consulta:</p>
                    </div>
                    <div>
                        <form id="formConsulta" method="post" action="php/controllers/consulta.controller.php">
                            <div style="width: 420px; margin-right: 25px; display: inline-block">
                                <label for="nombre" class="label-control">Nombre: </label>
                                <input type="text" name="nombre" id="nombre" class="form-control" />
                            </div>
                            <div style="width: 420px; margin-right: 0; display: inline-block">
                                <label for="empresa" class="label-control">Empresa:</label>
                                <input type="text" name="empresa" id="empresa" class="form-control" />
                            </div>
                            <p>&nbsp;</p>
                            <div style="width: 420px; margin-right: 25px; display: inline-block">
                                <label for="email" class="label-control">Email:</label>
                                <input type="text" name="email" id="email" class="form-control" />
                            </div>
                            <div style="width: 420px; margin-right: 0; display: inline-block">
                                <label for="telefono" class="label-control">Tel&eacute;fono:</label>
                                <input type="text" name="telefono" id="telefono" class="form-control" />
                            </div>
                            <p>&nbsp;</p>
                            <label for="consulta" class="label-control">Consulta:</label>
                            <textarea name="consulta" id="consulta" class="form-control" style="height: 250px"></textarea>
                            <p>&nbsp;</p>
                            <p style="text-align: right"><input type="submit" name="Enviar" class="btn naranja" /></p>
                        </form>
                        <script>
                            $("#formConsulta").validate({
                                errorPlacement: function(error, element) {
                                    element.prev().find('span').html(error.html())
                                    element.before(error)
                                },
                                rules: {
                                    nombre: {
                                        required: true
                                    },
                                    email: {
                                        required: true,
                                        email: true
                                    },
                                    consulta : {required: true}
                                }, messages: {
                                    nombre: {
                                        required: "Este campo es obligatorio"
                                    },
                                    email: {
                                        required: "Este campo es obligatorio",
                                        email: "El email ingresado no es v&aacute;lido"
                                    },
                                    consulta: {required: "Este campo es obligatorio"}
                                },
                                submitHandler: function(form) {
                                    $('#formConsulta input[type="submit"]').css({'background': '#999'}).val('Enviando...').attr('disabled', 'disabled');
                                    form.submit();
                                }
                            });
                        </script>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <!-- FIN CONTENT WRAPPER -->

    <div class="clear"></div>

    <!-- FOOTER WRAPPER -->
    <div id="footer-wrapper">
        <?php
        $html = Archivo::leer('tpl/pieDePagina.html');
        include_once('php/replacers/pieDePagina.replacer.php');
        echo ($html);
        ?>
    </div>
    <!-- FIN FOOTER WRAPPER -->
</body>
</html>