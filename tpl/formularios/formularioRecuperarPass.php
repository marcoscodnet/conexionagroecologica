<div id="contenedorBloqueSolapa">
    <div class="solapaVerdeTitulos">
        <div id="spriteRecuperarPass"><p>Recuperar Clave</p></div>
    </div>
    <div class="clear"></div>
    <div class="contInfoBloques formTemplate">
        <div class="texto camposContainer">
            <form action="php/controllers/recuperarPass.generarMail.controller.php" method="post" id="generarMail">
                <p><label for="lastName">E-mail: </label><input type="text" name="lastName" id="lastName" /></p>
                <p><img src="php/controllers/captcha.controller.php" /><br /> <br />
                    <label for="captcha">Ingrese el c&oacute;digo que aparece arriba:</label>
                    <input type="text" name="captcha" id="captcha"/></p>
                <p><input class="formBtnSprite btnAceptar" type="submit" name="enviador" value=" " id="enviarGenerarMail" /></p>
            </form>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>