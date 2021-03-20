$(document).ready(function () {
    $('#left-panel li[data-nav="proveedores"]').addClass('active');
    subcategoriasByCategoria();
    localidadesByProvincia();
    $('.saveForm').click(function () {$('form:first').submit()})
})


//-------
function subcategoriasByCategoria (){
    $('#selectCategoriaProveedor').change(function () {
        var id = $(this).val(),
            html='<option value="${id}">${value}</option>',
            replacer = new Replacer();
        $('#labelSubcategoria i').show();
        $.ajax({
            url: BASE_URL+'php/providers/subcategoriasProvByCategoria.provider.php',
            type: 'post',
            data: {categoria:id},
            success: function (response) {
                if (response.length) {
                    html = replacer.listReplace(html, response);
                } else {
                    html = '<option value="0">Elegir</optino>';
                }                
                $('#selectSubcategoriaProveedor').html(html);
                $('#labelSubcategoria i').hide();
            }
        })
    })
}

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