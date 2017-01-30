<div class="container">
    <div class="rows">      
        <div class="col-md-12"><?php //var_dump($bases_datos) ?></div>
    </div>
</div>
<div class="container">
    <div class="rows">        
        <div class="panel panel-info">
            <div class="panel-heading">
                BASE DE DATOS
            </div>
            <div class="panel-body">
                <?php
                $attributes = array('name' => 'formx', 
                    'id' => 'formx', 
                    'class' => 'form-horizontal formular', 
                    'role' => 'form');
                echo form_open('Generador/buscar_columnas/', $attributes);
                ?>
                <div class="form-group">
                    <label for="nombre_bd" class="control-label col-sm-2">Nombre Base Datos:</label>
                    <div class="col-sm-4">
                        <input type="text" name="nombre_bd" id="nombre_bd" 
                               class="form-control" value="<?= $nombre_bd ?>" placeholder="Base Datos" required>
                    </div><?= form_error('nombre_bd'); ?>
                </div>
                
                <div class="form-group <?php
                if (form_error('nombre_tabla')) {
                    echo 'has-error';
                }
                ?>">
                    <label for="nombre_tabla" class="col-sm-2 control-label">Nombre Tabla:</label>
                    <div class="col-sm-4">
                        <input type="text" name="nombre_tabla" id="nombre_tabla" class="form-control" placeholder="Tabla" value="<?= $nombre_tabla ?>" required>
                        <?= form_error('nombre_tabla'); ?>
                    </div>
                </div>                
                <div class="col-sm-4 col-sm-offset-6">
                    <button type="submit" id="consultar" class="btn btn-primary">Buscar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>