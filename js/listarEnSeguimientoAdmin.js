$(document).ready(function() {	
	hacerPeticion();
})

function hacerPeticion (pagina) {
	var p = (pagina)?pagina:1;
	$.ajax({
		type:'POST',
		url:'php/controllers/listarEnSeguimientoAdmin.controller.php',
		data:'pagina='+p,
		beforeSend:function () {
			$('#listarConexiones').html('<p style="color:#000;">Cargando...</p>');
		},
		success:function (ok) {
			if (ok == false) {ok = '<p style="color:#000;">Esta casilla se encuentra vac&iacute;a.</p>'}
			$('#listarConexiones').html(ok);
			asignarListener();
            centrar();
			seguir();
		},
		errro:function () {
			alert('Ocurrió un error, por favor inténtelo nuevamente.')
		}
	})
}

function asignarListener () {
	$('.botonAprobar').unbind('click');
	$('.botonAprobar').click(function () {
		var id = $(this).attr('id').slice(7);
		var codigo = $('#codigo').val();
		$.colorbox({
			href:'tpl/mensajes/loader.php',
			iframe:true,
			innerWidth:400,
			innerHeight:300,
			onComplete:function () {
				$.ajax({
					type:'POST',
					data: 'id='+id+'&codigo='+codigo,
					url:'php/controllers/aprobarPublicacion.controller.php',
					success:function (ok) {
						if (ok == 'error') {
							$.colorbox({href:'tpl/mensajes/aceptarPublicacion.error.php', iframe:true, innerWidth:400, innerHeight:300})
						} else if (ok == 'bien') {
							$.colorbox({href:'tpl/mensajes/aceptarPublicacion.exito.php', iframe:true, innerWidth:400, innerHeight:300})
						}
						asignarListener();
					},
					errro:function () {
						alert('Ocurrió un error, por favor inténtelo nuevamente.')
					}
				})
			}
		})
	})
	
	$('.btnBorrarAdmin').click(function () {
		$('.btnBorrarAdmin').unbind('click');
		var id = $(this).attr('id').slice(11);
		$.colorbox({href:'tpl/formularios/borrarAdmin.php?id='+id, iframe:true, innerWidth:400, innerHeight:300})
	})
	
	
	
	$('.paginador li a').click (function () {
		$('.paginador li a').unbind('click');
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