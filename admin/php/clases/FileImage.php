<?php
class FileImage {
    private $imgTemp;
    private $calidad;
    private $detalle;
    
    //estas variables se declaran como publicas porque pueden ser utiles para el
    //usuario recuparlas luego. En ocaciones (como por ejemplo en ajustarAlto)
    //no va a conocer de ante mano el ancho.
    var $alto;
    var $ancho;
    var $extension;

    function __construct ($puntero, $calidad=100) {
    	
        $this->calidad = $calidad;
        $srcInfo = getimagesize($puntero);
        switch($srcInfo[2]) {
            case 1:
                $this->imgTemp = imagecreatefromgif($puntero);
                $this->extension = 'gif';
            break;
            case 2:
                $this->imgTemp = imagecreatefromjpeg($puntero);
                $this->extension = 'jpg';
            break;
            case 3:
                $this->imgTemp = imagecreatefrompng($puntero);
                $this->extension = 'png';
            break;
        }
        $this->ancho = imagesx($this->imgTemp);
        $this->alto = imagesy($this->imgTemp);
    }
    
    //recibe un ancho y alto que representa el tama�o al que la imagen original va a ser cortada (no esclada)
    //el x e y forman el punto a partir del cual se comienza el recorte.
    //Se toma como 0,0 el angulo superiro izquierdo
    public function recortar ($x, $y, $ancho, $alto) {
        $this->ancho = $ancho;
        $this->alto = $alto;
        $this->detalle = imagecreatetruecolor($this->ancho, $this->alto);
        imagecopyresampled($this->detalle ,$this->imgTemp,0,0,$x,$y,$this->ancho,$this->alto,$this->ancho,$this->alto);
        $this->imgTemp = $this->detalle;
    }
    
    //funcina igual que recortar solo que el x e y se calculan atomaticamente
    //para que la imagen sea cortada desde el centro exacto
    public function recortarDesdeElCentro ($ancho, $alto) {
        $this->ancho = $ancho;
        $this->alto = $alto;
        $x = round((imagesx($this->imgTemp) / 2) - ($this->ancho / 2));
        $y = round((imagesy($this->imgTemp) / 2) - ($this->alto / 2));
        $this->recortar($x, $y, $this->ancho, $this->alto);
    }
    
    //recibe el alto al que la imagen se tiene que ajustar
    //el ancho se calcula proporcionalmente en realcion al alto dato
    public function ajustarAlto ($alto) {
        $this->alto = $alto;
        $this->ancho = round((imagesx($this->imgTemp)/imagesy($this->imgTemp))*$this->alto);
        $this->detalle = imagecreatetruecolor($this->ancho,$this->alto);
        imagecopyresampled($this->detalle,$this->imgTemp,0,0,0,0, $this->ancho,$this->alto,imagesx($this->imgTemp),imagesy($this->imgTemp));
        $this->imgTemp = $this->detalle;
    }
    
    //recibe el ancho al que la imagen se tiene que ajustar
    //el alto se calcula proporcionalmente en realcion al ancho dato
    public function ajustarAncho ($ancho) {
        $this->ancho = $ancho;
        $this->alto = round((imagesy($this->imgTemp)/imagesx($this->imgTemp))*$this->ancho);
        $this->detalle = imagecreatetruecolor($this->ancho,$this->alto);
        imagecopyresampled($this->detalle,$this->imgTemp,0,0,0,0, $this->ancho,$this->alto,imagesx($this->imgTemp),imagesy($this->imgTemp));
        $this->imgTemp = $this->detalle;
    }
    
    //recibe el tama�o mayor que la imagen debe tener en cualquiera de sus lados
    //se calcula cual es el lado mayor, se lo ajusta a esta medida
    //y el lado restante se ajusta proporcionalmente
    public function ajustarMayor ($tamanio) {
        if (imagesx($this->imgTemp) > imagesy($this->imgTemp)) {
            $this->ajustarAncho($tamanio);
        } else {
            $this->ajustarAlto($tamanio);
        }
    }
    
    //recibe el tama�o menor que la imagen debe tener en cualquiera de sus lados
    //se calcula cual es el lado menor, se lo ajusta a esta medida
    //y el lado restante se ajusta proporcionalmente
    public function ajustarMenor ($tamanio) {
        if (imagesx($this->imgTemp) < imagesy($this->imgTemp)) {
            $this->ajustarAncho($tamanio);
        } else {
            $this->ajustarAlto($tamanio);
        }
    }
    
    //recibe el ancho y el alto maximo que puede tener la imagen
    //segun la proporcion de la imagen original se ajusta uno de los dos lados y el otro se escala proporcionalmente
    //el resultado final es una imagen en donde alguno de sus lados es igual a uno de los parametros pasados
    //mientras que lado restante va a ser MENOR o igual al parametro restante
    public function escalar ($anchoMaximo, $altoMaximo) {        
        if ((imagesx($this->imgTemp) / imagesy($this->imgTemp)) > ($anchoMaximo / $altoMaximo)) {
            $this->ajustarAlto($altoMaximo);
        } else {
            $this->ajustarAncho($anchoMaximo);
        }
    }
    
    //recibe el ancho y el alto maximo que puede tener la imagen
    //segun la proporcion de la imagen original se ajusta uno de los dos lados y el otro se escala proporcionalmente
    //el resultado final es una imagen en donde alguno de sus lados es igual a uno de los parametros pasados
    //mientras que lado restante va a ser MAYOR o igual al parametro restante
    public function escalarMinimo ($anchoMaximo, $altoMaximo) {        
        if ((imagesx($this->imgTemp) / imagesy($this->imgTemp)) > ($anchoMaximo / $altoMaximo)) {
            $this->ajustarAncho($anchoMaximo);
        } else {
            $this->ajustarAlto($altoMaximo);
        }
    }
    
    function watermark ($watermar) {
        $estampa = imagecreatefrompng($watermar);
        $x = round((imagesx($this->imgTemp) / 2) - (imagesx($estampa) / 2));
        $y = round((imagesy($this->imgTemp) / 2) - (imagesy($estampa) / 2));
        imagecopy($this->imgTemp, $estampa, $x, $y, 0, 0, imagesx($estampa), imagesy($estampa));
    }
    
    public function save ($nombre, $ruta='') {
        $nuevaImagen = $ruta.$nombre.'.'.$this->extension;
        $resources = ($this->detalle)?$this->detalle:$this->imgTemp;
        if ($this->extension == 'jpg') {
            imagejpeg($resources,$nuevaImagen,$this->calidad);
        } else if ($this->extension == 'png') {
            imagepng($resources,$nuevaImagen,0);
        } else {
            imagegif($resources,$nuevaImagen);
        }
        @imagedestroy($this->detalle);
        @imagedestroy($this->imgTemp);
    }
}
?>