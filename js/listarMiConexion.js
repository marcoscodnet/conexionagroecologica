var $_GET = getUrlVars();
var titulo = {'listarComprasRealizadas':'Compras Realizadas', 'listarVentasRealizadas':'Ventas Realizadas', 'listarMisPublicaciones':'Mis Publicaciones', 'listarFavoritos':'Favoritos', 'listarMensajesRecibidos':'Mensajes Recibidos',  'listarMensajesEnviados':'Mensajes Enviados', 'listarDatosPersonales':'Perfil'}

var accionesPorHash = {'compras':'listarComprasRealizadas', 'ventas':'listarVentasRealizadas', 'publicaciones':'listarMisPublicaciones', 'mensajesRecibidos':'listarMensajesRecibidos', 'mensajesEnviados':'listarMensajesEnviados', 'favoritos':'listarFavoritos', 'perfil':'listarDatosPersonales'}

var hashPorAcciones = {'listarComprasRealizadas':'compras', 'listarVentasRealizadas':'ventas', 'listarMisPublicaciones':'publicaciones', 'listarMensajesRecibidos':'mensajesRecibidos', 'listarMensajesEnviados':'mensajesEnviados', 'listarFavoritos':'favoritos', 'menuComprasRealizadas':'compras', 'menuVentasRealizadas':'ventas', 'menuMisPublicaciones':'publicaciones', 'menuMensajesRecibidos':'mensajesRecibidos', 'listarDatosPersonales':'perfil'}

var controller = {'listarComprasRealizadas':'php/controllers/listarMiConexion.controller.php', 'listarVentasRealizadas':'php/controllers/listarMiConexion.controller.php', 'listarMisPublicaciones':'php/controllers/listarMiConexion.controller.php', 'listarFavoritos':'php/controllers/listarMiConexion.controller.php', 'listarMensajesRecibidos':'php/controllers/listarMensajes.controller.php',  'listarMensajesEnviados':'php/controllers/listarMensajes.controller.php', 'listarDatosPersonales':'php/controllers/listarDatosPersonales.controller.php'}

$(document).ready(function() {	
	var codigo = $('#codigo').val();
	var jash = window.location.hash
	var accion = (jash.length > 1)?accionesPorHash[jash.slice(1)]:'listarComprasRealizadas';
	$('.cajaIzqMenuBack a').removeClass('activo');
	$('#'+accion).addClass('activo');
	hacerPeticion(codigo, accion);
	
	$('#listarPendientes, #listarComprasRealizadas, #listarVentasRealizadas, #listarMisPublicaciones, #listarFavoritos, #listarMensajesRecibidos, #listarMensajesEnviados, #listarDatosPersonales').bind('click', function () {
		hacerPeticion(codigo, $(this).attr('id'));
		$('.cajaIzqMenuBack a').removeClass('activo');
		$(this).addClass('activo');
		window.location.hash = hashPorAcciones[$(this).attr('id')];
	})
	
	$('#menuComprasRealizadas, #menuVentasRealizadas, #menuMisPublicaciones, #menuMensajesRecibidos, #menuDatosPersonales').click (function () {
		var id = $(this).attr('id');
		var clase = id.replace('menu', 'listar')
		window.location.hash = hashPorAcciones[id];
		hacerPeticion(codigo, clase);
		$('.cajaIzqMenuBack a').removeClass('activo');
		$('#'+clase).addClass('activo');
		return false;
	})
	
})

/*hace el request al controller*/
function hacerPeticion (codigo, accion, pagina) {
	var p = (pagina)?pagina:1;
	$.ajax({
		type:'POST',
		url:controller[accion],
		data: 'codigo='+codigo+'&accion='+accion+'&pagina='+p,
		beforeSend:function () {
			$('#listarMiConexion').html('<p style="color:#000;">Cargando...</p>');
		},
		success:function (ok) {
			if (ok == false) {ok = '<p style="color:#000;">Esta casilla se encuentra vac&iacute;a.</p>'}
			$('#listarMiConexion').html(ok);
			asignarListener();
			$('.contCajaDerBack').find('.solapaVerdeTitulos').html('<p>'+titulo[accion]+'</p>');
		},
		errro:function () {
			alert('Ocurri� un error, por favor int�ntelo nuevamente.')
		}
	})
}
/* --- fin --- */

/*obtiene los valores de las variables get*/
function getUrlVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}
/* --- fin --- */


/* --- asignar listeners --- */
function asignarListener () {
	var codigo = $('#codigo').val();
	$('.paginador li a').click (function () {
		var accion = $('.paginador').attr('id');
		var pagina = $(this).attr('id').slice(7);
		hacerPeticion (codigo, accion, pagina);
	})
	$('.btnMensaje').click(function () {
		var id = $(this).attr('id').slice(7); 
		$.colorbox({href:"tpl/leerMensaje.php?id="+id, iframe:true, innerWidth:400, innerHeight:350})
		return false;
	})
	$('.btnMensajeSimple').click(function () {
		var id = $(this).attr('id').slice(7); 
		$.colorbox({href:"tpl/leerMensajeSimple.php?id="+id, iframe:true, innerWidth:400, innerHeight:350})
		return false;
	})
	//borrar mensaje por el due�o
	$('.btnBorrar').click(function () {
		var jash = window.location.hash
		if (jash == '#publicaciones') {
			var id = $(this).attr('id').slice(11); 
			$.colorbox({href:'tpl/mensajes/borrar.confirm.php?id='+id, iframe:true, innerWidth:400, innerHeight:220})
		} else if (jash == '#mensajesEnviados') {
			var id = $(this).attr('id').slice(7); 
			$.colorbox({href:'tpl/mensajes/borrarMensaje.confirm.php?id='+id+'&controller=borrarMensajeEmisor', iframe:true, innerWidth:400, innerHeight:220})
		} else if (jash == '#mensajesRecibidos') {
			var id = $(this).attr('id').slice(7); 
			$.colorbox({href:'tpl/mensajes/borrarMensaje.confirm.php?id='+id+'&controller=borrarMensajeReceptor', iframe:true, innerWidth:400, innerHeight:220})
		}
		return false;
	})
	
	$('.calificarCompra').click(function () {
		var id = $(this).attr('id').slice(11);
		$.colorbox({href:"tpl/calificarCompra.php?id="+id, iframe:true, innerWidth:400, innerHeight:150})
		return false;
	})
	
	$('.calificarVenta').click(function () {
		var id = $(this).attr('id').slice(11);
		$.colorbox({href:"tpl/calificarVenta.php?id="+id, iframe:true, innerWidth:400, innerHeight:150})
		return false;
	})
	
	$('.paginador li a').click (function () {
		var accion = $('.paginador').attr('id');
		var pagina = $(this).attr('id').slice(7);
		hacerPeticion (codigo, accion, pagina);
	})
	centrar();
	cambiarPass();
	cambiarDatos();
}
function centrar(){
   var ancho = 0;
   $('.paginador li').each(function(){
      ancho += $(this).outerWidth(true);
   });

   $('.paginador').attr('style','margin:0 auto; width:'+ancho+'px;');
 }
