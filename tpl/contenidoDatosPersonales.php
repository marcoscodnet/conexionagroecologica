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
                <div id="spritePerfil"><p>Mi Perf&iacute;l</p></div>
            </div>
            <div class="clear"></div>
            <div class="cajaBotonesBack">
                <ul id="botoneraRightBack">
                    <li><a href="datos-personales.php">Datos Personales</a></li>
                </ul>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="contCajaDerBack">
        <div class="solapaVerdeTitulos"><p>Datos Personales</p></div>
        <div class="clear"></div>
        <div class="cajaDerBack">
            <div id="listarDatosContacto" class="formDatosPersonales">
                <form action="#" method="post" name="form_datos_personales" id="form_datos_personales">
                    <p>Configure la informaci&oacute;n suya y de su empresa. </p>
                    <div class="formTemplate">
                        <div class="camposContainer">
                            <label for="nombre">Nombre</label>
                            <input type="text" id="nombre" maxlength="42" name="nombre" value="">
                            <label for="apellido">Apellido</label>
                            <input type="text" id="apellido" maxlength="42" name="apellido" value="">
                            <label for="email">E-mail</label>
                            <input type="text" id="email" maxlength="42" name="email" value="">
                            <label for="telefonoArea">Tel&eacute;fono</label>
                            <input type="text" style="width:40px" id="telefonoArea" maxlength="42" name="telefonoArea" value="">
                            <input type="text" style="width:260px" id="telefonoNumero" maxlength="42" name="telefonoNumero" value="">
                        </div>
                        <div class="camposContainer">
                            <label for="celularArea">Celular</label>
                            <input type="text" style="width:40px" id="celularArea" maxlength="42" name="celularArea" value="">
                            <input type="text" style="width:260px" id="celularNumero" maxlength="42" name="celularNumero" value="">
                            <label for="company">Compa&ntilde;ia</label>
                            <input type="text" id="company" maxlength="42" name="company" value="">
                            <label for="company">C.U.I.T./C.U.I.L.</label>
                            <input type="text" id="cuit" maxlength="42" name="cuit" value="">
                            <label for="company">Raz&oacute;n Social</label>
                            <input type="text" id="razonSocial" maxlength="42" name="razonSocial" value="">
                        </div>
                        <div class="camposContainer camposContainerUltimo">
                            <input type="submit" id="datosPersonalesForm" value=" " name="modificar" class="formBtnSprite btnModificar">
                            <!--<a class="btnCancelar">Cancelar</a>-->
                        </div>
                        <p>Para cambiar su contrase&ntilde;a haga click <a href="#">aqu&iacute;</a></p>
                        
                        <div class="clear"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <input type="hidden" name="user" id="user" value="<?php echo($_SESSION['codigoUsuario']); ?>" />
</div>