 <!-- RIBBON -->
<div id="ribbon">

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Proveedores</li><li>${accion}</li>
    </ol>
    <!-- /breadcrumb -->

</div>
<!-- /RIBBON -->

 <!-- PROVEEDOR -->
<div id="content">

    <!-- row -->
    <div class="row">

        <!-- col -->
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
            <h1 class="page-title txt-color-blueDark">

                <!-- PAGE HEADER -->
                <i class="fa-fw fa fa-puzzle-piece"></i> 
                Proveedores
                <span>>  
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
                            
                            <form action="php/controllers/proveedor.controller.php" method="post">

                                <fieldset class="smart-form">

                                    <div class="row">
                                        
                                        <section class="col col-md-3 col-sm-3 col-xs-12">
                                            <label class="label">Nombre de la organización</label>
                                            <label class="input">
                                                <input autofocus="autofocus" type="text" name="nombre" value="${nombre}" />
                                            </label>
                                        </section>

                                        <section class="col col-md-3 col-sm-3 col-xs-12">
                                            <label class="label">Teléfono</label>
                                            <label class="input">
                                                <input autofocus="autofocus" type="text" name="telefono" value="${telefono}" />
                                            </label>
                                        </section>
                                            
                                        <section class="col col-md-3 col-sm-3 col-xs-12">
                                            <label class="label">Email</label>
                                            <label class="input">
                                                <input autofocus="autofocus" type="text" name="email" value="${email}" />
                                            </label>
                                        </section>
                                            
                                        <section class="col col-md-3 col-sm-3 col-xs-12">
                                            <label class="label">Web</label>
                                            <label class="input">
                                                <input autofocus="autofocus" type="text" name="web" value="${web}" />
                                            </label>
                                        </section>
                                            
                                    </div>
                                            
                                    <div class="row">

                                        <section class="col col-md-3 col-sm-3 col-xs-12">
                                            <label class="label">Categoría</label>
                                            <label class="select">
                                                ${categoriaToSelect}<i></i>
                                            </label>
                                        </section>
                                            
                                        <section class="col col-md-3 col-sm-3 col-xs-12">
                                            <label id="labelSubcategoria" class="label">Subcategoría <i style="display: none" class="fa fa-circle-o-notch fa-spin"></i></label>
                                            <label class="select">
                                                ${subcategoriaToSelect}<i></i>
                                            </label>
                                        </section>
                                            
                                        <section class="col col-md-3 col-sm-3 col-xs-12">
                                            <label class="label">Provincia</label>
                                            <label class="select">
                                                ${provinciaToSelect}<i></i>
                                            </label>
                                        </section>
                                            
                                        <section class="col col-md-3 col-sm-3 col-xs-12">
                                            <label id="lableLocalidad" class="label">Localidad <i style="display: none" class="fa fa-circle-o-notch fa-spin"></i></label>
                                            <label class="select">
                                                ${localidadToSelect}<i></i>
                                            </label>
                                        </section>
                                            
                                    </div>
                                    
                                     <div class="row">
                                        <section class="col col-md-12 col-sm-12 col-xs-12">
                                            <label class="label">Descripción</label>
                                            <label class="textarea">
                                                <textarea style="height: 320px" name="descripcion">${descripcion}</textarea>
                                            </label>
                                        </section>
                                    </div>
                                            
                                </fieldset>

                                <input type="hidden" name="id" value="${id}" />
                                <input type="hidden" name="imgprefix" value="${imgprefix}" />
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
<!-- /PROVEEDOR -->