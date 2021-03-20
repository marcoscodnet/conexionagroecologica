<div id="contenedorBloqueSolapa">
    <div class="solapaVerdeTitulosBuscar">
        <div id="spriteBuscar"><p>Buscar - Seleccione subcategor&iacute;as para filtrar los resultados</p></div>
        <a href="como-comprar.php" class="comoVender">&iquest;c&oacute;mo comprar?</a>
        
    </div>
    <div class="clear"></div>
    <div class="contInfoBloques">
        <div class="contBuscadorComboBox">
            <form action="?" method="post" id="buscadorCombos">
               
                <div class="colBoxes">
                    <p><label for="precio">Hect&aacute;reas M&aacute;xima</label></p>
                    <p><input id='hectareaX' name='hectareaX' class="inputAncho" type="text"></p>
                    <p><label for="precio">Hect&aacute;reas M&iacute;nima</label></p>
                    <p><input id='hectareaY' name='hectareaY' class="inputAncho" type="text"></p>
                </div>
                <div class="colBoxes">
                    <p><label for="provincia">Provincia</label></p>
                    <?php echo ($provincia->toSelect()); ?>
                    <p><label for="localidad">Localidad</label></p>
                    <span id="localidadContenedor">
                        <select disabled="disabled">
                            <option value="" selected="selected">Localidades</option>
                        </select>
                    </span>
                </div>
                
                <div class="colBoxes">
                    <p><label for="provincia">Posibles uso del suelo</label></p>
                    <?php echo ($posibles->toCheckbox()); ?>
                    
                </div>
                
                <input type="hidden" id="fg" name="fg" value="<?php echo ((isset($_SESSION['codigoUsuario'])) ? $_SESSION['codigoUsuario'] : ''); ?>" />
                <input type="hidden" id="pagina" name="pagina" value="1" />
            </form>
        </div>
        <div class="clear"></div>
        <div class="contResultadosBusqueda">
            <div class="encabezadoBusqueda">
                <p>Resultados de la b&uacute;squeda:</p>
            </div>
            <div id="listarPropiedades"></div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="clear"></div>
</div>