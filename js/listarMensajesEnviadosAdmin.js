$(document).ready(function() {	
    var codigo = $('#codigo').val();
    var accion = 'listarMensajesEnviados';
    hacerPeticion(codigo, accion);	
})

/*hace el request al controller*/
function hacerPeticion (codigo, accion, pagina) {
    var p = (pagina)?pagina:1;
    $.ajax({
        type:'POST',
        url:'php/controllers/listarMensajes.controller.php',
        data: 'codigo='+codigo+'&accion='+accion+'&pagina='+p,
        beforeSend:function () {
            $('#listarMiConexion').html('<p style="color:#000;">Cargando...</p>');
        },
        success:function (ok) {
            if (ok == false) {
                ok = '<p style="color:#000;">Esta casilla se encuentra vac&iacute;a.</p>'
            }
            $('#listarMiConexion').html(ok);
            asignarListener();
        },
        errro:function () {
            alert('Ocurrió un error, por favor inténtelo nuevamente.')
        }
    })
}
/* --- fin --- */


/* --- asignar listeners --- */
function asignarListener () {
    var codigo = $('#codigo').val();
    $('.btnMensaje').click(function () {
        var id = $(this).attr('id').slice(7); 
        $.colorbox({
            href:"tpl/leerMensaje.php?id="+id, 
            iframe:true, 
            innerWidth:400, 
            innerHeight:350
        })
        return false;
    })
    $('.btnMensajeSimple').click(function () {
        var id = $(this).attr('id').slice(7); 
        $.colorbox({
            href:"tpl/leerMensaje.php?id="+id, 
            iframe:true, 
            innerWidth:400, 
            innerHeight:350
        })
        return false;
    })
    //borrar mensaje por el dueño
    $('.btnBorrar').click(function () {
        var id = $(this).attr('id').slice(7); 
        $.colorbox({
            href:'tpl/mensajes/borrarMensaje.confirm.php?id='+id+'&controller=borrarMensajeEmisor', 
            iframe:true, 
            innerWidth:400, 
            innerHeight:220
        })
        return false;
    })
    $('.paginador li a').click (function () {
        var accion = $('.paginador').attr('id');
        var pagina = $(this).attr('id').slice(7);
        hacerPeticion (codigo, accion, pagina);
    })
    centrar();
}
function centrar(){
    var ancho = 0;
    $('.paginador li').each(function(){
        ancho += $(this).outerWidth(true);
    });

    $('.paginador').attr('style','margin:0 auto; width:'+ancho+'px;');
}