<form action="#" method="post" name="form_datos_personales" id="form_datos_personales">
    <p>Configure su informaci&oacute;n</p>
    <div class="formTemplate">
        <div class="camposContainer">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" maxlength="42" name="nombre" value="<!--{usuarioNombre}-->">
            <label for="apellido">Apellido</label>
            <input type="text" id="apellido" maxlength="42" name="apellido" value="<!--{usuarioApellido}-->">
            <label for="email">E-mail</label>
            <input type="text" id="email" maxlength="42" name="email" value="<!--{usuarioEmail}-->">
            <label for="telefonoArea">Tel&eacute;fono</label>
            <input type="text" style="width:40px" id="telefonoArea" maxlength="42" name="telefonoArea" value="<!--{telefonoArea}-->">
            <input type="text" style="width:260px" id="telefonoNumero" maxlength="42" name="telefonoNumero" value="<!--{telfonoNumero}-->">
        </div>
        <div class="camposContainer">
            <label for="celularArea">Celular</label>
            <input type="text" style="width:40px" id="celularArea" maxlength="42" name="celularArea" value="<!--{celularArea}-->">
            <input type="text" style="width:260px" id="celularNumero" maxlength="42" name="celularNumero" value="<!--{celularNumero}-->">
            <!--<label for="company">Compa&ntilde;ia</label>
            <input type="text" id="company" maxlength="42" name="company" value="<!--{usuarioCompany}->">
            <label for="cuit">C.U.I.T./C.U.I.L.</label>
            <input type="text" id="cuit" maxlength="42" name="cuit" value="<!--{usuarioCuit}->">
            <label for="razonSocial">Raz&oacute;n Social</label>
            <input type="text" id="razonSocial" maxlength="42" name="razon" value="<!--{usuarioRazon}->">-->
            <p> <label for="propietario" class="propietario">Propietario</label>
                        <!--{propietarioCheck}-->
            <label for="propietario" class="propietario">Productor</label>
                        <!--{productorCheck}-->
            <p id="checkMensaje"></p>
            <label for="propietario" class="propietario">Acepto que mis datos est&eacute;n disponibles</label>
                        <!--{datosDisponiblesCheck}-->
                        </p>
            
        </div>
        <div class="camposContainer camposContainerUltimo">
            <input type="submit" id="datosPersonalesForm" value=" " name="modificar" class="formBtnSprite btnModificar">
            <!-- <a class="btnCancelar">Cancelar</a> -->
        </div>
        <p>Para cambiar su contrase&ntilde;a haga click <a href="javascript:void(0);" id="cambiarPass">aqui</a>
        
        <div class="clear"></div>
    </div>
    <input type="hidden" value="<!--{codigoUsuario}-->" name="fg" />
</form>