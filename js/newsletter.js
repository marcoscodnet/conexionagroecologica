$(document).ready(function() {
	vaciar('ingrese su e-mail', '#inputNews');
	$('#newsletter').submit(function () {
		if (validarEmail('inputNews')) {
			$.colorbox({
				href:"tpl/mensajes/loader.php",
				iframe:true,
				innerWidth:400,
				innerHeight:250,
				onComplete:function () {
					$.ajax({
						type:'POST',
						url:'php/controllers/newsletter.controller.php',
						data: 'email='+$('#inputNews').val(),
						success:function (ok) {
							$.colorbox({href:'tpl/mensajes/newsletter.'+ok+'.php', iframe:true, innerWidth:400, innerHeight:250});
							$('#inputNews').val('');
							vaciar('ingrese su e-mail', '#inputNews');
						},
						error:function () {
							$.colorbox({href:'tpl/mensajes/server.error.php', iframe:true, innerWidth:400, innerHeight:250});
							$('#inputNews').val();
							vaciar('ingrese su e-mail', '#inputNews');
						}
					})
				}
			})
		}
		return false;
	})
})

function vaciar (texto, selector) {
	$(selector)
	.focus(function () {
		if ($(this).val() == texto || $(this).val() == 'El mail ingresado no es válido') {$(this).val('')}
	})
	.blur(function () {
		if ($(this).val() == '') {$(this).val(texto)}
		validarEmail('inputNews')
	})
}