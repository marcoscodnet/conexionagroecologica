<?php
session_start();
if (!isset($_SESSION) || !isset($_SESSION['logAdmin']) || $_SESSION['logAdmin'] != 'usuarioValidoAdmin') {
    session_destroy();
    header('location: '.URL.'login');
    exit();
}
?>