<?php
class Paginador {
	public static function crearNumeritos ($cuantos, $total, $accion, $actual) {
		$paginas = ceil($total / $cuantos);
		if (!$total || $paginas == 1) {return '';}
		$anterior = ($actual==1)?1:($actual-1);
		$siguiente = ($actual==$paginas)?$paginas:($actual+1);
                $html = '<div class="contPaginador">';
		$html .= '<ul class="paginador" id="'.$accion.'">';
		$html .= '<li><a href="javascript:void(0)" id="paginar1" class="botonPrimero">Primero</a></li>';
		$html .= '<li><a href="javascript:void(0)" id="paginar'.$anterior.'" class="botonAnterior">Anterior</a></li>';
		for ($i=1; $i<=$paginas; $i++) {
			$clase = ($actual==$i)?'actual':'';
			$html .= '<li class="cuadradoNumeroCaja"><a href="javascript:void(0)" class="cuadradoNumero '.$clase.'"  id="paginar'.$i.'">'.$i.'</a></li>';
		}
		$html .= '<li><a href="javascript:void(0)" id="paginar'.$siguiente.'" class="botonSiguiente">Siguiente</a></li>';
		$html .= '<li><a href="javascript:void(0)" id="paginar'.$paginas.'" class="botonUltimo">&Uacute;ltimo</a></li>';
		$html .= '</ul>';
                $html .= '</div>';
		$html .= '<div class="clear"></div>';
		return $html;
	}
}
?>