 <!-- RIBBON -->
<div id="ribbon">

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Nos apoyan</li><li>${accion}</li>
    </ol>
    <!-- /breadcrumb -->

</div>
<!-- /RIBBON -->

 <!-- SPONSOR -->
<div id="content">

    <!-- row -->
    <div class="row">

        <!-- col -->
        <div class="col-xs-12 col-sm-7 col-md-4">
            <h1 class="page-title txt-color-blueDark">

                <!-- PAGE HEADER -->
                <i class="fa-fw fa fa-thumbs-up "></i> 
                Nos apoyan 
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

            <!-- WIDGET SPONSOR -->
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
                            
                            <form id="formSponsor" action="php/controllers/nosApoyan.controller.php" method="post" class="smart-form" enctype="multipart/form-data">

                                <fieldset>

                                    <div class="row">
                                        
                                        <div class="col col-md-8 col-sm-7 col-xs-12">
                                            <div class="row">
                                                <section class="col col-md-12 col-sm-12 col-xs-12">
                                                    <label class="label">Nombre</label>
                                                    <label class="input">
                                                        <input autofocus="autofocus" type="text" name="nombre" value="${nombre}" />
                                                    </label>
                                                </section>
                                                <section class="col col-md-12 col-sm-12 col-xs-12">
                                                    <label class="label">Link</label>
                                                    <label class="input">
                                                        <input type="text" name="link" value="${link}" />
                                                    </label>
                                                </section>
                                                <section class="col col-md-12 col-sm-12 col-xs-12">
                                                    <label class="label">Categor&iacute;a</label>
                                                    <label class="select">
                                                        ${categoriaToSelect}<i></i>
                                                    </label>
                                                </section>
                                                <section class="col col-md-12 col-sm-12 col-xs-12">
                                                    <label class="label">Tama&ntilde;o</label>
                                                    <label class="select">
                                                        ${sizeToSelect}<i></i>
                                                    </label>
                                                </section>
                                            </div>
                                        </div>
                                        
                                                    
                                        <section class="col col-md-4 col-sm-5 col-xs-12">
                                            <label class="label margin-top-5">Imagen</label>
                                            <div class="vista-previa imagenUploader">
                                                <a data-src="${imagen}" class="btn btn-mini btn-danger borrarImagen" data-id="${imagenId}"><i class="fa fa-trash-o"></i></a>
                                                <p class="info"><i style="display: none" class="fa fa-circle-o-notch fa-spin"></i> <span>Click para cargar la imagen</span></p>
                                                <img class="img-responsive inputFileDispacher" src="${imagen}">
                                            </div>
                                        </section>
                                    </div>
                                            
                                </fieldset>
                                <div id="responsablesAutocompleContainer" style="width: 250px"></div>
                                <input type="hidden" name="redirect" value="1" />
                                <input type="hidden" name="imgprefix" value="${imgprefix}" />
                                <input type="hidden" name="id" value="${id}" />
                            </form>
                            
                            <div class="widget-footer smart-form">
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-success saveForm" type="submit">
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
            <!-- /WIDGET SPONSOR -->

        </div>

        <!-- /row -->

    </section>
    <!-- /widget grid -->

</div>
<!-- /SPONSOR -->