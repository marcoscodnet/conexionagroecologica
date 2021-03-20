<?php
class FileImage {
	var $ruta;
	var $puntero;
	var $calidad;
	var $recortar;
	
	function __construct ($puntero) {
		$this->puntero = $puntero;
		$this->ruta = '';
		$this->calidad = 60;
		$this->recortar = true;
	}
	
	public function crear($nombre, $tamanio) {
		$nuevaImagen = $this->ruta.$nombre.'.jpg';
		$srcInfo = getimagesize($this->puntero['tmp_name']);
		switch($srcInfo[2]) {
			case 1: $imagen = imagecreatefromgif($this->puntero['tmp_name']); break;
			case 2: $imagen = imagecreatefromjpeg($this->puntero['tmp_name']); break;
			case 3: $imagen = imagecreatefrompng($this->puntero['tmp_name']); break;
		}
		if ($this->recortar == true) {
			if (imagesx($imagen) > imagesy($imagen)) {
				$dstAncho = round(imagesx($imagen) / (imagesy($imagen) / $tamanio));
				$dstAlto = $tamanio;
				$dstX = (($dstAncho - $tamanio) / 2) * -1;
				$dstY = 0;
			} else {
				$dstAncho = $tamanio;
				$dstAlto = round(imagesy($imagen) / (imagesx($imagen) / $tamanio));
				$dstX = 0;
				$dstY = (($dstAlto - $tamanio) / 2) * -1;
			}
			$detalle = imagecreatetruecolor($tamanio,$tamanio);
			imagecopyresampled($detalle,$imagen,$dstX,$dstY,0,0,$dstAncho,$dstAlto,imagesx($imagen),imagesy($imagen));
		} else {
			if($srcInfo[0]>$srcInfo[1]) {
				$det_w = $tamanio;
				$det_h = ($srcInfo[1]/$srcInfo[0])*$tamanio;
			} else {
				$det_w = ($srcInfo[0]/$srcInfo[1])*$tamanio;
				$det_h = $tamanio;
			}
			$detalle = imagecreatetruecolor($det_w,$det_h);
			imagecopyresampled($detalle,$imagen,0,0,0,0, $det_w,$det_h,imagesx($imagen),imagesy($imagen));
		}
		imagedestroy($imagen);
		imagejpeg($detalle,$nuevaImagen,$this->calidad);
		imagedestroy($detalle);
	}
}
?>