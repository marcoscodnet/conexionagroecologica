<div id="contenedorBloqueSolapa">
    <div class="solapaVerdeTitulosBuscar">
        <div id=""><p>Recicladores</p></div>
    </div>
    <div class="clear"></div>
    <div class="contInfoBloques">
        <div class="contBuscadorComboBox">
            <form action="?" method="post" id="buscadorCombos">
                <div class="colBoxes">
                    <p><label for="selectProvincia">Provincia</label></p>
                    ${provinciaToSelect}
                    <p><label for="selectLocalidad">Localidad</label></p>
                    <select id="selectLocalidad" name="localidad">
                        <option value="">Elegir</option>
                    </select>
                </div>
                <div class="colBoxes">
                    <p><label for="selectCategoria">Categor&iacute;a</label></p>
                    ${categoriaToSelect}
                    <p><label for="selectSubcategoria">Subcategor&iacute;a</label></p>
                    <select id="selectSubcategoria" name="subcategoria">
                        <option value="">Elegir</option>
                    </select>
                </div>
                <div class="colBoxes">
                    <p><label for="selectTipoReciclador">Tipo</label></p>
                    ${tipoToSelect}
                </div>
                <input type="hidden" id="pagina" name="pagina" value="1" />
            </form>
        </div>
        <div class="clear"></div>

        <div class="texto">
            <div id="listadoRecicladores" class="parrafoQuienes">
                ${recicladores}
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>

    </div>
    <div class="clear"></div>
</div>