$(document).ready(function() {	
	/*$('#btnEnviarSubcategorias').unbind('click').click(function (event) {
		event.preventDefault();
		hacerPeticion(1);
	})*/
	$('#btnEnviarLocalidades').unbind('click').click(function (event) {
		event.preventDefault();
		hacerPeticion(2);
		
	})
    
    $('#btnVaciarLocalidades').unbind('click').click(function (event) {
		event.preventDefault();
		borrar(0,0);
	})    
		
        //Se agrego este if porque el atributo selected no es cross browser en Jquery
        if (navigator.appName == 'Microsoft Internet Explorer') {			
            var selectCategoria = document.getElementById('selectCategoria');
            var optionCategoria = document.createElement('option');
            optionCategoria.innerHTML = 'Todas';
            optionCategoria.value = '';
            optionCategoria.selected = true;
            selectCategoria.insertBefore(optionCategoria);
            var selectCategoria = document.getElementById('selectCategoria');
            var optionCategoria = document.createElement('option');
            optionCategoria.innerHTML = 'Ninguna';
            optionCategoria.value = '-1';
            optionCategoria.selected = true;
            selectCategoria.insertBefore(optionCategoria);
        } else {
            $('#selectCategoria').prepend('<option value="" selected="selected">Todas</option>');
            $('#selectCategoria').prepend('<option value="-1" selected="selected">Ninguna</option>');
        }
   
	
    //Se agrego este if porque el atributo selected no es cross browser en Jquery
    if (navigator.appName == 'Microsoft Internet Explorer') {
    	var selectProvincia = document.getElementById('selectProvincia');
        var optionProvincia = document.createElement('option');
        optionProvincia.innerHTML = 'Todas';
        optionProvincia.value = '';
        optionProvincia.selected = true;
        selectProvincia.insertBefore(optionProvincia);
    	var selectProvincia = document.getElementById('selectProvincia');
        var optionProvincia = document.createElement('option');
        optionProvincia.innerHTML = 'Ninguna';
        optionProvincia.value = '-1';
        optionProvincia.selected = true;
        selectProvincia.insertBefore(optionProvincia);
        
    } else {
    	
        $('#selectProvincia').prepend('<option value="" selected="selected">Todas</option>');
        $('#selectProvincia').prepend('<option value="-1" selected="selected">Ninguna</option>');
    }
	
    $('#selectCategoria').bind('change', function () {
        $('#selectSubcategoria option').eq(0).attr('selected', 'selected');
        
    })
	
    $('#selectProvincia').bind('change', function () {
        $('#selectLocalidad option').eq(0).attr('selected', 'selected');
        
    })
	
    mostrarContenido ();
})

/*obtiene los valores de las variables get*/
function getUrlVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}
/* --- fin --- */

/*hace el request al controller*/
function hacerPeticion (tipo) {
	
	var data = $('#buscadorCombos').serialize();
	$.ajax({
        type:'POST',
        url:'php/controllers/cargarUsuarioIntereses.controller.php',
        data: data+'&tipo='+tipo,
        beforeSend:function () {
            $('#listarSubcategoria').html('<p style="clear:both; display:block; color:#000" class="titulito"><span>Procesando solicitud</span><br /><img src="images/loading.gif" /></p>');
        },
        success:function (ok) {
        	 mostrarContenido();
            
        },
        error:function () {
            alert('Ocurrió un error, por favor inténtelo nuevamente.')
        }
    })
    
    
}

function mostrarContenido () {
	
	$.ajax({
        type:'POST',
        url:'php/controllers/listarSubcategorias.controller.php',
		data: 'codigo='+$('#fg').val(),
        beforeSend:function () {
            $('#listarSubcategoria').html('<p style="clear:both; display:block; color:#000" class="titulito"><span>Procesando solicitud</span><br /><img src="images/loading.gif" /></p>');
        },
        success:function (ok) {
        	 if (ok == false) {
                 ok = '<p style="color:#000;">La b&uacute;squeda no arraj&oacute; ning&uacute;n resultado.</p>'
                 }
             $('#listarSubcategoria').html(ok);
             asignarListener();
            
        },
        error:function () {
            alert('Ocurrió un error, por favor inténtelo nuevamente.')
        }
    })
    
    
}

function borrar (id, tabla) {
	
	if(confirm('Esta seguro?')){
		$.ajax({
	        type:'POST',
	        url:'php/controllers/borrarUsuarioIntereses.controller.php',
	        data: 'codigo='+$('#fg').val()+'&id='+id+'&tabla='+tabla,
	        beforeSend:function () {
	            $('#listarSubcategoria').html('<p style="clear:both; display:block; color:#000" class="titulito"><span>Procesando solicitud</span><br /><img src="images/loading.gif" /></p>');
	        },
	        success:function (ok) {
	        	 mostrarContenido();
	            
	        },
	        error:function () {
	            alert('Ocurrió un error, por favor inténtelo nuevamente.')
	        }
	    })
	}
    
    
}
/* --- fin --- */


/* --- asignar listeners --- */
function asignarListener () {
	
   
    
    if ($('#selectCategoria option:selected').val() == 0) {
        $('#selectSubcategoria option').eq(0).attr('selected', 'selected')
        $('#selectSubcategoria').attr('disabled', 'disabled')
    } else {
        $('#selectSubcategoria').removeAttr('disabled')
    }
    
    //seguir();
}

