var dataTable, currentRow = 0;

$(document).ready(function () {
    dtInit();
    boxes();
    borrarModalInit();
    $('#left-panel li[data-nav="sponsors"]').addClass('active open').find('ul').show();
    $('#left-panel li[data-nav="sponsors-listado"]').addClass('active');
})

function dtInit () {
    dataTable = $('#nosApoyan').DataTable({
        processing: false,
        serverSide: true,
        stateSave: false,
        ajax: BASE_URL+'php/providers/nosApoyan.provider.php',
        language: dtLanguage,
        columns: [
            { 'data': 'nombre' },
            { 'data': 'categoria' },
            { 'data': 'acciones' }
        ],
        fnDrawCallback: function( oSettings ) {
            borrar();
        },
        columnDefs: [
            { 
                sortable: false,
                targets: 2
            }
            
        ],
       order: [[ 0, "asc" ]]
    });
}

function borrar () {
    var id;
    $('.borrarNosApoyan').click(function (event) {
        id = $(this).attr('data-id');
        event.preventDefault();
        borrarModalInit();
        $('#myModal').modal('show');
        $('#myModal #modalAction').click(function () {
            $('#myModal .modal-footer button').unbind('click');
            loaderModalInit();
            $.ajax({
                type:'post',
                url: BASE_URL+'php/controllers/borrarNosApoyan.controller.php',
                data:{id:id},
                success: function () {
                    
                    $('#myModal').modal('hide');
                    $('#row'+id).fadeOut(
                        500,
                        function () {
                            $('#row'+id).remove();
                            if ($('#nosApoyan tbody tr').length == 0) {
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
    $('#myModal #myModalLabel .text').html('Borrar Sponsor');
    $('#myModal #myModalLabel .jarviswidget-loader').hide();
    $('#myModal .modal-body').html('<p>¿Está seguro que desea borrar este sponsor?</p>');
    $('#myModal #modalAction').html('Borrar').addClass('btn-danger');
    $('#myModal .modal-footer button').attr('disabled', false);
}

function loaderModalInit () {
    $('#myModal #myModalLabel .jarviswidget-loader').show();
    $('#myModal .modal-body').html('<p>Por favor espere...</p>');
    $('#myModal .modal-footer button').attr('disabled', true);
}

function boxes () {
    if (document.location.hash == '#new') boxSuccess('El sponsor se cargó con éxito');
    if (document.location.hash == '#edit') boxSuccess('El sponsor se editó con éxito');
}