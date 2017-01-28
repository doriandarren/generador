<div class="row">
                <div class="col-md-12 text-center">
                    <h1>USUARIO</h1>
                </div>
            </div>           
<div class="row">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                            FORMULARIO DE REGISTRO
                            </div>
                            <div class="panel-body"><?php $attributes = array('name' => 'formx', 
                    'id' => 'formx', 
                    'class' => 'form-horizontal formular', 
                    'role' => 'form');
                    echo form_open('admin/usuarios/guardar/', $attributes); ?>
                    <input type="hidden" name="id" value="<?= $id ?>">
<div class="form-group">
                    <label for="nombre" class="control-label col-sm-2">Nombre</label>
                    <div class="col-sm-4">
                        <input type="text" name="nombre" id="nombre" 
                               class="form-control" value="<?= $nombre ?>" placeholder="nombre">
                    </div><?= form_error('nombre'); ?>
                </div>
<div class="form-group">
                    <label for="acronimo" class="control-label col-sm-2">Acronimo</label>
                    <div class="col-sm-4">
                        <input type="text" name="acronimo" id="acronimo" 
                               class="form-control" value="<?= $acronimo ?>" placeholder="acronimo">
                    </div><?= form_error('acronimo'); ?>
                </div>
<div class="form-group">
                    <label for="email" class="control-label col-sm-2">Email</label>
                    <div class="col-sm-4">
                        <input type="text" name="email" id="email" 
                               class="form-control" value="<?= $email ?>" placeholder="email">
                    </div><?= form_error('email'); ?>
                </div>
<div class="form-group">
                    <label for="clave" class="control-label col-sm-2">Clave</label>
                    <div class="col-sm-4">
                        <input type="text" name="clave" id="clave" 
                               class="form-control" value="<?= $clave ?>" placeholder="clave">
                    </div><?= form_error('clave'); ?>
                </div>
<div class="form-group">
                    <label for="fecha_creacion" class="control-label col-sm-2">Fecha Creacion</label>
                    <div class="col-sm-4">
                        <input type="text" name="fecha_creacion" id="fecha_creacion" 
                               class="form-control" value="<?= $fecha_creacion ?>" placeholder="fecha_creacion">
                    </div><?= form_error('fecha_creacion'); ?>
                </div>
<div class="form-group">
                    <label for="fecha_modificacion" class="control-label col-sm-2">Fecha Modificacion</label>
                    <div class="col-sm-4">
                        <input type="text" name="fecha_modificacion" id="fecha_modificacion" 
                               class="form-control" value="<?= $fecha_modificacion ?>" placeholder="fecha_modificacion">
                    </div><?= form_error('fecha_modificacion'); ?>
                </div>
<div class="form-group">
                    <label for="fecha_conexion" class="control-label col-sm-2">Fecha Conexion</label>
                    <div class="col-sm-4">
                        <input type="text" name="fecha_conexion" id="fecha_conexion" 
                               class="form-control" value="<?= $fecha_conexion ?>" placeholder="fecha_conexion">
                    </div><?= form_error('fecha_conexion'); ?>
                </div>
<div class="form-group">
                    <label for="bloqueo" class="control-label col-sm-2">Bloqueo</label>
                    <div class="col-sm-4">
                        <input type="text" name="bloqueo" id="bloqueo" 
                               class="form-control" value="<?= $bloqueo ?>" placeholder="bloqueo">
                    </div><?= form_error('bloqueo'); ?>
                </div>
<div class="form-group">
                    <label for="usuario_tipo_id" class="control-label col-sm-2">Usuario Tipo Id</label>
                    <div class="col-sm-4">
                        <input type="text" name="usuario_tipo_id" id="usuario_tipo_id" 
                               class="form-control" value="<?= $usuario_tipo_id ?>" placeholder="usuario_tipo_id">
                    </div><?= form_error('usuario_tipo_id'); ?>
                </div>
<div class="form-group">
                    <label for="confirmar_email" class="control-label col-sm-2">Confirmar Email</label>
                    <div class="col-sm-4">
                        <input type="text" name="confirmar_email" id="confirmar_email" 
                               class="form-control" value="<?= $confirmar_email ?>" placeholder="confirmar_email">
                    </div><?= form_error('confirmar_email'); ?>
                </div>
<div class="form-group">
                    <label for="confirmar_url" class="control-label col-sm-2">Confirmar Url</label>
                    <div class="col-sm-4">
                        <input type="text" name="confirmar_url" id="confirmar_url" 
                               class="form-control" value="<?= $confirmar_url ?>" placeholder="confirmar_url">
                    </div><?= form_error('confirmar_url'); ?>
                </div>
<div class="col-sm-4 col-sm-offset-6">
                    <button type="submit" id="consultar" class="btn btn-primary">Guardar</button>
                </div>
                </form>
                
        </div>
    </div>
</div>

