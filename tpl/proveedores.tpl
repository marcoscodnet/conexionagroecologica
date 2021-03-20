<div id="contenedorBloqueSolapa">
    <div class="solapaVerdeTitulosBuscar">
        <div id=""><p>Proveedores</p></div>
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
                    <p><label for="selectCategoriaProveedor">Categor&iacute;a</label></p>
                    ${categoriaToSelect}
                    <p><label for="selectSubcategoriaProveedor">Subcategor&iacute;a</label></p>
                    <select id="selectSubcategoriaProveedor" name="subcategoria">
                        <option value="">Elegir</option>
                    </select>
                </div>
                <div class="colBoxes">
                    <a target="_blank" style="height: auto" class="btn naranja" href="https://docs.google.com/forms/d/1GmXM1OAw3PtkiRcslCew4ohEUBnmgJq645upuKFpXJM/viewform">Agregar proveedor a la<br> base de datos</a>
                </div>
                <input type="hidden" id="pagina" name="pagina" value="1" />
            </form>
        </div>
        <div class="clear"></div>

        <div class="texto">
            <div id="listadoProveedores" class="parrafoQuienes">
                ${proveedores}
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>

    </div>
    <div class="clear"></div>
</div>