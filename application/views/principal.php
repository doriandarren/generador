<!--
<div class="container-fluid w-margen-50 bloque parallax imagen-1"></div>
-->
<div class="container-fluid w-margen-50">
    <div class="row">         
        <!-- COLUMNA IZQUIERDA-->
        <div class="col-md-8">    
            <div class="col-md-12">
                <img alt="img" src="<?= base_url()."public/img/banner_noticias.jpg"?>" class="img-responsive">             
            </div>            
            
            <div class="col-md-12 w-margen-50">                
                    <div class="col-md-6"> 
                <div class="panel panel-default">
                    <div class="panel-title text-center">
                        WiBlog - Blog de Noticias
                    </div>                
                    <div class="panel-body">
                        <p>Nuestra sección del sitio de entretenimiento distracción, 
                            noticias y acontecimientos importantes, nuevos lanzamientos, tecnología,
                            ocio.
                            <br>Entra y difruta. Animate!!!
                        </p>
                        <p class="text-center">
                            <a href="<?= site_url('Noticias') ?>" class="btn btn-info">Ver más</a>
                        </p>
                    </div> 
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-title text-center">
                        Tu Amigo en la Web
                    </div>                
                    <div class="panel-body"> 
                        <p>Te invita a entrar y registrar!</p>
                        <p class="text-center">                    
                            <a href="<?= site_url('Registro') ?>" class="btn btn-info">Registrarse</a>
                        </p>
                    </div>
                </div>
            </div>
                                
            </div>
                   
                        
        </div><!-- FIN COLUMNA IZQUIERDA-->

        <!-- COLUMNA DERECHA-->
        
        <div class="col-md-4">             
            <div class="col-md-12 w-bordes-div w-gradiente-1">
                <h1>Columna Derecha</h1>
                <p>
                    Hola soy la columna derecha
                </p>                    
            </div>               
            <?= $sidebar_right ?>            
        </div><!-- FIN COLUMNA DERECHA-->
    </div>
</div>