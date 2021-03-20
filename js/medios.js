$(document).ready(function() {
	var jash = window.location.hash;
	var url = 'tpl/medios/'
	var href = (jash.length > 1)?jash:$('.contLogosMedio a:eq(0)').attr('href');
	href = url+href.slice(1)+'.html';
	$('.contInfoMedios').load(href);
	
	$('.contLogosMedio a').click(function () {
		window.location.hash = href = $(this).attr('href');
		href = url+href.slice(1)+'.html';
		$('.contInfoMedios').load(href);
		return false;
	})
})
