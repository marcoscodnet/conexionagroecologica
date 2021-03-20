<?php
session_start();
include_once('../php/includes/comprobar.php');
?>
<form method="post" action="" enctype="application/x-www-form-urlencoded" id="formMensaje">
<p>Asunto: <input type="text" name="asunto" /></p>
<p>Mensaje:</p>
<textarea name="contenido"></textarea>
<p><a href="javascript:void(0)" id="enviadorMensaje">Enviar</a></p>
<input type="hidden" name="codigo" value="<?php echo($_SESSION['codigoUsuario']) ?>" />
<input type="hidden" name="articuloId" value="<?php echo($_GET['id']) ?>" />
</form>