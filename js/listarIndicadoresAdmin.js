$(document).ready(function() {	
	hacerPeticion();
})

function hacerPeticion (pagina) {
	var p = (pagina)?pagina:1;
	$.ajax({
		type:'POST',
		url:'php/controllers/listarIndicadoresAdmin.controller.php',
		data:'pagina='+p,
		beforeSend:function () {
			$('#listarIndicadores').html('<p style="color:#000;">Cargando...</p>');
		},
		success:function (ok) {
			if (ok == false) {ok = '<p style="color:#000;">Esta casilla se encuentra vac&iacute;a.</p>'}
			$('#listarIndicadores').html(ok);
			onAjaxComplete();
		},
		errro:function () {
			alert('Ocurri� un error, por favor int�ntelo nuevamente.')
		}
	})
}

function onAjaxComplete () {
	$('.paginador li a').click (function () {
		$('.paginador li a').unbind('click');
		var pagina = $(this).attr('id').slice(7);
		hacerPeticion (pagina);
	})
	centrar();
	seguir();
}

function centrar(){
   var ancho = 0;
   $('.paginador li').each(function(){
      ancho += $(this).outerWidth(true);
   });

   $('.paginador').attr('style','margin:0 auto; width:'+ancho+'px;');
 }