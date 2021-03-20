<?php
if (isset($_SESSION['log']) && $_SESSION['log'] == 'usuarioValido') {
	$usuario = Doctrine::getTable('usuario')->findOneByCodigo($_SESSION['codigoUsuario']);
	if ($usuario->id == Usuario::admin()->id) { ?>
		<script type="text/javascript">
		$(document).ready(function () {
			$.colorbox({
				href:"tpl/mensajes/accesoDenegado.mensaje.php",
				iframe:true,
				innerWidth:400,
				innerHeight:200,
				onClosed:function () {
					parent.window.location = "index.php";
				}
			})
		})
		</script>
		<?php
		include_once(RUTA_LOCAL.'tpl/accesoDenegado.html');
		exit();
	}
}
?>
