$(document).ready(function() {	
	
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
   /* $('#selectProvincia').bind('change', function () {
        $('#selectLocalidad option').eq(0).attr('selected', 'selected');
        
        hacerPeticion();
    })*/
    
	hacerPeticion();
    
    $('select').live('change',function(){
    	hacerPeticion();
    	});
})



function hacerPeticion (pagina) {
	var p = (pagina)?pagina:1;
	$("#selectLocalidad").removeAttr("disabled");
	$.ajax({
		type:'POST',
		url:'php/controllers/listarUsuariosAdmin.controller.php',
		
		data: 'productor='+$('#productor').val()+'&pagina='+p+'&provincia='+$('#selectProvincia').val()+'&localidad='+$('#selectLocalidad').val(),
		cache: false,
		beforeSend:function () {
			$('#listarMiConexion').html('<p style="color:#000;">Procesando...</p>');
		},
		success:function (ok) {
			
			if (ok == false) {ok = '<p style="color:#000;">La b&uacute;squeda no arraj&oacute; ning&uacute;n resultado.</p>'}
			$('#listarMiConexion').html(ok);
			
			onAjaxComplete();
		},
		errro:function () {
			alert('Ocurrió un error, por favor inténtelo nuevamente.')
		}
	})
}

function onAjaxComplete () {
	//alert('entraaaaaaaaaaaaa');
	/*$('#selectLocalidad').unbind('change');
    $('#selectLocalidad').bind('change', function () {
        hacerPeticion();
    });*/
	
	$('.paginador li a').click (function () {
		$('.paginador li a').unbind('click');
		var pagina = $(this).attr('id').slice(7);
		hacerPeticion (pagina);
	});
	
	centrar();
    enviarMensaje();
    
	//seguir();
}




function centrar(){
   var ancho = 0;
   $('.paginador li').each(function(){
      ancho += $(this).outerWidth(true);
   });

   $('.paginador').attr('style','margin:0 auto; width:'+ancho+'px;');
 }
 
 function enviarMensaje () {
    $('#listarMiConexion a.btn.naranja').click(function (event) {
        event.preventDefault();
        $this = $(this);
        $.colorbox({href:$this.attr('href'), iframe:true, innerWidth:400, innerHeight:380});
    })
 }