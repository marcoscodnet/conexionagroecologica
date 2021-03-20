var 
    dataTable,
    currentRow = 0,
    destacados = [
        {value:0, text:'No', labelClass:'label-danger'},
        {value:1, text:'Si', labelClass:'label-success'}
    ]
;

$(document).ready(function () {
    dtInit();
    boxes();
    borrarModalInit();
    switchState();
    $('#left-panel li[data-nav="casos"]').addClass('active open').find('ul').show();
    $('#left-panel li[data-nav="casos-listado"]').addClass('active');
})

function dtInit () {
    dataTable = $('#casos').DataTable({
        processing: false,
        serverSide: true,
        stateSave: false,
        ajax: BASE_URL+'php/providers/casos.provider.php',
        language: dtLanguage,
        columns: [
            { 'data': 'titulo' },
            { 'data': 'ubicacion' },
            { 'data': 'destacado' },
            { 'data': 'acciones' }
        ],
        fnDrawCallback: function( oSettings ) {
            borrar();
        },
        columnDefs: [
            {
                render: function ( data, type, row ) { //destacado
                    return '<span data-id="'+row['id']+'" data-destacado="'+row['destacado']+'" class="switch-state label '+destacados[row['destacado']*1]['labelClass']+'">'+destacados[row['destacado']*1]['text']+'</span>';
                },
                targets: 2
            },
            { 
                sortable: false,
                targets: 3
            }
            
        ],
       order: [[ 0, "asc" ]]
    });
}

function borrar () {
    var id;
    $('.borrarCaso').click(function (event) {
        id = $(this).attr('data-id');
        event.preventDefault();
        borrarModalInit();
        $('#myModal').modal('show');
        $('#myModal #modalAction').click(function () {
            $('#myModal .modal-footer button').unbind('click');
            loaderModalInit();
            $.ajax({
                type:'post',
                url: BASE_URL+'php/controllers/borrarCaso.controller.php',
                data:{id:id},
                success: function () {
                    
                    $('#myModal').modal('hide');
                    $('#row'+id).fadeOut(
                        500,
                        function () {
                            $('#row'+id).remove();
                            if ($('#casos tbody tr').length == 0) {
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
    $('#casos').on('click', '.switch-state[data-destacado]', function () {
        var id = $(this).attr('data-id'),
            destacado = ($(this) .attr('data-destacado')==1)?0:1;
        $(this).html(destacados[destacado]['text']).attr('class', '').addClass('switch-state label '+destacados[destacado]['labelClass']).attr('data-destacado', destacado);
        $.ajax({
            url:BASE_URL+'php/controllers/caso.controller.php',
            type:'post',
            data:{id: id, destacado: destacado}
        })
    })
}
//fin switchState

function borrarModalInit () {
    $('#myModal #myModalLabel .text').html('Borrar Caso');
    $('#myModal #myModalLabel .jarviswidget-loader').hide();
    $('#myModal .modal-body').html('<p>¿Está seguro que desea borrar este caso de conexión?</p>');
    $('#myModal #modalAction').html('Borrar').addClass('btn-danger');
    $('#myModal .modal-footer button').attr('disabled', false);
}

function loaderModalInit () {
    $('#myModal #myModalLabel .jarviswidget-loader').show();
    $('#myModal .modal-body').html('<p>Por favor espere...</p>');
    $('#myModal .modal-footer button').attr('disabled', true);
}

function boxes () {
    if (document.location.hash == '#new') boxSuccess('El caso de conexión se cargó con éxito');
    if (document.location.hash == '#edit') boxSuccess('El caso de conexión se editó con éxito');
}