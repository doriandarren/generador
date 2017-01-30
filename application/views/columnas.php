<div class="container">
    <div class="rows">
        <div class="panel panel-warning">
            <div class="panel-heading">
                TABLAS                
            </div>
            <div class="panel-body">
                <div>
                    COLUMNAS DE LA TABLA: <?= $nombre_tabla?>
                </div>
                
                <?php
                $attributes = array('name' => 'formx', 
                    'id' => 'formx', 
                    'class' => 'form-horizontal formular', 
                    'role' => 'form');
                echo form_open('Generador/generar_archivo/', $attributes);
                ?>
                <input type="hidden" name="nombre_bd" id="nombre_bd" value="<?= $nombre_bd?>">
                <input type="hidden" name="nombre_tabla" id="nombre_tabla" value="<?= $nombre_tabla?>">
                <div class="checkbox">
                    GENERAR: 
                    <label>
                        <input type="checkbox" name="tipo[]" value="0" id="modelo" checked>Modelo | 
                    </label>                     
                    <label>
                        <input type="checkbox" name="tipo[]" value="1" id="controlador" checked>Controlador |
                    </label>
                    <label>
                        <input type="checkbox" name="tipo[]" value="2" id="vistap" checked>Vista Principal |
                    </label>
                    <label>
                        <input type="checkbox" name="tipo[]" value="3" id="vistaf" checked>Vista Formulario
                    </label>
                </div>
                
                <?php                
                foreach($columnas as $in => $val){
                    foreach ($val as $v){
                        ?>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="titulos[<?php echo trim($v); ?>]" 
                                       value="<?php echo trim($v); ?>" id="<?php echo "ti_".$in; ?>" 
                                       checked><?php echo trim($v); ?>
                            </label>
                        <!--<select name="tipo[]" id="<?php //echo "tp_".$in; ?>">
                            <option value="i">input</option>
                            <option value="t">textarea</option>
                            <option value="s">select</option>
                            <option value="c">checkbox</option>
                            <option value="r">radio</option>
                        </select>-->
                        </div>
                        <?php                      
                    }   
                }
                
                ?>
                
                <div class="col-sm-4 col-sm-offset-6">
                    <button type="submit" id="consultar" class="btn btn-primary">Generar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="resultado"></div>