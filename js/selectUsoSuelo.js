$(document).ready(function() {	
	
    /*selects*/
    $('#usoSuelo').unbind('change').bind('change', function () {
        
        if ($(this).val() === '8') {
        	$('#spanOtroUsoSuelo').show();  
        }
        else {
        	$('#spanOtroUsoSuelo').hide();
        	$('#otro_uso_suelo').val('');
        }
    })
    
    $('#tipoUsoSuelo').unbind('change').bind('change', function () {
        
        if ($(this).val() === '4') {
        	$('#spanTipoOtroUsoSuelo').show();  
        }
        else {
        	$('#spanTipoOtroUsoSuelo').hide();
        	$('#otro_tipo_uso_suelo').val('');
        }
    })
    $('#usoSuelo').change(); 
    $('#tipoUsoSuelo').change(); 
})

