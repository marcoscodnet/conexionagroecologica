<?php
$codigo = '';
$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
for($i=0;$i<32;$i++){
	$codigo .= substr($string,rand(0,62),1);
}
$c = new Codigo ();
$c->contenido = $codigo;
$c->save();
$n = md5($usuario->toString());

$html = '<p>Estimado/a '.$usuario->toString().':</p><p>	Este correo le est&aacute; llegando porque usted olvid&oacute; su contrase&ntilde;a y solicit&oacute; que el equipo de <strong>Conexi&oacute;n Reciclado</strong> le genere una nueva. Si no es as&iacute;, ignore este correo y elim&iacute;nelo inmediatamente.</p><p>En caso de que realmente haya olvidado su contrase&ntilde;a por favor haga click en el siguiente v&iacute;nculo</p><p><a href="'.RUTA.'recuperar-pass.php?iquest='.$codigo.'&n='.$n.'&m='.$usuario->codigo.'">Recuperar pass</a></p>';
?>