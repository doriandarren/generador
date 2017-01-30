<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12">                
                <ul>
                    <li><a href="<?= site_url('Nosotros'); ?>">Nosotros</a></li>
                    <li><a href="<?= site_url('Contacto'); ?>">Contacto</a></li>
                </ul>
            </div>
            <div class="col-md-12 text-center"> 
                <ul class="list-inline w-social-icons">
                    <li>Síguenos:</li>
                    <li><a href="https://facebook.com/wizakor" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://twitter.com/wizakorweb" target="_blank"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="https://plus.google.com/u/0/100630560101846759810/posts" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="https://www.instagram.com/wizakorweb/?ref=badge" target="_blank"><i class="fa fa-instagram"></i></a></li>
                </ul>
                <ul>
                    <li>Copyright © Wizakor - 2016. Todos lo derechos reservados.</li>
                    <li class="tb-copyright">Página Mostrada en: <strong>{elapsed_time}</strong> segundos.</li>
                </ul> 
            </div>
        </div>
    </div>
</footer>
    <!--JS-->
    <script src="<?= base_url("public/js/jquery-2.2.0.min.js") ?>"></script> 
    <script src="<?= base_url("public/js/bootstrap.js") ?>"></script> 
    
    <!--ANIMACION-->
    <script src="<?= base_url("public/js/animated-header.js") ?>"></script> 
    
    <!-- Personales -->   
    <?php
    if (isset($js)) {
        foreach ($js as $file) {
            ?>
            <script src="<?= base_url("public/js/{$file}.js") ?>"></script>
        <?php }
    }
    ?> 
    <script src="<?= base_url("public/js/comun.js") ?>"></script> 
</body>
</html>
