<?php
//error_reporting(E_ALL);
// bootstrap.php

/**
 * Bootstrap Doctrine.php, register autoloader specify
 * configuration attributes and load models.
 */

require_once(dirname(__FILE__) . '/lib/vendor/doctrine/Doctrine.php');

//REGISTER AUTOLOADER
spl_autoload_register(array('Doctrine', 'autoload'));

//INSTANCIA UNICA DE DOCTRINE_MANAGER
$manager = Doctrine_Manager::getInstance();

$manager->setAttribute(Doctrine_Core::ATTR_AUTO_ACCESSOR_OVERRIDE, true);
$manager->setAttribute(Doctrine_Core::ATTR_AUTOLOAD_TABLE_CLASSES, true);

//CONECTAR SIN EL PDO
//$conn = Doctrine_Manager::connection('mysql://usrdbconrec:usrco3!Codnet@localhost/dbconrec','dbconrec');
$conn = Doctrine_Manager::connection('mysql://root:secyt@163.10.35.34/conexion_agroecologica','conexion_agroecologica');

Doctrine_Core::loadModels(dirname(__FILE__) .'/models');

?>
