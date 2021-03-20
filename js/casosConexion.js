$(document).ready(function() {
	var jash = window.location.hash;
	var url = 'tpl/casosConexion/'
	var href = (jash.length > 1)?jash:$('#carrusel a:eq(0)').attr('href');
	href = url+href.slice(1)+'.html';
	$('.contCasoConexionIndividualLg').load(href);
	
	$('#carrusel a').click(function () {
		window.location.hash = href = $(this).attr('href');
		href = url+href.slice(1)+'.html';
		$('.contCasoConexionIndividualLg').load(href);
		return false;
	})
	agregarAlt();
})

function agregarAlt () {
	var alt = '';
	$('div.contCasoConexionIndividualTn img').each(function () {
		alt = $(this).parent().attr('href');
		$(this).attr('alt', alt.slice(1));
	})
}