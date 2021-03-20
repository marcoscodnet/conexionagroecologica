var Paginador = {};
Paginador.printNumbers = function (cuantos, total, actual, totalNumeros) {
    cuantos = cuantos*1; total = total*1; actual = actual*1;
    totalNumeros = totalNumeros || 9;
    totalNumeros = totalNumeros*1;
    var i;
    var paginas = Math.ceil(total / cuantos);
    if (!total || paginas == 1) {return '';}
    var anterior = ((actual-10)>1)?(actual-10):(actual==1)?1:(actual-1);
    var siguiente = ((actual+10)<paginas)?(actual+10):(actual==paginas)?paginas:(actual+1);
    var html = '<div class="contPaginador"><ul class="paginador"><li><a href="javascript:void(0)" id="paginar1" class="botonPrimero">Primero</a></li>';
    html += '<li><a href="javascript:void(0)" id="paginar'+anterior+'" class="botonAnterior">Anterior</a></li>';
        
    //numeros dinamicos
    var mitad = Math.ceil(totalNumeros / 2);
    if ((actual-mitad) >= 1) {
        i = (actual-mitad);
        var hasta = ((actual+mitad) <= paginas)?(actual+mitad):paginas;
    } else {
        i=1;
        var menos = (isInt(totalNumeros / 2))?0:1;
        var resto = (mitad-actual) - menos;
        hasta = ((actual+resto+mitad) <= paginas)?(actual+resto+mitad):paginas;
    }
        
    for (; i<=hasta; i++) {
        var clase = (actual==i)?'actual':'';
        html += '<li class="cuadradoNumeroCaja"><a href="javascript:void(0)" class="cuadradoNumero '+clase+'"  id="paginar'+i+'">'+i+'</a></li>';
    }
    html += '<li><a href="javascript:void(0)" id="paginar'+siguiente+'" class="botonSiguiente">Siguiente</a></li>';
    html += '<li><a href="javascript:void(0)" id="paginar'+paginas+'" class="botonUltimo">&Uacute;ltimo</a></li>';
    html += '</ul>';
    html += '</div>';
    html += '<div class="clear"></div>';
    return html;
}
Paginador.printPrevnext = function (total, actual) {
    var html = '';
    if (total>1) {
        html += '<ul class="pager">';
        html += (actual>1)?'<li class="previous"><a href="javascript:void(0);" data-pagina="'+(actual-1)+'"><i class="icon-arrow-left"></i> Anterior</a></li>':'';
        html += (actual<total)?'<li class="next"><a href="javascript:void(0);" data-pagina="'+(actual+1)+'">Siguiente <i class="icon-arrow-right"></i></a></li>':'';
        html += '</ul>';
    }
    return html;
}

function isInt(n) {
   return typeof n === 'number' && n % 1 == 0;
}


/*
---NUMBERS---
<div class="pagination">
    <ul>
        <li><a href="#">�</a></li>
        <li class="active"><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">�</a></li>
    </ul>
</div>

---PREVNEXT---
<ul class="pager">
    <li class="previous"><a href="#"><i class="icon-arrow-left"></i> Anterior</a></li>
    <li class="next"><a href="#">Siguiente <i class="icon-arrow-right"></i></a></li>
</ul>
*/
