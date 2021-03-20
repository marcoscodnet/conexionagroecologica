<?php
session_start();
include_once('../../../php/bootstrap.php');
if ($usuario = Usuario::isValido($_POST['usuario'], $_POST['pass'])) {
    if ($usuario->id == 2) {
        $_SESSION['logAdmin'] = 'usuarioValidoAdmin';
        header('location: ../../');
        exit();
    } else {
        session_destroy();
        header('location: ../../login');
        exit();
    }
} else {
    session_destroy();
    header('location: ../../login');
    exit();
}
?>
