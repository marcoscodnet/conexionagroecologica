<!--{usuarioToString}-->
<div id="contenedorBloqueSolapa">
    <div class="solapaVerdeTitulosBuscar">
        <div id="spriteArticulo"><p>Art&iacute;culo</p></div>
    </div>
    <!--<div class="textoCabezeraInfoBloques">
        <p>seleccione subcategor&iacute;as para filtrar los resultados</p>
    </div>-->
    <div class="clear"></div>
    <div class="contInfoBloques">
        <div class="contArticuloIndividual">
            <div class="cajaArticuloIndividual">
                <div class="contFotosArticulo">
                    <div class="fotoArticuloIndividualGrande">
                       <!--{propiedadImagenGr}-->
                    </div>
                    <div class="fotosChicasArticuloIndividual">
                        <!--{propiedadImagenCh}-->
                    </div>
                </div>
                <div class="contenidoArticuloIndividual">
                    <p><!--{propiedadTitulo}--></p>
                    <div class="descripcionArticuloIndividual">
                        <p><span>Uso del suelo actual:</span> <!--{propiedadUsoSuelo}--></p>
                        <p><span>Tipo de uso actual:</span> <!--{propiedadTipoUsoSuelo}--></p>
                        <p><span>Hect&aacute;reas:</span> <!--{propiedadHectareas}--></p>
                        <p><span>Tipo de contrato preferido por el due&ntilde;o:</span> <!--{propiedadTipoContrato}--></p>
                        <p><span>Posibles usos del suelo:</span> <!--{propiedadPosibleUsoSuelo}--></p>
                        <p><span>Acceso al agua:</span> <!--{propiedadAccesoAgua}--></p>
                    
                        <p><span>Ubicaci&oacute;n:</span> <!--{propiedadDireccion}--></p>
                        <p><span>Casa disponible:</span> <!--{propiedadCasaDisponible}--></p>
                        <p><span>Due&ntilde;o vive en el terreno:</span> <!--{propiedadViveTerreno}--></p>
                        <p><span>Descripci&oacute;n:</span></p>
                        <p><!--{propiedadDescripcion}--></p>
                    </div>
                </div>
                
                <div class="cajaBotonesArticuolIndividual">
					<div class="descripcionArticuloIndividual">
                        
                        
                        <p><span>Tiempo restante:</span> <!--{publicacionTiempoRestante}--></p>
                        <p><span>Visitas:</span> <!--{publicacionVisitas}--></p>
                        <p><!--{publicacionMail}--></p>
                        

                        <!--<p><span>Rep. del vendedor:</span> <!-{usuarioPuntos}-></p>-->
                        <div class="cajaBotonesResultadoBusqueda">
                            <!--{botonesAcciones}-->
                        </div>
                    </div>
                </div>
               
                <div class="clear"></div>
                
            </div>
             <div id="map"></div>
    					<script>

					      function initMap() {
					       
					        var map = new google.maps.Map(document.getElementById('map'), {
					          zoom: 8,
					          center: new google.maps.LatLng(-38.416097, -63.616672)
					        });

					        var icon = 'https://maps.gstatic.com/mapfiles/ms2/micons/grn-pushpin.png';

					        var iconLevel1= new google.maps.MarkerImage(
					      	      icon,
					      	      
					      	       null, /* size is determined at runtime */
					          null, /* origin is 0,0 */
					          null, /* anchor is bottom center of the scaled image */
					          new google.maps.Size(12, 12));
					        var latitud = '<!--{propiedadLatitud}-->';
					        var longitud = '<!--{propiedadLongitud}-->';
					        var marker = new google.maps.Marker({
						        position: new google.maps.LatLng(latitud, longitud),
						        map: map, 
						        icon: iconLevel1
						      });

					        var bounds = new google.maps.LatLngBounds();
					        
					              bounds.extend(marker.position);
					           
					            //  Fit these bounds to the map
					            map.fitBounds(bounds);
					           
					          
					        
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
            <div class="contPreguntasVendedor">
                    <!--{botonesMensaje}-->
            </div>
            <div class="clear"></div>
        </div>
		<div id="listarMensajes">
            </div>
    </div>
    <div class="clear"></div>
    <input type="hidden" name="fg" value="<!--{codigoUsuario}-->" id="fg" />
    <input type="hidden" id="propiedadId" value="<!--{propiedadId}-->" id="fg" />
</div>
