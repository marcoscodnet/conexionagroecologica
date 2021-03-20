$(document).ready(function() {
	  seguir();
})

function seguir () {
	$('.btnSeguir, .btnDejarDeSeguir').click(function () {
		var id = $(this).attr('id').slice(6);
		var accion = $(this).attr('class');
		
		if ($('#codigoUsuario').val()) {
			var codigo = $('#codigoUsuario').val()
		} else if ($('#fg').val()) {
			var codigo = $('#fg').val()
		} else {
			var codigo = $('#codigo').val()
		}
			
		$.ajax({
			type:'POST',
			url:'php/controllers/seguir.controller.php',
			data: 'propiedadId='+id+'&codigo='+codigo+'&accion='+accion,
			beforeSend:function () {
				/*$('.cajaBotonesResultadoBusqueda').append('<p style="clear:both; display:block" class="titulito"><span>Procesando solicitud</span><br /><img src="images/loading.gif" /></p>');*/
			},
			success:function (ok) {
				/*$('.cajaBotonesResultadoBusqueda p.titulito').remove();
				$.colorbox({href:"tpl/mensajes/"+ok, iframe:true, innerWidth:400, innerHeight:250})*/
			},
			errro:function () {
				$.colorbox({href:"tpl/mensajes/server.error.php", iframe:true, innerWidth:400, innerHeight:250})
			}
		})
		if (accion == 'btnSeguir') {
			$(this).attr('class','btnDejarDeSeguir')
		} else {
			$(this).attr('class','btnSeguir')
		}
		return false;
	})
}