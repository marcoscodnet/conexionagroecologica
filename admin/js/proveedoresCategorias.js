var dataTable, currentRow = 0;

$(document).ready(function () {
    dtInit();
    boxes();
    borrarModalInit();
    $('#left-panel li[data-nav="proveedores"]').addClass('active open').find('ul').show();
    $('#left-panel li[data-nav="proveedores-categorias"]').addClass('active');
})

function dtInit () {
    dataTable = $('#categorias').DataTable({
        processing: false,
        serverSide: true,
        stateSave: false,
        ajax: BASE_URL+'php/providers/proveedoresCategorias.provider.php',
        language: dtLanguage,
        columns: [
            { 'data': 'categoria' },
            { 'data': 'acciones' }
        ],
        fnDrawCallback: function( oSettings ) {
            cargar();
            borrar();
        },
        columnDefs: [
            { 
                sortable: false,
                targets: 1
            }
            
        ],
       order: [[ 0, "asc" ]]
    });
}

//cargar
function cargar () {
    var data;
    $('.agregarCategoria').unbind('click').click(function (event) {
        event.preventDefault();
        editarModalInit();
        $('#myModal').modal('show');
       
        $('#modalAction').unbind('click').click(function () {
            data = $('#myModal form').serialize();
            $.ajax({
                type: 'POST',
                url: BASE_URL+'php/controllers/categoriaProveedor.controller.php',
                data: data,
                beforeSend: function () {
                    loaderModalInit();
                },
                success: function () {
                    dataTable.ajax.reload();
                    $('#myModal').modal('hide');
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert('El servidor no pudo procesar su petición, por favor inténtelo otra vez. Si el problema persiste contáctese con el administrador.');
                }
            })
        })
    })
}
//fin cargar

//borrar
function borrar () {
    var id;
    $('.borrarCategoria').click(function (event) {
        id = $(this).attr('data-id');
        event.preventDefault();
        borrarModalInit();
        $('#myModal').modal('show');
        $('#myModal #modalAction').click(function () {
            $('#myModal .modal-footer button').unbind('click');
            loaderModalInit();
            $.ajax({
                type:'post',
                url: BASE_URL+'php/controllers/borrarCategoriaProveedor.controller.php',
                data:{id:id},
                success: function (response) {
                    $('#myModal').modal('hide');
                    
                    if (response.success) { //si se puede borrar
                        $('#row'+id).fadeOut(
                            500,
                            function () {
                                $('#row'+id).remove();
                                if ($('#categorias tbody tr').length == 0) {
                                    dataTable.ajax.reload();
                                }
                            }
                        )
                    } else { //si no se puede borrar
                        boxError(response.errorMessage)
                    }
                    
                }
            })
        })
    })
}
//fin borrar

function borrarModalInit () {
    $('#myModal #myModalLabel .text').html('Borrar Categoría');
    $('#myModal #myModalLabel .jarviswidget-loader').hide();
    $('#myModal .modal-body').html('<p>¿Está seguro que desea borrar esta categoría?</p>');
    $('#myModal #modalAction').html('Borrar').addClass('btn-danger');
    $('#myModal .modal-footer button').attr('disabled', false);
}

function loaderModalInit () {
    $('#myModal #myModalLabel .jarviswidget-loader').show();
    $('#myModal .modal-body').html('<p>Por favor espere...</p>');
    $('#myModal .modal-footer button').attr('disabled', true);
}

function editarModalInit (v) {
    var value = v || '';
    $('#myModal #myModalLabel .text').html('Categoría');
    $('#myModal #myModalLabel .jarviswidget-loader').hide();
    $('#myModal .modal-body').html('<form class="smart-form"><label class="input"><input type="text" name="value" value="'+value+'" autofocus="autofocus" /></label></form>');
    $('#myModal #modalAction').html('Guardar').removeClass('btn-danger').addClass('btn-success');
    $('#myModal .modal-footer button').attr('disabled', false).show();
}

function boxes () {
    if (document.location.hash == '#new') boxSuccess('La categoría se cargó con éxito');
    if (document.location.hash == '#edit') boxSuccess('La categoría se editó con éxito');
}