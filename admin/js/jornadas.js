var 
    dataTable,
    currentRow = 0
;

$(document).ready(function () {
    dtInit();
    boxes();
    borrarModalInit();
    switchState();
    $('#left-panel li[data-nav="jornadas"]').addClass('active');
})

function dtInit () {
		dataTable = $('#jornadas').DataTable({
        processing: false,
        serverSide: true,
        stateSave: false,
        ajax: BASE_URL+'php/providers/jornadas.provider.php',
        language: dtLanguage,
        columns: [
            { 'data': 'titulo' },
            { 'data': 'blog' },
            { 'data': 'acciones' }
        ],
        fnDrawCallback: function( oSettings ) {
            borrar();
        },
       order: [[ 0, "asc" ]]
    });
}

function borrar () {
    var id;
    $('.borrarJornada').click(function (event) {
        id = $(this).attr('data-id');
        event.preventDefault();
        borrarModalInit();
        $('#myModal').modal('show');
        $('#myModal #modalAction').click(function () {
            $('#myModal .modal-footer button').unbind('click');
            loaderModalInit();
            $.ajax({
                type:'post',
                url: BASE_URL+'php/controllers/borrarJornada.controller.php',
                data:{id:id},
                success: function () {
                    
                    $('#myModal').modal('hide');
                    $('#row'+id).fadeOut(
                        500,
                        function () {
                            $('#row'+id).remove();
                            if ($('#jornadas tbody tr').length == 0) {
                                dataTable.ajax.reload();
                            }
                        }
                    )
                    
                }
            })
        })
    })
}

//switchState
function switchState () {
    $('#jornadas').on('click', '.switch-state[data-destacado]', function () {
        var id = $(this).attr('data-id'),
            destacado = ($(this) .attr('data-destacado')==1)?0:1;
        $(this).html(destacados[destacado]['text']).attr('class', '').addClass('switch-state label '+destacados[destacado]['labelClass']).attr('data-destacado', destacado);
        $.ajax({
            url:BASE_URL+'php/controllers/jornada.controller.php',
            type:'post',
            data:{id: id, destacado: destacado}
        })
    })
}
//fin switchState

function borrarModalInit () {
    $('#myModal #myModalLabel .text').html('Borrar Jornada');
    $('#myModal #myModalLabel .jarviswidget-loader').hide();
    $('#myModal .modal-body').html('<p>¿Está seguro que desea borrar esta Jornada T�cnica?</p>');
    $('#myModal #modalAction').html('Borrar').addClass('btn-danger');
    $('#myModal .modal-footer button').attr('disabled', false);
}

function loaderModalInit () {
    $('#myModal #myModalLabel .jarviswidget-loader').show();
    $('#myModal .modal-body').html('<p>Por favor espere...</p>');
    $('#myModal .modal-footer button').attr('disabled', true);
}

function boxes () {
    if (document.location.hash == '#new') boxSuccess('La Jornada T�cnica se cargó con éxito');
    if (document.location.hash == '#edit') boxSuccess('La Jornada T�cnica se editó con éxito');
}