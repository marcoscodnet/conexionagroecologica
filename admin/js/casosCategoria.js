var dataTable, currentRow = 0;

$(document).ready(function () {
    dtInit();
    borrarModalInit();
    $('#left-panel li[data-nav="casos"]').addClass('active open').find('ul').show();
    $('#left-panel li[data-nav="casos-categorias"]').addClass('active');
})

function dtInit () {
    dataTable = $('#subcategorias').DataTable({
        processing: false,
        serverSide: true,
        stateSave: false,
        ajax: {
            url: BASE_URL+'php/providers/casosSubcategorias.provider.php',
            data: function ( d ) {
                d.id = $('#categoriaId').val();
            }
        },
        language: dtLanguage,
        columns: [
            { 'data': 'subcategoria' },
            { 'data': 'acciones' }
        ],
        fnDrawCallback: function( oSettings ) {
            cargar();
            editar();
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
    $('.agregarSubategoria').unbind('click').click(function (event) {
        event.preventDefault();
        editarModalInit();
        $('#myModal').modal('show');
       
        $('#modalAction').unbind('click').click(function () {
            data = $('#myModal form').serialize();
            $.ajax({
                type: 'POST',
                url: BASE_URL+'php/controllers/subcategoria.controller.php',
                data: data+'&categoriaId='+$('#categoriaId').val(),
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

//editar
function editar() {
    var data, id, $this;
    $('.editarSubcategoria').unbind('click').click(function(event) {
        event.preventDefault();
        $this = $(this);
        editarModalInit($(this).attr('data-value'));
        id = $(this).attr('data-id');
        $('#myModal').modal('show');
        $('#modalAction').unbind('click').click(function() {
            data = $('#myModal form').serialize();
            $.ajax({
                type: 'POST',
                url: BASE_URL + 'php/controllers/subcategoria.controller.php',
                data: data+'&id='+id+'&categoriaId='+$('#categoriaId').val(),
                beforeSend: function () {
                    loaderModalInit();
                },
                success: function(response) {
                    $this.parents('tr').find('td:first').html(response);
                    $this.attr('data-value', response);
                    $('#myModal').modal('hide');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert('El servidor no pudo procesar su petición, por favor inténtelo otra vez. Si el problema persiste contáctese con el administrador.');
                }
            })
        })
    })
}
//fin editar

//borrar
function borrar () {
    var id;
    $('.borrarSubcategoria').click(function (event) {
        id = $(this).attr('data-id');
        event.preventDefault();
        borrarModalInit();
        $('#myModal').modal('show');
        $('#myModal #modalAction').click(function () {
            $('#myModal .modal-footer button').unbind('click');
            loaderModalInit();
            $.ajax({
                type:'post',
                url: BASE_URL+'php/controllers/borrarSubcategoria.controller.php',
                data:{id:id},
                success: function (response) {
                    $('#myModal').modal('hide');
                    
                    if (response.success) { //si se puede borrar
                        $('#row'+id).fadeOut(
                            500,
                            function () {
                                $('#row'+id).remove();
                                if ($('#subcategorias tbody tr').length == 0) {
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
    $('#myModal #myModalLabel .text').html('Borrar Subcategoría');
    $('#myModal #myModalLabel .jarviswidget-loader').hide();
    $('#myModal .modal-body').html('<p>¿Está seguro que desea borrar esta subcategoría?</p>');
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
    $('#myModal #myModalLabel .text').html('Subcategoría');
    $('#myModal #myModalLabel .jarviswidget-loader').hide();
    $('#myModal .modal-body').html('<form class="smart-form"><label class="input"><input type="text" name="value" value="'+value+'" autofocus="autofocus" /></label></form>');
    $('#myModal #modalAction').html('Guardar').removeClass('btn-danger').addClass('btn-success');
    $('#myModal .modal-footer button').attr('disabled', false).show();
}