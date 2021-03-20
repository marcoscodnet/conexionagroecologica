var dataTable, currentRow = 0;

$(document).ready(function () {
    dtInit();
    borrarModalInit();
    $('#left-panel li[data-nav="recicladores"]').addClass('active open').find('ul').show();
    $('#left-panel li[data-nav="recicladores-listaPrecios"]').addClass('active');
})

function dtInit () {
    dataTable = $('#listaPrecios').DataTable({
        processing: false,
        serverSide: true,
        stateSave: false,
        ajax: BASE_URL+'php/providers/recicladoresListaPrecios.provider.php',
        language: dtLanguage,
        columns: [
            { 'data': 'material' },
            { 'data': 'precio_kg' },
            { 'data': 'variacion_precio' },
            { 'data': 'variacion_porcentaje' },
			{ 'data': 'tipo' },
            { 'data': 'acciones' }
        ],
        fnDrawCallback: function( oSettings ) {
            borrar();
        },
        columnDefs: [
            { 
                sortable: false,
                targets: 5
            }
            
        ],
       order: [[ 0, "asc" ]]
    });
}

function borrar () {
    var id;
    $('.borrarListaPrecio').click(function (event) {
        id = $(this).attr('data-id');
        event.preventDefault();
        borrarModalInit();
        $('#myModal').modal('show');
        $('#myModal #modalAction').click(function () {
            $('#myModal .modal-footer button').unbind('click');
            loaderModalInit();
            $.ajax({
                type:'post',
                url: BASE_URL+'php/controllers/borrarListaPrecio.controller.php',
                data:{id:id},
                success: function () {
                    
                    $('#myModal').modal('hide');
                    $('#row'+id).fadeOut(
                        500,
                        function () {
                            $('#row'+id).remove();
                            if ($('#listaPrecios tbody tr').length == 0) {
                                dataTable.ajax.reload();
                            }
                        }
                    )
                    
                }
            })
        })
    })
}

function borrarModalInit () {
    $('#myModal #myModalLabel .text').html('Borrar Precio');
    $('#myModal #myModalLabel .jarviswidget-loader').hide();
    $('#myModal .modal-body').html('<p>¿Está seguro que desea borrar este precio?</p>');
    $('#myModal #modalAction').html('Borrar').addClass('btn-danger');
    $('#myModal .modal-footer button').attr('disabled', false);
}

function loaderModalInit () {
    $('#myModal #myModalLabel .jarviswidget-loader').show();
    $('#myModal .modal-body').html('<p>Por favor espere...</p>');
    $('#myModal .modal-footer button').attr('disabled', true);
}

function boxes () {
    if (document.location.hash == '#new') boxSuccess('El precio se cargó con éxito');
    if (document.location.hash == '#edit') boxSuccess('El precio se editó con éxito');
}