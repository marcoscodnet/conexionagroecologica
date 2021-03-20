$(document).ready(function() {	
	hacerPeticion();
})

function hacerPeticion (pagina) {
	var p = (pagina)?pagina:1;
	var formData = {pagina:p,estado:$('#selectEstado').val()};
	$.ajax({
		type:'POST',
		url:'php/controllers/listarMensajesAdmin.controller.php',
		data:formData,
		beforeSend:function () {
			$('#listarMensajes').html('<p style="color:#000;">Cargando...</p>');
		},
		success:function (ok) {
			if (ok == false) {ok = '<p style="color:#000;">Esta casilla se encuentra vac&iacute;a.</p>'}
			$('#listarMensajes').html(ok);
			asignarListener();
			centrar();
			//seguir();
		},
		errro:function () {
			alert('Ocurri� un error, por favor int�ntelo nuevamente.')
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
                    url:'php/controllers/aprobarMensaje.controller.php',
                    success:function (ok) {
                        ok = ok.trim();
                        if (ok == 'error') {
                            $.colorbox({
                                href:'tpl/mensajes/aceptarMensaje.error.php', 
                                iframe:true, 
                                innerWidth:400, 
                                innerHeight:300
                            })
                        } else if (ok == 'bien') {
                            $.colorbox({
                                href:'tpl/mensajes/aceptarMensaje.exito.php', 
                                iframe:true, 
                                innerWidth:400, 
                                innerHeight:300
                            })
                        }
                        asignarListener();
                    },
                    errro:function () {
                        alert('Ocurri� un error, por favor int�ntelo nuevamente.')
                    }
                })
            }
        })
    })
	
    $('.btnRechazarAdmin').unbind('click');
    $('.btnRechazarAdmin').click(function () {
        var id = $(this).attr('id').slice(8);
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
                    url:'php/controllers/rechazarMensaje.controller.php',
                    success:function (ok) {
                        ok = ok.trim();
                        if (ok == 'error') {
                            $.colorbox({
                                href:'tpl/mensajes/rechazarMensaje.error.php', 
                                iframe:true, 
                                innerWidth:400, 
                                innerHeight:300
                            })
                        } else if (ok == 'bien') {
                            $.colorbox({
                                href:'tpl/mensajes/rechazarMensaje.exito.php', 
                                iframe:true, 
                                innerWidth:400, 
                                innerHeight:300
                            })
                        }
                        asignarListener();
                    },
                    errro:function () {
                        alert('Ocurri� un error, por favor int�ntelo nuevamente.')
                    }
                })
            }
        })
    })
	
	$('.btnMensajeAdmin').click(function () {
		var id = $(this).attr('id').slice(7); 
		$.colorbox({href:"tpl/leerMensajeAdmin.php?id="+id, iframe:true, innerWidth:400, innerHeight:350})
		return false;
	})
	$('.paginador li a').click (function () {
		var pagina = $(this).attr('id').slice(7);
		hacerPeticion (pagina);
	})
	$('#selectEstado').change(function () {
		hacerPeticion (0);
	})
}

function centrar(){
   var ancho = 0;
   $('.paginador li').each(function(){
      ancho += $(this).outerWidth(true);
   });

   $('.paginador').attr('style','margin:0 auto; width:'+ancho+'px;');
 }