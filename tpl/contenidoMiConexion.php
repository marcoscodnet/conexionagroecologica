<div id="contenedorBloqueSolapa">
    <div class="contMenuIzqBack">
        <div class="cajaIzqMenuBack">
            <div class="solapaVerdeTitulos">
                <div id="spriteMiConexion"><p>Mi Conexi&oacute;n</p></div>
            </div>
            <div class="clear"></div>
            <div class="cajaBotonesBack">
                <ul id="botoneraRightBack">
                    <li><a href="javascript:void(0)" id="listarComprasRealizadas">Compras</a></li>
                    <li><a href="javascript:void(0)" id="listarVentasRealizadas">Ventas</a></li>
                    <li><a href="javascript:void(0)" id="listarMisPublicaciones">Mis Publicaciones</a></li>
                    <li class="roundBottom"><a href="javascript:void(0)" id="listarFavoritos">Favoritos</a></li>
                </ul>
                <div class="clear"></div>
            </div>
        </div>
        <div class="cajaIzqMenuBack">
            <div class="solapaVerdeTitulos">
                <div id="spriteMensajes"><p>Mensajes</p></div>
            </div>
            <div class="cajaBotonesBack">
                <ul id="botoneraRightBack">
                    <li><a href="javascript:void(0)" id="listarMensajesEnviados">Enviados</a></li>
                    <li class="roundBottom"><a href="javascript:void(0)" id="listarMensajesRecibidos">Recibidos</a></li>
                </ul>
                <div class="clear"></div>
            </div>
        </div>
        <div class="cajaIzqMenuBack">
            <div class="solapaVerdeTitulos">
                <div id="spritePerfil"><p>Mi Perfil</p></div>
            </div>
            <div class="clear"></div>
            <div class="cajaBotonesBack">
                <ul id="botoneraRightBack">
                    <li class="roundBottom"><a href="javascript:void(0)" id="listarDatosPersonales">Datos Personales</a></li>
                </ul>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="contCajaDerBack">
        <div class="solapaVerdeTitulos"></div>
        <div class="clear"></div>
        <div class="cajaDerBack">
            <div id="listarMiConexion" class="formDatosPersonales">
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <input type="hidden" name="codigo" id="codigo" value="<?php echo($_SESSION['codigoUsuario']); ?>" />
</div>