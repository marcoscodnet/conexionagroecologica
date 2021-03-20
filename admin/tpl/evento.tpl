 <!-- RIBBON -->
<div id="ribbon">

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Eventos</li><li>${accion}</li>
    </ol>
    <!-- /breadcrumb -->

</div>
<!-- /RIBBON -->

 <!-- EVENTO -->
<div id="content">

    <!-- row -->
    <div class="row">

        <!-- col -->
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
            <h1 class="page-title txt-color-blueDark">

                <!-- PAGE HEADER -->
                <i class="fa-fw fa fa-calendar"></i> 
                Eventos
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
                            
                            <form action="php/controllers/evento.controller.php" method="post">

                                <fieldset class="smart-form">

                                    <div class="row">
                                        
                                        <section class="col col-md-6 col-sm-6 col-xs-12">
                                            <label class="label">Título del evento</label>
                                            <label class="input">
                                                <input autofocus="autofocus" type="text" name="titulo" value="${titulo}" />
                                            </label>
                                        </section>

                                        <section class="col col-md-3 col-sm-3 col-xs-12">
                                            <label class="label">Día</label>
                                            <label class="input">
                                                <input autofocus="autofocus" type="text" name="dia" value="${dia}" />
                                            </label>
                                        </section>
                                        
                                        <section class="col col-md-3 col-sm-3 col-xs-12">
                                            <label class="label">Categoría</label>
                                            <label class="select">
                                                ${categoriaToSelect}<i></i>
                                            </label>
                                        </section>
                                            
                                    </div>
                                            
                                    <div class="row">

                                        <section class="col col-md-3 col-sm-3 col-xs-12">
                                            <label class="label">Organizador</label>
                                            <label class="input">
                                                <input autofocus="autofocus" type="text" name="organizador" value="${organizador}" />
                                            </label>
                                        </section>
                                            
                                        <section class="col col-md-3 col-sm-3 col-xs-12">
                                            <label class="label">Teléfono</label>
                                            <label class="input">
                                                <input autofocus="autofocus" type="text" name="telefono" value="${telefono}" />
                                            </label>
                                        </section>
                                            
                                        <section class="col col-md-3 col-sm-3 col-xs-12">
                                            <label class="label">Dirección</label>
                                            <label class="input">
                                                <input autofocus="autofocus" type="text" name="direccion" value="${direccion}" />
                                            </label>
                                        </section>
                                            
                                        <section class="col col-md-3 col-sm-3 col-xs-12">
                                            <label id="lableLocalidad" class="label">Provincia</label>
                                            <label class="select">
                                                ${provinciaToSelect}<i></i>
                                            </label>
                                        </section>
                                            
                                    </div>
                                            
                                    <div class="row">

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
                                            
                                        <section class="col col-md-3 col-sm-3 col-xs-12">
                                            <label class="label">Facebook</label>
                                            <label class="input">
                                                <input autofocus="autofocus" type="text" name="facebook" value="${facebook}" />
                                            </label>
                                        </section>
                                            
                                        <section class="col col-md-3 col-sm-3 col-xs-12">
                                            <label class="label">Twitter</label>
                                            <label class="input">
                                                <input autofocus="autofocus" type="text" name="twitter" value="${twitter}" />
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
<!-- /EVENTO -->