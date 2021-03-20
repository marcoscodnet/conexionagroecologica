$(document).ready(function() {	
	hacerPeticion();
})

function hacerPeticion (pagina) {
	var p = (pagina)?pagina:1;
	$.ajax({
		type:'POST',
		url:'php/controllers/listarUsuariosAdmin.controller.php',
		data:'pagina='+p,
		beforeSend:function () {
			$('#listarMiConexion').html('<p style="color:#000;">Cargando...</p>');
		},
		success:function (ok) {
			if (ok == false) {ok = '<p style="color:#000;">Esta casilla se encuentra vac&iacute;a.</p>'}
			$('#listarMiConexion').html(ok);
			onAjaxComplete();
		},
		errro:function () {
			alert('Ocurrió un error, por favor inténtelo nuevamente.')
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
        enviarMensaje();
	//seguir();
}

function centrar(){
   var ancho = 0;
   $('.paginador li').each(function(){
      ancho += $(this).outerWidth(true);
   });

   $('.paginador').attr('style','margin:0 auto; width:'+ancho+'px;');
 }
 
 function enviarMensaje () {
    $('#listarMiConexion a.btn.naranja').click(function (event) {
        event.preventDefault();
        $this = $(this);
        $.colorbox({href:$this.attr('href'), iframe:true, innerWidth:400, innerHeight:380});
    })
 }