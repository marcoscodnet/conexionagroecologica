var 
    dataTable,
    currentRow = 0
;

$(document).ready(function () {
    dtInit();
  
    $('#left-panel li[data-nav="usuarioIntereses"]').addClass('active');
})

function dtInit () {
		dataTable = $('#usuarioIntereses').DataTable({
        processing: false,
        serverSide: true,
        stateSave: false,
        ajax: BASE_URL+'php/providers/usuarioIntereses.provider.php',
        language: dtLanguage,
        columns: [
            { 'data': 'updated_at' },
            { 'data': 'usuario' },
            { 'data': 'email' },
            { 'data': 'subcategorias' },
            { 'data': 'localidades' }
        ],
        
       order: [[ 0, "asc" ]]
    });
}







function loaderModalInit () {
    $('#myModal #myModalLabel .jarviswidget-loader').show();
    $('#myModal .modal-body').html('<p>Por favor espere...</p>');
    $('#myModal .modal-footer button').attr('disabled', true);
}

