$(document).ready(function() {	
    var $_GET = getUrlVars();
    if (($_GET['categoria'] != undefined)&&($_GET['categoria']!='')) {
        $('#selectCategoria option').eq($_GET['categoria']-1).attr('selected', 'selected');
    } else {
        $('#selectSubcategoria').prepend('<option value="" selected="selected">Subcategor&iacute;as</option>');
        $('#selectSubcategoria').attr('disabled', 'disabled');
		
        //Se agrego este if porque el atributo selected no es cross browser en Jquery
        if (navigator.appName == 'Microsoft Internet Explorer') {			
            var selectCategoria = document.getElementById('selectCategoria');
            var optionCategoria = document.createElement('option');
            optionCategoria.innerHTML = 'Cualquier Categor&iacute;a';
            optionCategoria.value = '';
            optionCategoria.selected = true;
            selectCategoria.insertBefore(optionCategoria);
        } else {
            $('#selectCategoria').prepend('<option value="" selected="selected">Cualquier Categor&iacute;a</option>');
        }
    }
	
    //Se agrego este if porque el atributo selected no es cross browser en Jquery
    if (navigator.appName == 'Microsoft Internet Explorer') {
        var selectProvincia = document.getElementById('selectProvincia');
        var optionProvincia = document.createElement('option');
        optionProvincia.innerHTML = 'Cualquier Provincia';
        optionProvincia.value = '';
        optionProvincia.selected = true;
        selectProvincia.insertBefore(optionProvincia);
    } else {
        $('#selectProvincia').prepend('<option value="" selected="selected">Cualquier Provincia</option>');
    }
	
    $('#selectCategoria').bind('change', function () {
        $('#selectSubcategoria option').eq(0).attr('selected', 'selected');
        var data = $('#buscadorCombos').serialize();
        hacerPeticion(data);
    })
	
    $('#selectProvincia').bind('change', function () {
        $('#selectLocalidad option').eq(0).attr('selected', 'selected');
        var data = $('#buscadorCombos').serialize();
        hacerPeticion(data);
    })
	
    $('#selectSubcategoria, #selectPrecio, #selectPeriodicidad').bind('change', function () {
        var data = $('#buscadorCombos').serialize();
        hacerPeticion(data);
    })
	
    var data = $('#buscadorCombos').serialize();
    //hacerPeticion(data);
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
function hacerPeticion (data) {
	
    $.ajax({
        type:'POST',
        url:'php/controllers/listarPropiedades.controller.php',
        data: data,
        beforeSend:function () {
            $('#listarPropiedades').html('<p style="clear:both; display:block; color:#000" class="titulito"><span>Procesando solicitud</span><br /><img src="images/loading.gif" /></p>');
        },
        success:function (ok) {
            if (ok == false) {
                ok = '<p style="color:#000;">La b&uacute;squeda no arraj&oacute; ning&uacute;n resultado.</p>'
                }
            $('#listarPropiedades').html(ok);
            asignarListener();
            centrar();
        },
        errro:function () {
            alert('Ocurrió un error, por favor inténtelo nuevamente.')
        }
    })
}
/* --- fin --- */


/* --- asignar listeners --- */
function asignarListener () {
    $('#selectSubcategoria, #selectLocalidad, #hectareaX, #hectareaY').unbind('change');
    $('#selectSubcategoria, #selectLocalidad, #hectareaX, #hectareaY').bind('change', function () {
        var data = $('#buscadorCombos').serialize();
        hacerPeticion(data);
    })
    $('.posibleCheck').bind('click', function () {
        var data = $('#buscadorCombos').serialize();
        hacerPeticion(data);
    })
    $('.btnCompartir').click(function () {
        var id = $(this).attr('id').slice(9);
        $.colorbox({
            href:"tpl/formularios/compartir.php?id="+id, 
            iframe:true, 
            innerWidth:400, 
            innerHeight:230
        })
        return false;
    })
    $('.paginador li a').click (function () {
        var pagina = $(this).attr('id').slice(7);
        $('#pagina').val(pagina);
        var data = $('#buscadorCombos').serialize();
        hacerPeticion(data);
    })
    if ($('#selectCategoria option:selected').val() == 0) {
        $('#selectSubcategoria option').eq(0).attr('selected', 'selected')
        $('#selectSubcategoria').attr('disabled', 'disabled')
    } else {
        $('#selectSubcategoria').removeAttr('disabled')
    }
    $('#pagina').val(1);
    seguir();
}

function centrar(){
    var ancho = 0;
    $('.paginador li').each(function(){
        ancho += $(this).outerWidth(true);
    });

    $('.paginador').attr('style','margin:0 auto; width:'+ancho+'px;');
}