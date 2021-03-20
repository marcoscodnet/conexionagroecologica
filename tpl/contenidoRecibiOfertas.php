<div id="contenedorBloqueSolapa">
    <div class="solapaVerdeTitulosBuscar">
        <div id=""><p>Recib&iacute; ofertas de tu inter&eacute;s - Seleccioná subcategor&iacute;as y/o provincias y presioná Enviar.</p></div>
        
        
    </div>
    <div class="clear"></div>
    <div class="contInfoBloques">
        <div class="contBuscadorComboBox">
            <form action="?" method="post" id="buscadorCombos">
                <div class="colBoxes">
                    <p><label for="categoria">Categor&iacute;a</label></p>
                    <?php echo ($categoria->toSelect()); ?>
                    <p><label for="subcategoria">Sub-Categor&iacute;a</label></p>
                    <span id="subcategoriaContenedor">
                        <select disabled="disabled">
                            <option value="" selected="selected">Subcategorias</option>
                        </select>
                    </span>
                </div>
               
                <div class="colBoxes">
                    <p><label for="provincia">Provincia</label></p>
                    <?php echo ($provincia->toSelect()); ?>
                   <!--  <p><label for="localidad">Localidad</label></p>
                    <span id="localidadContenedor">
                        <select disabled="disabled">
                            <option value="" selected="selected">Localidades</option>
                        </select>
                    </span>-->
                </div>
                <div class="colBoxesEnviar">
                <a href="#" class="botonesRecibiOfertas btnEnviar" id="btnEnviarLocalidades">Aceptar</a>
				<a href="#" class="botonesRecibiOfertas btnVaciar" id="btnVaciarLocalidades">Vaciar</a>
                </div>
                <input type="hidden" id="fg" name="fg" value="<?php echo ((isset($_SESSION['codigoUsuario'])) ? $_SESSION['codigoUsuario'] : ''); ?>" />
                <input type="hidden" id="pagina" name="pagina" value="1" />
            </form>
        </div>
        <div class="clear"></div>
        <div class="contResultadosBusqueda">
            <div class="encabezadoBusqueda">
                <p>Sub-categor&iacute;as y provincias asignadas:</p>
            </div>
            <div id="listarSubcategoria"></div>
         
            <div class="clear"></div>
        </div>
    </div>
    <div class="clear"></div>
</div>