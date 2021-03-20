<?php
if (!isset($_SESSION['log']) || $_SESSION['log'] != 'usuarioValido') {
?>
<script type="text/javascript">
$(document).ready(function () {
	$.colorbox({
		href:"tpl/formularios/noLogin.php",
		iframe:true,
		innerWidth:400,
		innerHeight:350,
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
?>
