<div id="contenedorBloqueSolapa">
    <div class="solapaVerdeTitulosBuscar">
        <div id=""><p>Casos de conexi&oacute;n</p></div>
    </div>
    <div class="clear"></div>
    <div class="contInfoBloques">
        <div class="contBuscadorComboBox" style="height: 85px">
            <form action="?" method="post" id="buscadorCombos">
                
                <div class="colBoxes">
                    <p><label for="selectUbicacion">Categor&iacute;a</label></p>
                    ${ubicacionToSelect}
                </div>
                <input type="hidden" id="pagina" name="pagina" value="1" />
            </form>
        </div>
        <div class="clear"></div>
        <div class="contResultadosBusqueda">
            <div class="encabezadoBusqueda">
                <p>Resultados de la b&uacute;squeda:</p>
            </div>
            <div id="listarCasos">
                <!--  ${casosExitosos} -->
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="clear"></div>
</div>