<div id="contenedorBloqueSolapa">
	
    <div class="solapaVerdeTitulosBuscar">
        <div id="spritePublicar"><p><?php echo($_GET['productor'])?'Productores':'Propietarios'; ?> registrados</p></div>
   		
     </div>    
        <div class="clear"></div>
    <div class="contInfoBloques">
        <div class="contBuscadorComboBox">
            <form action="?" method="post" id="buscadorCombos">
               
                
                <div class="colBoxes">
                    <p><label for="provincia">Provincia</label></p>
                    <?php echo ($provincia->toSelect()); ?>
                    <p><label for="localidad">Localidad</label></p>
                    <span id="localidadContenedor">
                        <select disabled="disabled" id="selectLocalidad" name="localidad">
                            <option value="" selected="selected">Localidades</option>
                        </select>
                    </span>
                </div>
                
                
                
                <input type="hidden" id="fg" name="fg" value="<?php echo ((isset($_SESSION['codigoUsuario'])) ? $_SESSION['codigoUsuario'] : ''); ?>" />
                <input type="hidden" id="pagina" name="pagina" value="1" />
            </form>
        </div>
        
        	
    <div class="clear"></div>
   <div id="listarMiConexion">
            </div>    
   
    
    
    <input type="hidden" name="codigo" id="codigo" value="<?php echo($_SESSION['codigoUsuario']); ?>" />
    <input type="hidden" name="productor" id="productor" value="<?php echo($_GET['productor']); ?>" />
   </div>
   
</div>
