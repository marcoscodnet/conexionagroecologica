$(document).ready(function() {	
    $('#selectCategoria, #selectProvincia').bind('change', function () {
        $('#pagina').val(1);
        hacerPeticion();
    })
    asignarListener();
    centrar();
})

/*hace el request al controller*/
function hacerPeticion () {
    var data = $('#buscadorCombos').serialize();
    $.ajax({
        type:'POST',
        url:'php/providers/eventos.provider.php',
        data: data,
        dataType: 'html',
        beforeSend:function () {
            $('#listadoEventos').html('<p style="clear:both; display:block; color:#000" class="titulito"><span>Procesando solicitud</span><br /><img src="images/loading.gif" /></p>');
        },
        success:function (ok) {
            if (ok == false) {
                ok = '<p style="color:#000;">La b&uacute;squeda no arraj&oacute; ning&uacute;n resultado.</p>';
            } else {
                var $html = $('<div>'+ok+'</div>');
                if ($('.contPaginador').length) {
                    $('.contPaginador').html($html.find('.contPaginador').html());
                } else {
                    $('#contenedorBloqueSolapa').after('<div class="contPaginador">'+$html.find('.contPaginador').html()+'</div>')
                }
                $html.find('.contPaginador').remove();
                ok = $html.html();
            }
            $('#listadoEventos').html(ok);
            asignarListener();
            centrar();
        },
        errro:function () {
            alert('Ocurrió un error, por favor inténtelo nuevamente.')
        }
    })
}
/* --- fin --- */


/* --- asignar listeners --- */
function asignarListener () {
    $('.paginador li a').click (function () {
        var pagina = $(this).attr('id').slice(7);
        $('#pagina').val(pagina);
        hacerPeticion();
        $('.paginador li a').removeClass('actual')
        $('.paginador li.cuadradoNumeroCaja a').eq(pagina-1).addClass('actual')
    })
}

function centrar(){
    var ancho = 0;
    $('.paginador li').each(function(){
        ancho += $(this).outerWidth(true);
    });
    $('.paginador').attr('style','margin:0 auto; width:'+ancho+'px;');
}