var $_GET = getUrlVars();

$(document).ready(function() {
	$('.btnBorrar').click(function () {
		$.colorbox({href:"tpl/mensajes/borrar.confirm.php?id="+$_GET['id'], iframe:true, innerWidth:400, innerHeight:230})
		return false;
	})
	$('.btnBorrarAdmin').click(function () {
		$.colorbox({href:"tpl/formularios/borrarAdmin.php?id="+$_GET['id'], iframe:true, innerWidth:400, innerHeight:300})
		return false;
	})
	$('.btnAceptarAdmin').click(function () {
		$.colorbox({
			href:"tpl/mensajes/loader.php",
			iframe:true,
			innerWidth:400,
			innerHeight:250,
			onComplete:function () {
				$.ajax({
					type:'POST',
					data: 'codigo='+$('#fg').val()+'&id='+$_GET['id'],
					url:'php/controllers/aprobarPublicacion.controller.php',
					beforeSend:function () {
			
					},
					success:function (ok) {
						if (ok == 'error') {
							$.colorbox({href:'tpl/mensajes/aceptarPublicacion.error.php', iframe:true, innerWidth:400, innerHeight:300})
						} else if (ok == 'bien') {
							$.colorbox({href:'tpl/mensajes/aceptarPublicacion.exito.php', iframe:true, innerWidth:400, innerHeight:300})
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
})

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