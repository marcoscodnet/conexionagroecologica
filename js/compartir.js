$(document).ready(function() {
	$('.btnCompartir').click(function () {
		var id = $(this).attr('id').slice(9);
		if ($(this).hasClass('noLogin')) {
			$.colorbox({href:"tpl/formularios/compartirNoLogin.php?id="+id, iframe:true, innerWidth:400, innerHeight:320	})
		} else {
			$.colorbox({href:"tpl/formularios/compartirLogin.php?id="+id, iframe:true, innerWidth:400, innerHeight:230})
		}
		return false;
	})
})