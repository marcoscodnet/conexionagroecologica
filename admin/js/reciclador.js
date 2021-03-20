$(document).ready(function () {
    $('#left-panel li[data-nav="recicladores"]').addClass('active');
    localidadesByProvincia();
    subcategorias();
    $('.saveForm').click(function () {$('form:first').submit()})
})


//localidades by provincia
function localidadesByProvincia (){
    $('#selectProvincia').change(function () {
        var id = $(this).val(),
            html='<option value="${id}">${contenido}</option>',
            replacer = new Replacer();
        $('#labelLocalidad i').show();
        $.ajax({
            url: BASE_URL+'php/providers/localidadesByProvincia.provider.php',
            type: 'post',
            data: {provincia:id},
            success: function (response) {
                if (response.length) {
                    html = replacer.listReplace(html, response);
                } else {
                    html = '<option value="0">Elegir</optino>';
                }                
                $('#selectLocalidad').html(html);
                $('#labelLocalidad i').hide();
            }
        })
    })
}
//------------------------------

//subcategorias
function subcategorias () {
    var cache = {}
    $('#subcategorias').tagsInput({
        autocomplete_url: BASE_URL+'php/controllers/autocomplete.controller.php',
        autocomplete:{
            minLength: 2,
            source: function( request, response ) {
                var term = request.term;
                if ( term in cache ) {
                    response( cache[ term ] );
                    return;
                }
                $.getJSON( BASE_URL+'php/controllers/autocomplete.controller.php', request, function( data, status, xhr ) {
                    cache[ term ] = data;
                    response( data );
                })
            },
            appendTo: '#myAutocompleContainer'
        },
        height:'80px',
        width:'99%',
        defaultText: '',
        delimiter:'|',
        onAddTag: function () {
            $('#subcategorias_tag').autocomplete( "close" )
        }
    })
}
//------------------------------
function verificar(tipo) {
	var rango = (tipo.id=='latitud')?90:180;
	if((!$.isNumeric($(tipo).val()))||(($(tipo).val()<-rango)&&($(tipo).val()>rango))){
		alert(tipo.id +' debe ser numerico dentro del rango -'+rango+', '+rango);
		//var value ="Rango correcto: -"+rango+", "+rango;
		$(tipo).val(0.0);
		$(tipo).focus();
	}
	
}