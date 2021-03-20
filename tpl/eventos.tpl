<div id="contenedorBloqueSolapa">
    <div class="solapaVerdeTitulosBuscar">
        <div id=""><p>Eventos</p></div>
    </div>
    <div class="clear"></div>
    <div class="contInfoBloques">
        <div class="contBuscadorComboBox" style="height: 85px">
            <form action="?" method="post" id="buscadorCombos">
                <div class="colBoxes">
                    <p><label for="selectCategoriaProveedor">Categor&iacute;a</label></p>
                    ${categoriaToSelect}
                </div>
                <div class="colBoxes">
                    <p><label for="selectProvincia">Provincia</label></p>
                    ${provinciaToSelect}
                </div>
                <input type="hidden" id="pagina" name="pagina" value="1" />
            </form>
        </div>
        <div class="clear"></div>

        <div class="texto">
            <div id="listadoEventos" class="parrafoQuienes">
                ${eventos}
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>

    </div>
    <div class="clear"></div>
</div>