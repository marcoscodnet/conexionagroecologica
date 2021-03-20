<?php
include_once('../bootstrap.php');
if (Doctrine::getTable('newsletter')->findOneByEmail($_POST['email'])) {
	echo('repetido');
	exit();
} else {
	$newsletter = new Newsletter();
	$newsletter->email = $_POST['email'];
	$newsletter->save();
	echo('exito');
}
?>