<?php
include_once('../bootstrap.php');
$idProvincia = (isset($_GET['p']))?$_GET['p']:'1';
$provincias = Doctrine::getTable('provincia')->findAll();
$provincia = Doctrine::getTable('provincia')->find($idProvincia);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<form action="?" method="get">
<select name="p">
<?php
	foreach ($provincias as $prov) {
		echo ('<option value="'.$prov->id.'">'.$prov->contenido.'</option>');
	}
?>
</select>
<select name="l">
<?php
	foreach ($provincia->localidades as $localidad) {
		echo ('<option value="'.$localidad->id.'">'.$localidad->contenido.'</option>');
	}
?>
</select>
<input type="submit" value="Enviar" />
</form>
</body>
</html>