var dataTable, currentRow = 0;

$(document).ready(function () {
    dtInit();
    boxes();
    borrarModalInit();
    $('#left-panel li[data-nav="recicladores"]').addClass('active open').find('ul').show();
    $('#left-panel li[data-nav="recicladores-listado"]').addClass('active');
})

function dtInit () {
    dataTable = $('#recicladores').DataTable({
        processing: false,
        serverSide: true,
        stateSave: false,
        ajax: BASE_URL+'php/providers/recicladores.provider.php',
        language: dtLanguage,
        columns: [
            { 'data': 'nombre' },
            { 'data': 'web' },
            { 'data': 'email' },
            { 'data': 'acciones' }
        ],
        fnDrawCallback: function( oSettings ) {
            borrar();
        },
        columnDefs: [
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
    $('.borrarReciclador').click(function (event) {
        id = $(this).attr('data-id');
        event.preventDefault();
        borrarModalInit();
        $('#myModal').modal('show');
        $('#myModal #modalAction').click(function () {
            $('#myModal .modal-footer button').unbind('click');
            loaderModalInit();
            $.ajax({
                type:'post',
                url: BASE_URL+'php/controllers/borrarReciclador.controller.php',
                data:{id:id},
                success: function () {
                    
                    $('#myModal').modal('hide');
                    $('#row'+id).fadeOut(
                        500,
                        function () {
                            $('#row'+id).remove();
                            if ($('#recicladores tbody tr').length == 0) {
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
    $('#myModal #myModalLabel .text').html('Borrar Reciclador');
    $('#myModal #myModalLabel .jarviswidget-loader').hide();
    $('#myModal .modal-body').html('<p>¿Está seguro que desea borrar este reciclador?</p>');
    $('#myModal #modalAction').html('Borrar').addClass('btn-danger');
    $('#myModal .modal-footer button').attr('disabled', false);
}

function loaderModalInit () {
    $('#myModal #myModalLabel .jarviswidget-loader').show();
    $('#myModal .modal-body').html('<p>Por favor espere...</p>');
    $('#myModal .modal-footer button').attr('disabled', true);
}

function boxes () {
    if (document.location.hash == '#new') boxSuccess('El reciclador se cargó con éxito');
    if (document.location.hash == '#edit') boxSuccess('El creciclador se editó con éxito');
}