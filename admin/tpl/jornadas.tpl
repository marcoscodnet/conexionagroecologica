 <!-- RIBBON -->
<div id="ribbon">

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Jornadas Técnicas</li><li>Listado</li>
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
                Jornadas Técnicas
                <span>>  
                    Listado
                </span>
            </h1>
        </div>
        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8 text-right">
            <a href="jornada" class="btn btn-success"><span class="fa fa-plus"></span> Cargar Jornada</a>
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
                        <span class="widget-icon"> <i class="fa fa-list"></i> </span>
                        <h2>Listado de Jornadas Técnicas</h2>				
                        <span id="dt-loader" class="jarviswidget-loader" style="display: none;"><i class="fa fa-refresh fa-spin"></i></span>
                    </header>

                    <!-- widget div-->
                    <div role="content">

                        <!-- widget content -->
                        <div class="widget-body no-padding">
                            <table id="jornadas" class="table table-striped table-bordered table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th>Título</th>
                                        <th>Blog</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <p>&nbsp;</p>
                            <p class="text-right"><a href="jornada" class="btn btn-success"><span class="fa fa-plus"></span> Cargar jornada</a>&nbsp;&nbsp;</p>
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