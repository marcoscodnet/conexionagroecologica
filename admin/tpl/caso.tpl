 <!-- RIBBON -->
<div id="ribbon">

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Casos de conexión</li><li>${accion}</li>
    </ol>
    <!-- /breadcrumb -->

</div>
<!-- /RIBBON -->

 <!-- CASO -->
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
                            
                            <form action="php/controllers/caso.controller.php" method="post">

                                <fieldset class="smart-form">

                                    <div class="row">
                                        <section class="col col-md-4 col-sm-4 col-xs-12">
                                            <label class="label">Título</label>
                                            <label class="input">
                                                <input autofocus="autofocus" type="text" name="titulo" value="${titulo}" />
                                            </label>
                                        </section>

                                        <section class="col col-md-2 col-sm-2 col-xs-12">
                                            <label class="label">Categoría</label>
                                            <label class="select">
                                                ${ubicacionToSelect}<i></i>
                                            </label>
                                        </section>
                                            
                                        
                                            
                                       
                                            
                                        <section class="col col-md-2 col-sm-3 col-xs-12">
                                            <label class="label margin-top-5">Destacado</label>
                                            <label class="select">
                                                <span class="onoffswitch">
                                                    <input type="checkbox" name="destacado" class="onoffswitch-checkbox" id="destacado" ${checked}>
                                                    <label class="onoffswitch-label" for="destacado"> 
                                                        <span class="onoffswitch-inner" data-swchon-text="SI" data-swchoff-text="NO"></span> 
                                                        <span class="onoffswitch-switch"></span> 
                                                    </label> 
                                                </span>
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
                                <input type="hidden" name="redirect" value="1" />
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
            
            <!-- WIDGET IMAGENES -->
            <article id="images-uploader" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                
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
                        <span class="widget-icon"> <i class="fa-fw fa fa-picture-o"></i>  </span>
                        <h2>Imágenes</h2>	
                        <div class="widget-toolbar" style="display: none"> 
                            <div class="progress progress-striped active" rel="tooltip" data-original-title="0%" data-placement="bottom">
                                <div class="progress-bar progress-bar-success" role="progressbar" style="width: 0%">0 %</div>
                            </div>
                        </div>
                    </header>
                        
                    <!-- widget div-->
                    <div>                                
                            <div class="row hidden-mobile">
                                    
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-align-right">
                                    <div class="page-title">
                                        <form id="imagesUploader" action="php/uploaders/casoImagen.uploader.php" method="post" enctype="multipart/form-data">
                                            <label class="btn btn-primary" for="fileInput">Cargar imágenes</label>
                                            <input class="hidden" id="fileInput" onchange="forceUpload();"  type="file" name="files[]" multiple>
                                            <input class="hidden" id="mySubmit" type="submit" value="Upload File to Server">
                                            <input type="hidden" name="imgprefix" value="${imgprefix}" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                                
                            <!-- row -->
                            <div class="row">
                                
                                <!-- SuperBox -->
                                <div class="images-upload col-sm-12">
                                    ${imagenes}
                                </div>
                                <!-- /SuperBox -->
                                    
                                    
                            </div>
    
                            <!-- end row -->
            
            
            
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
            <!-- /WIDGET IMAGENES -->

        </div>

        <!-- /row -->

    </section>
    <!-- /widget grid -->

</div>
<!-- /CASO -->