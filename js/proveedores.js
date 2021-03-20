$(document).ready(function() {	
    $('#selectCategoriaProveedor').bind('change', function () {
        $('#selectSubcategoriaProveedor option').eq(0).attr('selected', 'selected');
        hacerPeticion();
    })
    $('#selectProvincia').bind('change', function () {
        $('#selectLocalidad option').eq(0).attr('selected', 'selected');
        hacerPeticion();
    })
    $('#selectSubcategoriaProveedor, #selectLocalidad').bind('change', function () {
        hacerPeticion();
    })
    subcategoriasByCategoria();
    localidadesByProvincia();
    asignarListener();
    centrar();
})

//-------
function subcategoriasByCategoria (){
    $('#selectCategoriaProveedor').change(function () {
        var id = $(this).val(),
            html='',
            replacer = new Replacer();
        $.ajax({
            url: 'php/providers/subcategoriasProvByCategoria.provider.php',
            type: 'post',
            data: {categoria:id},
            success: function (response) {
                if (response.length) html = replacer.listReplace('<option value="${id}">${value}</option>', response);
                html = '<option value="0">Elegir</optino>'+html;          
                $('#selectSubcategoriaProveedor').html(html);
            }
        })
    })
}

function localidadesByProvincia (){
    $('#selectProvincia').change(function () {
        var id = $(this).val(),
            html='',
            replacer = new Replacer();
        $.ajax({
            url: 'php/providers/localidadesByProvincia.provider.php',
            type: 'post',
            data: {provincia:id},
            success: function (response) {
                if (response.length) html = replacer.listReplace('<option value="${id}">${contenido}</option>', response);
                html = '<option value="0">Elegir</optino>'+html;            
                $('#selectLocalidad').html(html);
            }
        })
    })
}
//------------------------------


/*hace el request al controller*/
function hacerPeticion () {
    var data = $('#buscadorCombos').serialize();
    $.ajax({
        type:'POST',
        url:'php/providers/proveedores.provider.php',
        data: data,
        beforeSend:function () {
            $('#listadoProveedores').html('<p style="clear:both; display:block; color:#000" class="titulito"><span>Procesando solicitud</span><br /><img src="images/loading.gif" /></p>');
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
            $('#listadoProveedores').html(ok);
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
    })
    $('#pagina').val(1);
}

function centrar(){
    var ancho = 0;
    $('.paginador li').each(function(){
        ancho += $(this).outerWidth(true);
    });
    $('.paginador').attr('style','margin:0 auto; width:'+ancho+'px;');
}