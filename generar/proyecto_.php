<div class="row">
                <div class="col-md-12 text-center">
                    <h1>PROYECTO</h1>
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
                    echo form_open('admin/proyectos/guardar/', $attributes); ?>
                    <input type="hidden" name="id" value="<?= $id ?>">
<div class="form-group">
                    <label for="nombre" class="control-label col-sm-2">Nombre</label>
                    <div class="col-sm-4">
                        <input type="text" name="nombre" id="nombre" 
                               class="form-control" value="<?= $nombre ?>" placeholder="nombre">
                    </div><?= form_error('nombre'); ?>
                </div>
<div class="form-group">
                    <label for="descripcion" class="control-label col-sm-2">Descripcion</label>
                    <div class="col-sm-4">
                        <input type="text" name="descripcion" id="descripcion" 
                               class="form-control" value="<?= $descripcion ?>" placeholder="descripcion">
                    </div><?= form_error('descripcion'); ?>
                </div>
<div class="col-sm-4 col-sm-offset-6">
                    <button type="submit" id="consultar" class="btn btn-primary">Guardar</button>
                </div>
                </form>
                
        </div>
    </div>
</div>

