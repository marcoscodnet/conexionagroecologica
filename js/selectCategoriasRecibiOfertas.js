$(document).ready(function() {	
    /*select de categorias*/
    $('#selectCategoria').unbind('change').bind('change', function () {
        var data = $('#buscadorCombos').serialize();
        //hacerPeticion(data);
        if ($(this).val() !== '') {
            $.ajax({
                type:'POST',
                url:'php/controllers/subcategoriaSelectRecibiOfertas.controller.php',
                data: 'cat='+$(this).val(),
                success:function (ok) {
                    $('#subcategoriaContenedor').html(ok);
                    
                    if (sub = getParameterByName('subcategoria')) {
                        $('#subcategoriaContenedor select option').each(function () {
                            if ($(this).val() == sub) $(this).attr('selected', true);
                        })
                    }
                    
                    
                }
            })
        } else {
            $('#subcategoriaContenedor').html('<select disabled="disabled"><option value="">Todas</option></select>')
        }
    })
    /* --- fin --- */
    if (cat = getParameterByName('categoria')) {
        $('#selectCategoria option').each(function () {
            if ($(this).val() == cat) $(this).attr('selected', true);
        })
        $('#selectCategoria').change();
    } 
    
})

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}