$(document).ready(function () {
    $('img.fadeFotos').click(function () {
        var id = $(this).attr('id');
        var self = $(this);
        id = id.slice(3);
		
        $('#imagenes a').each(function(){
            $(this).find('img').css('opacity','0');
        });
		
        slideSwitch(id);
    });
    
    $('#imagenes a').die('hover').live('hover', showZoom);
    $('#imagenes a').die('click').live('click', hiddenZoom);
})

function slideSwitch(id) {
    var $active = $('#imagenes img.active');
    if ( $active.length == 0 ) {
        $active = $('#imagenes img:last');
    }
	
    var $next = $active.next().length ? $active.next() : $('#imagenes img:first');
	
    $active.addClass('last-active');
		
    $('.galeria').eq(id).css({
        opacity: 0.0
    })
    .addClass('active')
    .animate({
        opacity: 1.0
    }, 300, function() {
        $active.removeClass('active last-active');
    });
}

function hiddenZoom(){
    $(this).find('.zoomHover').css('display', 'none');
}

function showZoom(){
    $(this).find('.zoomHover').css('display', 'block');
}