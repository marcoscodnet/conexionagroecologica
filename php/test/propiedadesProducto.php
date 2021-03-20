<?php
include_once('../bootstrap.php');
$producto = Doctrine::getTable('producto')->find(5);
foreach ($producto->imagenes as $imagen) {
	echo ($imagen->ruta.'<br />');
}
?>