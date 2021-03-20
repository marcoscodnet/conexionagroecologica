var 
    dataTable,
    currentRow = 0,
    activos = [
        {value:0, text:'No', labelClass:'label-danger'},
        {value:1, text:'Si', labelClass:'label-success'}
    ]
;

$(document).ready(function () {
    dtInit();
    boxes();
    borrarModalInit();
    switchState();
    $('#left-panel li[data-nav="popups"]').addClass('active');
})

function dtInit () {
	dataTable = $('#popups').DataTable({
        processing: false,
        serverSide: true,
        stateSave: false,
        ajax: BASE_URL+'php/providers/popups.provider.php',
        language: dtLanguage,
        columns: [
            { 'data': 'titulo' },
            { 'data': 'ruta' },
            { 'data': 'popup_activo' },
            { 'data': 'acciones' }
        ],
        fnDrawCallback: function( oSettings ) {
            borrar();
        },
        columnDefs: [
            {
                render: function ( data, type, row ) { //activo
                    return '<span data-id="'+row['id']+'" data-activo="'+row['popup_activo']+'" class="switch-state label '+activos[row['popup_activo']*1]['labelClass']+'">'+activos[row['popup_activo']*1]['text']+'</span>';
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
    $('.borrarPopup').click(function (event) {
        id = $(this).attr('data-id');
        event.preventDefault();
        borrarModalInit();
        $('#myModal').modal('show');
        $('#myModal #modalAction').click(function () {
            $('#myModal .modal-footer button').unbind('click');
            loaderModalInit();
            $.ajax({
                type:'post',
                url: BASE_URL+'php/controllers/borrarPopup.controller.php',
                data:{id:id},
                success: function () {
                    
                    $('#myModal').modal('hide');
                    $('#row'+id).fadeOut(
                        500,
                        function () {
                            $('#row'+id).remove();
                            if ($('#popups tbody tr').length == 0) {
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
    $('#popups').on('click', '.switch-state[data-activo]', function () {
        var id = $(this).attr('data-id'),
            activo = ($(this) .attr('data-activo')==1)?0:1;
        $(this).html(activos[activo]['text']).attr('class', '').addClass('switch-state label '+activos[activo]['labelClass']).attr('data-activo', activo);
        $.ajax({
            url:BASE_URL+'php/controllers/popup.controller.php',
            type:'post',
            data:{id: id, activo: activo}
        })
    })
}
//fin switchState

function borrarModalInit () {
    $('#myModal #myModalLabel .text').html('Borrar Popup');
    $('#myModal #myModalLabel .jarviswidget-loader').hide();
    $('#myModal .modal-body').html('<p>Â¿EstÃ¡ seguro que desea borrar este Popup?</p>');
    $('#myModal #modalAction').html('Borrar').addClass('btn-danger');
    $('#myModal .modal-footer button').attr('disabled', false);
}

function loaderModalInit () {	alert("aaa");
    $('#myModal #myModalLabel .jarviswidget-loader').show();
    $('#myModal .modal-body').html('<p>Por favor espere...</p>');
    $('#myModal .modal-footer button').attr('disabled', true);
}

function boxes () {
    if (document.location.hash == '#new') boxSuccess('El Popup se cargÃ³ con Ã©xito');
    if (document.location.hash == '#edit') boxSuccess('El Popup se editÃ³ con Ã©xito');
}