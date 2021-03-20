/*$(document).ready(function() {
	$('#btnComprar').click(function () {
		$(this).unbind();
		$.ajax({
			type:'POST',
			url:'php/controllers/comprar.controller.php',
			data: 'productoId='+$('#productoId').val()+'&codigoUsuario='+$('#codigoUsuario').val(),
			beforeSend:function () {
				$('.cajaBotonesResultadoBusqueda').append('<p style="clear:both; display:block" class="titulito"><span>Procesando solicitud</span><br /><img src="images/loading.gif" /></p>');
			},
			success:function (ok) {
				$('.cajaBotonesResultadoBusqueda p.titulito').remove();
				$.colorbox({href:"tpl/mensajes/"+ok, iframe:true, innerWidth:400, innerHeight:250})
			},
			error:function () {
				$('.cajaBotonesResultadoBusqueda p.titulito').remove();
				$.colorbox({href:"tpl/mensajes/server.error.php", iframe:true, innerWidth:400, innerHeight:250})
			}
		})
		return false;
	})
})*/

$(document).ready(function() {
    $('#comprar').click(function () {
        if ($(this).attr('href') != 'tpl/formularios/login.php') {
            $.colorbox({
                href:"tpl/mensajes/comprar.confirm.php?productoId="+$('#productoId').val(), 
                iframe:true, 
                innerWidth:400, 
                innerHeight:220
            })
            return false;
        }
    })
})