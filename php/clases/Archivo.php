<?php
class Archivo{
	public function leer($archi){
		$html=file_get_contents($archi);		
		return $html;
	}
}
?>