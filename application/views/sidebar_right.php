<div class="col-md-12">
<iframe src="http://rcm-eu.amazon-adsystem.com/e/cm?t=wizakor-21&o=30&p=12&l=ur1&category=videojuegos&banner=1RX48D6WZRXCY43X4EG2&f=ifr" width="300" height="250" scrolling="no" border="0" marginwidth="0" style="border:none;" frameborder="0"></iframe>
</div>

<div class="col-md-12">
<div class="panel panel-default">
    <div class="panel-heading">
        Tweets por @wizakorweb
    </div>
    <div class="panel-body">
        <p>
            <a class="twitter-timeline" href="https://twitter.com/wizakorweb" data-widget-id="692716675163111424">Tweets por el @wizakorweb.</a>
            <script>!function(d, s, id){var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location)?'http':'https'; if (!d.getElementById(id)){js = d.createElement(s); js.id = id; js.src = p + "://platform.twitter.com/widgets.js"; fjs.parentNode.insertBefore(js, fjs); }}(document, "script", "twitter-wjs");</script>           
        </p> 
    </div>
</div> 
</div>
<?php

if ($etiquetas) {
    $array_eti = explode(",", $etiquetas);
    ?>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                ETIQUETAS
            </div>
            <div class="panel-body">
                <?php
                foreach ($array_eti as $row) {
                    if (!empty($row)) {
                        ?>
                        <div class="etiqueta"><?= $row ?></div>
                        <?php
                    }
                }//CIERRA FOREACH
                ?>
            </div>   
        </div>  
    </div>
    <?php
}//CIERRA IF
?>

<?php
if ($categorias) {
    ?>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            Categorías
        </div>
        <div class="panel-body">
            <ul class="list-unstyled">
            <?php
            foreach ($categorias as $rows) {
                if ($rows->id != 1) {
                    echo '<li><i class="fa fa-check"></i>' . '
                                    <a href="'.  base_url("Categorias/".$rows->descripcion).'" class="btn bg-warning">' .
                    $rows->descripcion . '</a></li>';
                }
            }
            ?>
            </ul> 
        </div>
    </div>
</div>
    <?php
}
?>

<?php
if ($noti_recientes) {
    ?>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            Recientes
        </div>
        <div class="panel-body">
            <?php
            foreach ($noti_recientes as $rows) {
                if ($rows->id != 1) {
                    echo '<p><i class="fa fa-circle-o"></i>'
                    . '<a href="'.  base_url("Noticia/".$rows->url).'">' 
                    . $rows->titulo . '</a></p>';
                }
            }
            ?>
        </div>
    </div>
</div>
    <?php
}
?>

<div class="col-md-12">
<iframe src="http://rcm-eu.amazon-adsystem.com/e/cm?t=wizakor-21&o=30&p=8&l=as1&asins=B00BJ1AMXE&ref=tf_til&fc1=000000&IS2=1&lt1=_blank&m=amazon&lc1=0000FF&bc1=000000&bg1=FFFFFF&f=ifr" style="width:120px;height:240px;" scrolling="no" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>

