var imagesInOrder = false, superboxItem;

$(document).ready(function () {
    superboxItem = $('#superboxItem').val();
    $('#left-panel li[data-nav="jornadas"]').addClass('active');
    ajaxFileUpload();
    subcategoriasByCategoria();
    $('.images-upload').find('.superbox-list:hidden').show();
    $('.images-upload').sortable();
    $('.saveForm').click(function () {$('form:first').submit()})
    $('form:first').submit(function () {
        if (!imagesInOrder) {
            ordenarImagenes();
            return false
        } else {
            return true;
        }
    });
})

function forceUpload () {
    $('#mySubmit').trigger('click');
}


//IMAGENES

//cargar
function ajaxFileUpload () {
    var html, replacer = new Replacer();
    $('#imagesUploader').ajaxForm({
        beforeSend: function() {
            $('#images-uploader .widget-toolbar, #images-uploader .jarviswidget-loader').show();
        },
        uploadProgress: function(event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            $('#images-uploader .widget-toolbar .progress').attr('data-original-title', percentVal);
            $('#images-uploader .progress-bar').width(percentVal).html(percentVal);
        },
        success: function (data) {
            if (data) {
                html = superboxItem;
                html = replacer.listReplace(html, data);
                $('.images-upload').append(html).find('.superbox-list:hidden').fadeIn().find('a.btn-primary i').removeClass('fa-link').addClass('fa-comment');
            }
            $( '.images-upload' )
            .sortable( 'destroy' )
            .sortable({
                start: function(e, ui){
                    ui.placeholder.height(1);
                }
            });
            $('#images-uploader .widget-toolbar, #images-uploader .jarviswidget-loader').hide();
            $('#images-uploader .widget-toolbar .progress').attr('data-original-title', '0%');
            $('#images-uploader .progress-bar').width('0%').html('0%');
        }
    });
}

//ordenar
function ordenarImagenes () {
    var data = '', id;
    $('.images-upload .sortable').each(function (i) {
        data += '&orden[]='+i;
        data += '&id[]='+$(this).attr('data-id');
    })
    $.ajax({
        type:'POST',
        url:BASE_URL+'php/controllers/ordenar.controller.php',
        data: 'tabla=imagen'+data,
        success:function () {
            imagesInOrder = true;
            $('form:first').submit();
        }
    })    
}

//borrar
function borrarImagen (id) {
    borrarModalInit();
    $('#myModal').modal('show');
    $('#myModal #modalAction').unbind('click').click(function () {
        loaderModalInit();
        $.ajax({
            type:'post',
            url: BASE_URL+'php/controllers/borrarImagen.controller.php',
            data:{id:id},
            success: function () {
                $('#myModal').modal('hide');
                $('.sortable[data-id="'+id+'"]').fadeOut(
                    500,
                    function () {
                        $('.sortable[data-id="'+id+'"]').remove();
                    }
                )
                    
            }
        })
    })
}
//--FIN IMAGENES--

//subcategorias
function subcategoriasByCategoria (){
    $('#selectCategoria').change(function () {
        var id = $(this).val(),
            html='<option value="${id}">${contenido}</option>',
            replacer = new Replacer();
        $('#labelSubcategoria i').show();
        $.ajax({
            url: BASE_URL+'php/providers/subcategoriasByCategoria.provider.php',
            type: 'post',
            data: {categoria:id},
            success: function (response) {
                if (response.length) {
                    html = replacer.listReplace(html, response);
                } else {
                    html = '<option value="0">Elegir</optino>';
                }                
                $('#selectSubcategoria').html(html);
                $('#labelSubcategoria i').hide();
            }
        })
    })
}


//modals
function borrarModalInit () {
    $('#myModal #myModalLabel .text').html('Borrar Imagen');
    $('#myModal #myModalLabel .jarviswidget-loader').hide();
    $('#myModal .modal-body').html('¿Está seguro que desea borrar esta imagen?');
    $('#myModal #modalAction').html('Borrar').addClass('btn-danger');
    $('#myModal .modal-footer button').attr('disabled', false);
}

function loaderModalInit () {
    $('#myModal #myModalLabel .jarviswidget-loader').show();
    $('#myModal .modal-body').html('Por favor espere...');
    $('#myModal .modal-footer button').attr('disabled', true);
}