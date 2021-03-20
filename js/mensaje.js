$(document).ready(function() {
	$('#preguntaAlVendedor .btnPreguntar').click(function () {
		if ($('textarea').val() == false) {
			$('.contPreguntasVendedor #mensaje').html('Debe ingresar el contenido del mensje');
			return false;
		}
		$.colorbox({
			href:"tpl/mensajes/loader.php",
			iframe:true,
			innerWidth:400,
			innerHeight:250,
			onComplete:function () {
				$.ajax({
					type:'POST',
					url:'php/controllers/mensaje.controller.php',
					data: $('#preguntaAlVendedor').serialize(),
					success:function (ok) {
						$('.contPreguntasVendedor textarea').attr('disabled', 'disabled').val('');
						$('#preguntaAlVendedor .btnPreguntar').unbind('click');
						$('#preguntaAlVendedor .btnPreguntar').attr('disabled', 'disabled');
						$.colorbox({href:"tpl/mensajes/mensaje.exito.php", iframe:true, innerWidth:400, innerHeight:150})
					},
					error:function () {
						$.colorbox({href:"tpl/mensajes/server.error.php", iframe:true, innerWidth:400, innerHeight:250})
					}
				})
			}
		})
		return false;
	})
	/*if ($('#pregunta').size()) {
		$('#pregunta').keyup(function () {
			limitChars('pregunta', 140, 'mensaje');
		})
		limitChars('pregunta', 140, 'mensaje');
	}	*/	
	hacerPeticion();
})




function limitChars(textid, limit, infodiv) {
	var text = $('#'+textid).val(); 
	var textlength = text.length;
	if(textlength > limit) {
		$('#'+textid).val(text.substr(0,limit));
		return false;
	} else {
		$('#' + infodiv).html('Le quedan '+ (limit - textlength) +' caracteres restantes.');
		return true;
	}
}
function hacerPeticion (pagina) {
	var p = (pagina)?pagina:1;
	var formData = {pagina:p,propiedadId:$('#propiedadId').val()};
	$.ajax({
		type:'POST',
		url:'php/controllers/listarMensajesPropiedad.controller.php',
		data:formData,
		beforeSend:function () {
			$('#listarMensajes').html('<p style="color:#000;">Cargando...</p>');
		},
		success:function (ok) {
			if (ok == false) {ok = ''}
			$('#listarMensajes').html(ok);
			asignarListener();
			centrar();
			//seguir();
		},
		errro:function () {
			alert('Ocurrió un error, por favor inténtelo nuevamente.')
		}
	})
}

function asignarListener () {
	$('.paginador li a').click (function () {
		var pagina = $(this).attr('id').slice(7);
		hacerPeticion (pagina);
	})
	
}

function centrar(){
   var ancho = 0;
   $('.paginador li').each(function(){
      ancho += $(this).outerWidth(true);
   });

   $('.paginador').attr('style','margin:0 auto; width:'+ancho+'px;');
 }