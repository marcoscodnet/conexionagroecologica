<?php
include_once('../clases/FileImage.php');
include_once('../includes/defined.php');
if (isset($_FILES['img'])) {
	$imagen = new FileImage ($_FILES['img']);
	$imagen->ruta = 'C:\\wamp\\www\\davinci\\conexionReciclado\\php\\test\\';
	$imagen->crear('myImagen', 330);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<form action="?" method="post" enctype="multipart/form-data">
<p>Imagen: <input type="file" name="img" /></p>
<input type="submit" value="Enviar" />
</form>
</body>
</html>