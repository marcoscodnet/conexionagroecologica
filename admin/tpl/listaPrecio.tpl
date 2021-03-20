 <!-- RIBBON -->
<div id="ribbon">

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Lista de precios</li><li>${accion}</li>
    </ol>
    <!-- /breadcrumb -->

</div>
<!-- /RIBBON -->

 <!-- RECICLADOR -->
<div id="content">

    <!-- row -->
    <div class="row">

        <!-- col -->
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
            <h1 class="page-title txt-color-blueDark">

                <!-- PAGE HEADER -->
                <i class="fa-fw fa fa-recycle"></i> 
                Lista de precios
                <span>  
                    ${accion}
                </span>
            </h1>
        </div>
        <!-- /col -->

    </div>
    <!-- /row -->

    <!-- widget grid -->
    <section id="widget-grid" class="">

        <!-- row -->
        <div class="row">

            <!-- WIDGET 1 -->
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <!-- Widget ID (each widget will need unique ID)-->
                <div 
                    class="jarviswidget jarviswidget-color-darken" 
                    id="" 
                    data-widget-colorbutton="false" 
                    data-widget-editbutton="false" 
                    data-widget-togglebutton="false" 
                    data-widget-deletebutton="false" 
                    data-widget-sortable="false"
                >
                    <header>
                        <span class="widget-icon"> <i class="fa fa-${icon}"></i> </span>
                        <h2>${title}</h2>				

                    </header>

                    <!-- widget div-->
                    <div>

                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->

                        </div>
                        <!-- end widget edit box -->

                        <!-- widget content -->
                        <div class="widget-body">
                            
                            <form action="php/controllers/recicladorListaPrecio.controller.php" method="post">

                                <fieldset class="smart-form">

                                    <div class="row">
                                        
                                        <section class="col col-md-3 col-sm-3 col-xs-12">
                                            <label class="label">Material</label>
                                            <label class="input">
                                                <input autofocus="autofocus" type="text" name="material" value="${material}" />
                                            </label>
                                        </section>

                                        <section class="col col-md-1 col-sm-3 col-xs-12">
                                            <label class="label">&#36;/KG</label>
                                            <label class="input">
                                                <input autofocus="autofocus" type="text" name="precio_kg" value="${preciokg}" />
                                            </label>
                                        </section>
                                            
                                        <section class="col col-md-2 col-sm-3 col-xs-12">
                                            <label class="label">Var. trim. ant. (&#36;)</label>
                                            <label class="input">
                                                <input autofocus="autofocus" type="text" name="variacion_precio" value="${variacionprecio}" />
                                            </label>
                                        </section>
                                            
                                        <section class="col col-md-2 col-sm-3 col-xs-12">
                                            <label class="label">Var. trim. ant. (%)</label>
                                            <label class="input">
                                                <input autofocus="autofocus" type="text" name="variacion_porcentaje" value="${variacionporcentaje}" />
                                            </label>
                                        </section>

					<section class="col col-md-3 col-sm-3 col-xs-12">
                                            <label class="label">Tipo</label>
					    <label class="select">
                                                <select name="tipo" id="selectTipo">
						<option value="">Elegir</option>
						<option value="Acopiador" ${selectAcopiados}>Acopiador</option>
						<option value="Reciclador" ${selectReciclador}>Reciclador</option>
						</select>
                                            </label>
                                        </section>
                                            
                                    </div>
                                            
                                    
                                            
                                </fieldset>

                                <input type="hidden" name="id" value="${id}" />
                                
                            </form>
                            
                            
                            
                            <div class="widget-footer smart-form">
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-success saveForm" type="button">
                                        Guardar
                                    </button>	
                                </div>
                            </div>

                        </div>
                        <!-- end widget content -->

                    </div>
                    <!-- /widget div -->

                </div>
                <!-- /widget -->

            </article>
            <!-- /WIDGET 1 -->

        </div>

        <!-- /row -->

    </section>
    <!-- /widget grid -->

</div>
<!-- /RECICLADOR -->