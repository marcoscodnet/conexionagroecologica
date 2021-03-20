 <!-- RIBBON -->
<div id="ribbon">

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Casos</li><li>Categorías</li>
    </ol>
    <!-- /breadcrumb -->

</div>
<!-- /RIBBON -->

 <!-- PRODUCTO -->
<div id="content">

    <!-- row -->
    <div class="row">

        <!-- col -->
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
            <h1 class="page-title txt-color-blueDark">

                <!-- PAGE HEADER -->
                <i class="fa-fw fa fa-comments"></i> 
                Casos de conexión
                <span>>  
                    Categorías
                </span>
            </h1>
        </div>
        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8 text-right">
            <a href="#" class="btn btn-success agregarSubategoria"><span class="fa fa-plus"></span> Agregar subcategoría</a>
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
                
                <form method="post" action="php/controllers/categoria.controller.php">
                    <fieldset>

                        <div class="row">

                            <section class="col col-md-6 col-sm-6 col-xs-12 smart-form">
                                <label class="label">Categor&iacute;a</label>
                                <label class="input">
                                    <input autofocus="autofocus" type="text" name="value" value="<?php echo(utf8_encode($CATEGORIA)); ?>" />
                                </label>
                            </section>
                                
                            <section class="col col-md-6 col-sm-6 col-xs-12">
                                <div class="smart-form"><label class="label">&nbsp;</label></div>
                                <label class="input">
                                    <input class="btn btn-success" type="submit" name="enviador" value="Guardar" />
                                </label>
                            </section>
                            
                            <input type="hidden" name="id" id="categoriaId" value="<?php echo($_GET['id']); ?>" />
                            
                        </div>
                    </fieldset>
                </form>

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
                        <span class="widget-icon"> <i class="fa fa-list"></i> </span>
                        <h2>Listado de categorías</h2>				
                        <span id="dt-loader" class="jarviswidget-loader" style="display: none;"><i class="fa fa-refresh fa-spin"></i></span>
                    </header>

                    <!-- widget div-->
                    <div role="content">
                        
                        <!-- widget content -->
                        <div class="widget-body no-padding">
                            <table id="subcategorias" class="table table-striped table-bordered table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th>Subcategoría</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <!-- /widget content -->

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
<!-- /PRODUCTO -->