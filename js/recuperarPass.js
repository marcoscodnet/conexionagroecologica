$(document).ready(function() {
	var $_GET = getUrlVars();
	if ($_GET['r']) {
		$('#respuesta').html(respuestas[$_GET['r']]);
	}
	$('#generarPass').click(function () {
		$.ajax({
			type:'POST',
			url:'php/controllers/recuperarPass.generarPass.controller.php',
			data: $('#datos').serialize(),
			beforeSend:function () {
				$('#respuesta').html('Por favor espere...')
			},
			success:function (ok) {
				$('#respuesta').html(respuestas[ok]);
			},
			errro:function () {
				alert('Ocurrió un error, por favor inténtelo nuevamente.')
			}
		})
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

var intenteloNuevamente = '<p class="titulo"><a href="recuperar-pass.php" style="color:#C63; text-align:left">Int&eacute;nentelo nuevamente.</a></p>';
var respuestas = [
	'El captcha ingresado es incorrecto.'+intenteloNuevamente,
	'Ha ocurrido un error. Por favor verifique que el mail ingresado sea correcto y vuelva a intentarlo. Si el error persiste por favor comun&iacute;quese con nosotros.'+intenteloNuevamente,
	'Se le ha enviado un correo elect&oacute;nico a su casilla personal para que confirme la solicitud de generar una nueva contrase&ntilde;a.',
	'El mail ingresado no corresponde a un usuario v&aacute;lido.'+intenteloNuevamente,
	'El proceso se complet&oacute; con &eacute;xito.<br />Redireccionando al index...<script>redireccionar()</script>',
	'Ha ocurrido un error. Intentenlo nuevamente en otro momento',
	'El link al que trata de acceder ha expirado. Vuelva a iniciar el proceso de recuperaci&oacute;n de contrase&ntilde;a'
];

function redireccionar () {
	setTimeout(redireccion, 1200);
}

function redireccion () {
	window.location = 'index.php';
}
