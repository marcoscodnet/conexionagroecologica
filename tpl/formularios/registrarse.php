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
        <style type="text/css">
            .mensaje {font-family:Arial, Helvetica, sans-serif !important; color:#900; font-size:12px !important}
        </style>
        <script type="text/javascript" src="../../js/jquery-1.6.1.min.js"></script>
        <script type="text/javascript" src="../../js/validadores.js"></script>
        <script type="text/javascript">		
            $(document).ready(function() {
                selectProvicia();
                llenar();
				
				$('.cerrarColorBox').click(function () {
					window.parent.cerrarColorbox();
				})
			
                $('#telefonoArea, #celularArea').click(function () {
                    $(this).val('');
                }).blur(function () {
                    llenar();
                })
			
                //validar campos obligatorios e invalidos al hacer submit
                $('#registroForm').click(function () {
                    var camposAValidar = ['nombre', 'apellido', 'email', 'selectLocalidad'];
                    var ok = true;
                    validarPass();
                    for (var i in camposAValidar) {
                        if (!validarObligatorio(camposAValidar[i])) {
                            ok = false;
                        }
                    }
                    if(( !$('#propietario').prop('checked') )&& ( !$('#productor').prop('checked') )){
                    	$('#checkMensaje').html('Debe seleccionar al menos una opci&oacute;n').attr('class','mensaje');
                        ok = false;
                    }
                    
                    if ($('#pass_2').val() == false) {
                        $('#passMensaje').html('Ingrese la confirmaci&oacute;n del pass').attr('class','mensaje');
                        ok = false;
                    }
                    if ($('#pass').val() == false) {
                        $('#passMensaje').html('Ingrese el pass').attr('class','mensaje');
                        ok = false;
                    }
                    if ($('.mensaje').size()) {
                        ok = false;
                    }
					
					if (ok) {
						$('#form_registro').hide();
						$('.formTemplate').append('<div class="loader"></div>');
						setTimeout(achicar, 250);
					}
					return ok;
                })
				
				function achicar () {
					window.parent.$('.registro').colorbox.resize({innerHeight:300});
				}
			
                //validaciones
                /*$('#nombre, #apellido').blur(function () {
                    validarTexto($(this).attr('id'));
                })
                $('#company').blur(function () {
                    validarTextoYNumero($(this).attr('id'));
                })*/
                $('#email').blur(function () {
                    validarEmail($(this).attr('id'));
                })
                $('#telefonoArea, #telefonoNumero, #celularArea, #celularNumero').blur(function () {
                    validarNumero($(this).attr('id'));
                })
			
                //vaciar y limpiar inputs no validos al hacer foco
                $('input').focus(function () {
                    if ($(this).hasClass('mensaje')) {
                        $(this).removeClass('mensaje').val('');
                    }
                })
				
				$('#propietario, #productor').focus(function () {
                    $('#checkMensaje').html('').removeClass('mensaje')
                })
			

                //vaciar y limpiar los mensajes de los pass
                $('#pass, #pass_2').focus(function () {
                    $('#passMensaje').html('').removeClass('mensaje')
                })
            })
		
            //vacia o agrega los prefijos segun sea el caso
            function llenar () {
                if ($('#telefonoArea').val() == '') {
                    $('#telefonoArea').val('0054')
                }
                if ($('#celularArea').val() == '') {
                    $('#celularArea').val('00549')
                }
            }
		
            //valida que el pass y el pass_2 sean iguales
            function validarPass () {
                if ($('#pass').val() != $('#pass_2').val()) {
                    $('#passMensaje').html('Las contrase&ntilde;as no coinciden').attr('class','mensaje');
                    return false;
                } else {
                    return true;
                }
            }
            
            function selectProvicia () {
                $('#selectProvincia').change(function () {
                    $.ajax({
			type:'POST',
			url:'../../php/controllers/localidadSelect.controller.php',
			data: 'prov='+$(this).val(),
			success:function (ok) {
                            $('#localidadContenedor').html(ok)
			}
                    })
                })
        }
        </script>
    </head>
    <body>
        <div class="formTemplate formRegistro">
            <div class="formEncabezado">
                <p><span class="iconsSprite iconRegistrarse">Registrarse</span></p>
            </div>
            <?php
            include_once('../../php/bootstrap.php');
            include_once('../../php/clases/Archivo.php');
            include_once('../../php/includes/defined.php');
            $provincia = Doctrine::getTable('provincia')->find(1);
            $html = Archivo::leer('registro.form.html');
            $html = str_replace('<!--{formAccion}-->', RUTA . 'php/controllers/registro.controller.php', $html);
            $html = str_replace('<!--{provinciaToSelect}-->', $provincia->toSelect(), $html);
            $html = str_replace('<!--{localidadesToSelect}-->', $provincia->localidadesToSelect(), $html);
            $html = preg_replace('/<!-+\{*[A-Za-z0-9]*\}*-+>/', '', $html);
            echo($html);
            ?>
            <div class="clear"></div>
        </div>
    </body>
</html>
