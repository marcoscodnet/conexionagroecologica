<div id="contenedorBloqueSolapa">
    <div class="solapaVerdeTitulos">
        <div id="spriteRecuperarPass"><p>Recuperar Clave</p></div>
    </div>
    <div class="clear"></div>
    <div class="contInfoBloques">
        <div class="texto">
            <p class="titulito" id="respuesta">Para completar el proceso de recuperaci&oacute;n de clave, por favor haga click en el siguiente v&iacute;nculo, y en breve le estar&aacute; llegando su nueva contrase&ntilde;a.<br />
            <a href="javascript:void(0)" id="generarPass">Generar nueva clave</a></p>
            <form action="?" method="post" id="datos" style="display:none">
            	<input type="hidden" name="iquest" value="<?php echo($_GET['iquest']); ?>" />
                <input type="hidden" name="m" value="<?php echo($_GET['m']); ?>" />
                <input type="hidden" name="n" value="<?php echo($_GET['n']); ?>" />
            </form>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>