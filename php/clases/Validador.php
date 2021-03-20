<?php
class Validador {
        public static function validarTexto ($texto) {
                //if (preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑçÇäëïöüÄËÍÖÜ]+( )*[a-zA-ZáéíóúÁÉÍÓÚñÑçÇäëïöüÄËÍÖÜ]*$/', $texto)) {
				if (preg_match('/^[a-záéíóúñüàè\s]*$/i', $texto)) {
                        return true;
                } else {
                        return false;
                }
        }
        
        public static function validarNumero ($texto) {
                if (preg_match('/^[0-9]*$/', $texto)) {
                        return true;
                } else {
                        return false;
                }
        }
        
        public static function validarPrecio ($texto) {
                if (preg_match('/^[0-9]+\.?[0-9]{0,2}$/', $texto)) {
                        return true;
                } else {
                        return false;
                }
        }
        
        public static function validarTextoYNumero ($texto) {
               // if (preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑçÇäëïöüÄËÍÖÜ]+( )*[a-zA-Z0-9áéíóúÁÉÍÓÚñÑçÇäëïöüÄËÍÖÜ]*$/', $texto)) {
				if (preg_match('/^[a-záéíóúñüàè0-9\s]*$/i', $texto)) {
                        return true;
                } else {
                        return false;
                }
        }
        
        public static function validarEmail($texto) {
                if (preg_match('/^[a-zA-Z]+([\.]?[a-zA-Z0-9_-]+)*@[a-zAZ]+([\.-]+[a-zA-Z0-9]+)*/', $texto)) {
                        return true;
                } else {
                        return false;
                }
        }
}
?>