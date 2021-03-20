$(document).ready(function() {	
	hacerPeticion();
})

function hacerPeticion (pagina) {
	var p = (pagina)?pagina:1;
	$.ajax({
		type:'POST',
		url:'php/controllers/listarTransaccionesAdmin.controller.php',
		data:'pagina='+p,
		beforeSend:function () {
			$('#listarConexiones').html('Cargando...');
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
	$('.botonAprobar').click(function () {
		var id = $(this).attr('id').slice(7);
		var codigo = $('#codigo').val();
		$.colorbox({
			href:'tpl/mensajes/loader.php',
			iframe:true,
			innerWidth:400,
			innerHeight:320,
			onComplete:function () {
				$.ajax({
					type:'POST',
					data: 'codigo='+codigo+'&id='+id,
					url:'php/controllers/aprobarTransaccion.controller.php',
					success:function (ok) {
						if (ok == 'error') {
							$.colorbox({href:'tpl/mensajes/aceptarTransaccion.error.php', iframe:true, innerWidth:400, innerHeight:300})
						} else if (ok == 'bien') {
							$.colorbox({href:'tpl/mensajes/aceptarTransaccion.exito.php', iframe:true, innerWidth:400, innerHeight:300})
						}
					},
					errro:function () {
						alert('Ocurrió un error, por favor inténtelo nuevamente.')
					}
				})
			}
		})		
		return false;
	})
	
	$('.btnBorrarAdmin').click(function () {
		var id = $(this).attr('id').slice(11);
		$.colorbox({href:'tpl/mensajes/borrarTransaccion.confirm.php?id='+id, iframe:true, innerWidth:400, innerHeight:300})
		return false;
	})
	
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