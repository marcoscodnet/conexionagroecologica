function cambiarDatos () {
	$('#form_datos_personales').submit(function () {
		var camposAValidar = ['nombre', 'apellido', 'email', 'cuit'];
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
		
		$('#propietario, #productor').focus(function () {
            $('#checkMensaje').html('').removeClass('mensaje')
        })
		
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
		}
		if (ok) {
			$.colorbox({
				href:'tpl/mensajes/loader.php',
				iframe:true,
				innerWidth:400,
				innerHeight:320,
				onComplete:function () {
					$.ajax({
						type:'POST',
						url:'php/controllers/registro.controller.php',
						data: $('#form_datos_personales').serialize(),
						success:function (ok) {
							$.colorbox({href:'tpl/mensajes/'+ok, iframe:true, innerWidth:400, innerHeight:320})
						},
						error:function () {
							$.colorbox({href:"tpl/mensajes/server.error.php", iframe:true, innerWidth:400, innerHeight:250})
						}
					})
				}
			})
			return false;
		}
		return false;
	})
	
	//validaciones
	$('#nombre, #apellido').blur(function () {
		validarTexto($(this).attr('id'));
	})
	$('#company, #razon').blur(function () {
		validarTextoYNumero($(this).attr('id'));
	})
	$('#email').blur(function () {
		validarEmail($(this).attr('id'));
	})
	$('#telefonoArea, #telefonoNumero, #celularArea, #celularNumero, #cuit').blur(function () {
		validarNumero($(this).attr('id'));
	})
	
	//vaciar y limpiar inputs no validos al hacer foco
	$('input').focus(function () {
		if ($(this).hasClass('mensaje')) {
			$(this).removeClass('mensaje').val('');
		}
	})
	
	//vaciar y limpiar los mensajes de los pass
	$('#pass, #pass_2').focus(function () {
		$('#passMensaje').html('').removeClass('mensaje')
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
	
}