var unidades = {
    'litros':'x litro', 
    'kilos':'x kilo', 
    'toneladas':'x tonelada', 
    'unidades':'x unidad', 
    'm2':'x m2', 
    'm3':'x m3'
};

$(document).ready(function() {
    $('#duracion-contrato').attr('disabled', 'disabled');
    $('#duracion-meses').attr('disabled', 'disabled');
    deshabilitarDetalle();
	
    var html = $('#unidad option:selected').html();
    var valor = $('#unidad option:selected').val();
    $('#unidad2 option').eq(1).html(unidades[html]);
    $('#unidad2 option').eq(1).val(valor);
	
    $('#selectEnContactoCon').change(function (){
        deshabilitarDetalle()
        });
	
    /*habilitar o deshabilitar periodo*/
    $('#frecuencia').change(function () {
        if ($(this).val() == 1) {
            $('#duracion-contrato').attr('disabled', 'disabled').val('');
            $('#duracion-meses').attr('disabled', 'disabled');
        } else {
            $('#duracion-contrato').removeAttr('disabled');
            $('#duracion-meses').removeAttr('disabled');
        }
    })
    /* --- fin --- */
	
    /*fijar unidad para el precio*/
    $('#unidad').change(function () {
        var html = $('#unidad option:selected').html();
        var valor = $('#unidad option:selected').val();
        $('#unidad2 option').eq(1).html(unidades[html]);
        $('#unidad2 option').eq(1).val(valor);
    })
    /* --- fin --- */
    
    $('input[name="tipo_precio"]').change(function () {
        if ($('input[name="tipo_precio"]:checked').length) {
            $('#precio, #unidad2').css({cursor:'pointer', 'background-color':'#ebebe4'}).attr('data-disabled', 'yes');
            $('input[name="sugerenciaPrecio"]').val("");
        }
    })
    $('#precio, #unidad2').click(function () {
        if ($(this).attr('data-disabled') == 'yes') {
            $('#precio, #unidad2').css({cursor:'default', 'background-color':'#fff'}).attr('data-disabled', 'no');
            $('input[name="tipo_precio"]:checked').attr('checked', false);
        }
    })
})

function deshabilitarDetalle () {
    if ($('#selectEnContactoCon').val() == 1) {
        $('#detalle').attr('disabled', 'disabled').val('');
    } else {
        $('#detalle').removeAttr('disabled');
    }
}