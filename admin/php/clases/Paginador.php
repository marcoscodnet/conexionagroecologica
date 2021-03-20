<?php
class Paginador {
    public static function printNumbers ($cuantos, $total, $actual, $totalNumeros=8) {
        $paginas = ceil($total / $cuantos);
        if (!$total || $paginas == 1) {return '';}
        $anterior = ($actual==1)?1:($actual-1);
        $siguiente = ($actual==$paginas)?$paginas:($actual+1);
        
        $html = '<a href="" class="prev-posts" data-pagina="'.$anterior.'"><i class="fa fa-angle-left"></i></a>';
        $html .= '<a href="" class="next-posts" data-pagina="'.$siguiente.'"><i class="fa fa-angle-right"></i></a>';
        
        //numeros dinamicos
        $mitad = ceil($totalNumeros / 2);
        if (($actual-$mitad) >= 1) {
            $i = ($actual-$mitad);
            $hasta = (($actual+$mitad) <= $paginas)?($actual+$mitad):$paginas;
        } else {
            $i=1;
            $menos = (is_int($totalNumeros / 2))?0:1;
            $resto = ($mitad-$actual) - $menos;
            $hasta = (($actual+$resto+$mitad) <= $paginas)?($actual+$resto+$mitad):$paginas;
        }
        
        $html .= '<div class="pages">';
        for (; $i<=$hasta; $i++) {
            $clase = ($actual==$i)?'active':'';
            $html .= '<a class="'.$clase.'" href="#" data-pagina="'.$i.'">'.$i.'</a>';
        }
        $html .= '</div>';
        
        return $html;
    }
    public static function printPrevnext ($total, $actual) {
        $html = '';
        if ($total>1) {
            $html .= '<ul class="pager">';
            $html .= ($actual>1)?'<li class="previous"><a href="javascript:void(0);" data-pagina="'.($actual-1).'"><i class="icon-arrow-left"></i> Anterior</a></li>':'';
            $html .= ($actual<$total)?'<li class="next"><a href="javascript:void(0);" data-pagina="'.($actual+1).'">Siguiente <i class="icon-arrow-right"></i></a></li>':'';
            $html .= '</ul>';
        }
        return $html;
    }
}




/*
---NUMBERS---
<ul class="pagination pull-right">
    <li><a href="#">&laquo;</a></li>
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li><a href="#">&raquo;</a></li>
</ul>

---PREVNEXT---
<ul class="pager">
    <li class="previous"><a href="#"><i class="icon-arrow-left"></i> Anterior</a></li>
    <li class="next"><a href="#">Siguiente <i class="icon-arrow-right"></i></a></li>
</ul>
*/
?>