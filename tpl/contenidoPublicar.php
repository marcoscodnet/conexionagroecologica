<div id="contenedorBloqueSolapa">
    <div class="solapaVerdeTitulosBuscar">
        <div id="spritePublicar"><p>Publicar - Publique su propiedad en solo tres simples pasos</p></div>
        <a href="como-publicar.php" class="comoVender">&iquest;c&oacute;mo publicar?</a>
    </div>
    <div class="clear"></div>
    <div class="contInfoBloques">
        <div class="contVender"> <!--php/controllers/publicar.controller.php-->
            <form action="php/controllers/publicar.controller.php" method="post" enctype="multipart/form-data" id="datosVender">
                <!-- FORMULARIO VENDER ETAPA 1 -->
                <div class="bloqueEtapa">
                    <div class="encabezadoBloqueEtapa">
                        <div class="tituloEtapaVender">
                            <div class="fotoEtapa"></div>
                            <p style="padding-top: 6px;"><span>Informaci&oacute;n General</span></p>
                        </div>
                        <div class="infoEtapaVender">
                            <p><span>Cu&eacute;ntenos de sobre su publicaci&oacute;n</span></p>
                            <p>Por favor complete los detalles de la propiedad que desea publicar.</p>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="contFormVender">
                        <div class="contTituloArticuloVender">
                            <p>T&iacute;tulo de la publicaci&oacute;n</p>
                            <input type="text" name="titulo" class="tituloArticulo" value="<!--{propiedadTitulo}-->" />
                        </div>
                        <div class="colBoxes">
                            <p><label for="usoSuelo">Uso del suelo actual</label></p>
                            <!--{usoSueloToSelect}-->
                            <span id="spanOtroUsoSuelo" style="display: none"><input placeholder="Otro" type="text" name="otro_uso_suelo" id="otro_uso_suelo" value="<!--{propiedadOtroUsoSuelo}-->" /></span>
                            <p><label for="tipoUsoSuelo">Tipo de uso actual</label></p>
                            <!--{tipoUsoSueloToSelect}-->
                            <span id="spanTipoOtroUsoSuelo" style="display: none"><input placeholder="Otro" type="text" name="otro_tipo_uso_suelo" id="otro_tipo_uso_suelo" value="<!--{propiedadOtroTipoUsoSuelo}-->" /></span>
                        </div>
                        <div class="colBoxes">
                            <p><label for="hectareas">Hect&aacute;reas</label></p>
                            <input type="text" name="hectareas" id="hectareas" class="inputAncho" value="<!--{propiedadHectareas}-->" />
                            <p><label for="tipoContrato">Tipo de contrato preferido por due&ntilde;o</label></p>
                            <!--{tipoContratoToSelect}-->
                            
                        </div>
                         <div class="colBoxes" style="float: right !important;width: 216px !important;">
                            <p><label for="posibleUsoSuelo">Posibles usos del suelo</label></p>
                            <!--{posibleUsoSueloToSelect}-->
                            <p><label for="accesoAgua">Acceso al agua</label></p>
                            <!--{accesoAguaToSelect}-->
                        </div>
                        
                        <div class="clear"></div>
                        <div class="contDescArticulo">
                            <p><label for="descArticulo">Descripci&oacute;n detallada</label></p>
                            <textarea name="descripcion" id="descArticulo" cols="30" rows="10"><!--{propiedadDescripcion}--></textarea>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <!-- FIN FORMULARIO ETAPA 1 -->
                <div class="clear"></div>
                <!-- BLOQUE CARGAR FOTOS -->
                <div class="bloqueEtapa">
                    <div class="encabezadoBloqueEtapa">
                        <div class="tituloEtapaVender">
                            <div class="fotoEtapa" style="background-position: 0px -41px;"></div>
                            <p style="padding-top: 6px;"><span>Fotos</span></p>
                        </div>
                        <div class="infoEtapaVender">
                            <p><span>Sub&iacute; fotos del propiedad!</span></p>
                            <p>Le recomendamos subir como minimo 2 fotos. (m&aacute;ximo permitido 4).Tama&ntilde;o m&aacute;ximo de cada foto: 2 mbytes.</p>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="contUploadFotos">
                        <div id="fileupload">
                            <div class="fileupload-buttonbar">
                                <label class="fileinput-button">
                                    <span>Agregar fotos</span>
                                    <input type="file" name="files[]" multiple>
                                </label>
                                <button type="submit" class="start">Subir fotos</button>
                                <button type="reset" class="cancel">Cancelar fotos</button>
                                <button type="button" class="delete">Eliminar fotos</button>
                            </div>
                            <div class="fileupload-content">
                                <table class="files"></table>
                                <div class="fileupload-progressbar"></div>
                            </div>
                        </div>
                        <script id="template-upload" type="text/x-jquery-tmpl">
                            <tr class="template-upload{{if error}} ui-state-error{{/if}}">
                                <td class="preview"></td>
                                <td class="name">${name}</td>
                                <td class="size">${sizef}</td>
                                {{if error}}
                                <td class="error" colspan="2">Error:
                                    {{if error === 'maxFileSize'}}El archivo es muy pesado
                                    {{else error === 'minFileSize'}}El archivo es muy liviano
                                    {{else error === 'acceptFileTypes'}}Extensi&oacute;on de archivo no permitida
                                    {{else error === 'maxNumberOfFiles'}}M&aacute;ximo de archivos permitido excedido
                                    {{else}}${error}
                                    {{/if}}
                                </td>
                                {{else}}
                                <td class="progress"><div></div></td>
                                <td class="start"><button>Comenzar</button></td>
                                {{/if}}
                                <td class="cancel"><button>Cancelar</button></td>
                            </tr>
                        </script>
                        <script id="template-download" type="text/x-jquery-tmpl">
                            <tr class="template-download{{if error}} ui-state-error{{/if}}">
                                {{if error}}
                                <td></td>
                                <td class="name">${name}</td>
                                <td class="size">${sizef}</td>
                                <td class="error" colspan="2">Error:
                                    {{if error === 1}}La imagen es demasiado grande, se aceptan tamaños menores a 2 Mb.
                                    {{else error === 2}}La imagen es demasiado grande, se aceptan tamaños menores a 2 Mb.
                                    {{else error === 3}}Se subió sólo parcialmente
                                    {{else error === 4}}El archivo NO fue subido
                                    {{else error === 5}}Falta la carpeta temporal
                                    {{else error === 6}}No se ha podido copiar el archivo en el disco
                                    {{else error === 7}}La carga de archivos por extensión se detuvo
                                    {{else error === 'maxFileSize'}}La imagen es demasiado grande, se aceptan tamaños menores a 2 Mb.
                                    {{else error === 'minFileSize'}}File is too small
                                    {{else error === 'acceptFileTypes'}}Extensi&oacute;n de archivo no permitida
                                    {{else error === 'maxNumberOfFiles'}}M&aacute;ximo de archivos permitido excedido
                                    {{else error === 'uploadedBytes'}}Uploaded bytes exceed file size
                                    {{else error === 'emptyResult'}}Empty file upload result
                                    {{else}}${error}
                                    {{/if}}
                                </td>
                                {{else}}
                                <td class="preview">
                                    {{if thumbnail_url}}
                                    <a href="${url}" target="_blank"><img src="${thumbnail_url}"></a>
                                    {{/if}}
                                </td>
                                <td class="name">
                                    <a href="${url}"{{if thumbnail_url}} target="_blank"{{/if}}>${name}</a>
                                </td>
                                <td class="size">${sizef}</td>
                                <td colspan="2"></td>
                                {{/if}}
                                <td class="delete">
                                    <button data-type="${delete_type}" data-url="${delete_url}">Delete</button>
                                </td>
                            </tr>
                        </script>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <!-- FIN BLOQUE CARGAR FOTOS -->
                <div class="clear"></div>
                <!-- BLOQUE CONDICIONES -->
                <div class="bloqueEtapa">
                    <div class="encabezadoBloqueEtapa">
                        <div class="tituloEtapaVender">
                            <div class="fotoEtapa" style="background-position: 0px -82px;"></div>
                            <p style="padding-top: 6px;"><span>Direcci&oacute;n</span></p>
                        </div>
                        <div class="infoEtapaVender">
                            <p><span>Ingrese la ubicaci&oacute;n (haga click en el mapa para obtener la latitud y longitud)</span></p>
                            
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div id="map"></div>
    					<script>

					      function initMap() {
					       
					        var map = new google.maps.Map(document.getElementById('map'), {
					          zoom: 4,
					          center: new google.maps.LatLng(-38.416097, -63.616672)
					        });
					        google.maps.event.addListener(map, 'click', function(event) {
				            	 
				                var coordenadas = event.latLng;
				                var lat = coordenadas.lat();
				                var lng = coordenadas.lng();
				                $('#longitud').val(lng);
				                $('#latitud').val(lat);
				         
				        }) 
					        var icon = 'https://maps.gstatic.com/mapfiles/ms2/micons/grn-pushpin.png';

					        var iconLevel1= new google.maps.MarkerImage(
					      	      icon,
					      	      
					      	       null, /* size is determined at runtime */
					          null, /* origin is 0,0 */
					          null, /* anchor is bottom center of the scaled image */
					          new google.maps.Size(12, 12));
					        var latitud = '<!--{propiedadLatitud}-->';
					        var longitud = '<!--{propiedadLongitud}-->';

							if(latitud!=''){
						        var marker = new google.maps.Marker({
							        position: new google.maps.LatLng(latitud, longitud),
							        map: map, 
							        animation:google.maps.Animation.DROP,
							        draggable:false,
							        icon: iconLevel1
							      });
	
						        var bounds = new google.maps.LatLngBounds();
						        
						              bounds.extend(marker.position);
						           
						            //  Fit these bounds to the map
						            map.fitBounds(bounds);
							}

					        
					          
					        
					       // var geocoder;
					       // var address = '<!--{propiedadDireccionMapa}-->';
							
					        /*if(address !='') {
					            geocoder = new google.maps.Geocoder();
					            
					            geocoder.geocode( { 'address': address}, function(results, status) {
					              if (status == google.maps.GeocoderStatus.OK) {
					                //document.getElementById('x').innerHTML = results[0].geometry.location.lat().toFixed(6);
					                //document.getElementById('y').innerHTML = results[0].geometry.location.lng().toFixed(6);
					                map.setCenter(results[0].geometry.location);
					                //alert(results[0].geometry.location)
					                var marker = new google.maps.Marker({
					                    map: map,
					                    zoom: 14,
					                    position: results[0].geometry.location
					                });
					              } else {
					                alert('La localización no tuvo éxito por la siguiente razón: ' + status);
					              }
					            });
					          }*/

					          

					        
					      }
					
					    </script>
					    <script async defer
					        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAggBwZ10PL9galUdtJZ2HR221SbKKXb3M&callback=initMap">
					    </script>
                    <div class="contFormVender" style="border: none !important;">
                        <div class="colBoxes">
                            <p><label for="latitud">Latitud</label></p>
                         
                                <input type="text" name="latitud" id="latitud" class="inputAncho" value="<!--{propiedadLatitud}-->" />
                         
                            <p><label for="longitud">Longitud</label></p>
                           
                                <input type="text" name="longitud" id="longitud" class="inputAncho" value="<!--{propiedadLongitud}-->" />
                           
                            <div class="clear"></div>
                            
                        </div>
                        <div class="colBoxes">
                            <p><label for="provincia">Provincia</label></p>
                            <!--{provinciaToSelect}-->
                            <p><label for="localidad">Localidad</label></p>
                            <span id="localidadContenedor"><!--{localidadesToSelect}--></span>
                        </div>
                        <div class="colBoxes" style="margin-right: 0px !important;float: right;width: 215px !important;">
                            <br>
                            <p><label for="casaDisponible">Casa Disponible<!--{propiedadCasaDisponible}--></label></p>
                            <br><br>
                            <p><label for="viveTerreno">Due&ntilde;o vive en el terreno<!--{propiedadViveTerreno}--></label></p>
                            
                        </div>
                        <div class="clear"></div>
                        
                        <div class="clear"></div>
                        <input type="hidden" name="codigo" value="<!--{codigoUsuario}-->" />
                        <input type="hidden" name="propiedadId" value="<!--{propiedadId}-->" />
                        <p><a href="javascript:void(0);" id="vistaPrevia"></a></p>
                        <input type="submit" name="vender" value="Publicar" class="btn naranja" <!--{clase}--> />
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <!-- FIN BLOQUE CONDICIONES -->
                <div class="clear"></div>
            </form>
            <div class="clear"></div>
        </div>
    </div>
    <div class="clear"></div>
</div>