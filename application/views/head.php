<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">     
        <!-- BOOTSTRAP-->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?= $title_head ?></title>

        <!--CSS-->
        <link href="<?= base_url("public/css/bootstrap.css") ?>" rel="stylesheet" />      
        <link href="<?= base_url("public/css/style_boostrap.css") ?>" rel="stylesheet" />
        <link href="<?= base_url("public/font-awesome/css/font-awesome.css") ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url("public/css/style.css") ?>" rel="stylesheet" />    

<?php
if (isset($css)) {
    foreach ($css as $file) {
        ?>
                <link href="<?= base_url("public/css/{$file}.css") ?>" rel="stylesheet" />
            <?php
            }
        }
        ?>    
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>

        <div class="container">
            <div class="jumbotron">
                <h1>Generador Codeigniter</h1> 
                <p>Codeigniter y Bootstrap son los más populares HTML, CSS, and JS 
                    framework para desarrolladores en responsive, 
                    mobile de proyectos en la web.</p> 
            </div>
        </div>

        <!-- Navigation -->
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">             
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>     

                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li><a href="<?= base_url() ?>">Inicio</a></li>
                                <li><a href="<?= site_url('Generador') ?>">Generador</a></li>    
                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
            </div>
        </div>

        <?php if (isset($this->breadCrumbs)) { ?>
            <div class="container">
                <div class="row">
                    <ol class="breadcrumb">
                        <li><a href="<?= site_url('Principal') ?>">Inicio</a></li>
                        <?php
                        foreach ($this->breadCrumbs as $breadCrumb) {
                            if (isset($breadCrumb['href'])) {
                                ?>
                                <li><a href="<?= $breadCrumb['href'] ?>"><?= $breadCrumb['text'] ?></a></li>
                            <?php } else { ?>
                                <li class="active"><?= $breadCrumb['text'] ?></li>
                                <?php
                            }
                        }
                        ?>
                    </ol> 
                </div>        
            </div>
        <?php } ?> 

        <?php if (isset($msj) && count($msj) > 0) { ?>    
            <div class="container w-margen-50" id='transaccion'>
                <div class="row">    
                    <div class="col-md-4 col-md-offset-4 <?= $msj[0] ?>" role="alert">
                        <?= $msj[1] ?>
                    </div>
                </div>        
            </div>
            <?php
        }
        ?>