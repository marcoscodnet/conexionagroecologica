function cambiarPass () {
	$('#cambiarPass').click(function () {
		$.colorbox({href:'tpl/formularios/cambiarPass.php', iframe:true, innerWidth:400, innerHeight:320})
		return false;
	})
}