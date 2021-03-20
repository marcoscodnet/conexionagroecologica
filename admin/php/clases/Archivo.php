<?php
class Archivo{
    public static function leer($archi){
        $html=file_get_contents($archi);		
        return $html;
    }
}
?>