<?php
class Texto {
    public static function cortar ($texto, $largo, $final='') {
        if (strlen($texto) > $largo) {
            if (strrpos(substr($texto, 0, $largo), " ") !== 0) {
                $hasta = strrpos(substr($texto, 0,$largo), " ");
                $puntos = $final;
            } else {
                $hasta = $largo;
                $puntos = '';
            }
            $cortado = substr($texto, 0, $hasta);
            return $cortado.$puntos;
        } else {
            return $texto;
        }
    }
}
?>