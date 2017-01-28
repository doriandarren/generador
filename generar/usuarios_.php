<div class="col-md-12 text-center">
    <h1>USUARIOS</h1>
</div> 
<div class="col-md-12">
    <a href="<?= site_url('admin/usuarios/nueva') ?>" class="btn btn-success">Nueva</a>
</div>

   
<div class="row">         
    <?php
    if ($datos) {
        ?>       
        <div class="col-md-12 table-responsive w-margen-50">                    
            <table class="table" id="mi_tabla">
                <thead>
                    <tr>
<th>#</th><th>ID</th><th>NOMBRE</th><th>ACRONIMO</th><th>EMAIL</th><th>CLAVE</th><th>FECHA CREACION</th><th>FECHA MODIFICACION</th><th>FECHA CONEXION</th><th>BLOQUEO</th><th>USUARIO TIPO ID</th><th>CONFIRMAR EMAIL</th><th>CONFIRMAR URL</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($datos as $row) {
                        ?>
                        <tr>
<td><?= $i ?></td><td><?= $row->id?></td><td><?= $row->nombre?></td><td><?= $row->acronimo?></td><td><?= $row->email?></td><td><?= $row->clave?></td><td><?= $row->fecha_creacion?></td><td><?= $row->fecha_modificacion?></td><td><?= $row->fecha_conexion?></td><td><?= $row->bloqueo?></td><td><?= $row->usuario_tipo_id?></td><td><?= $row->confirmar_email?></td><td><?= $row->confirmar_url?></td><td>
                                <a href="<?= site_url('admin/usuarios/nueva') . '/' . $row->id ?>" class="btn btn-info">Editar</a>
                                <a href="<?= site_url('admin/usuarios/eliminar') . '/' . $row->id ?>" class="btn btn-danger" title="Eliminar" onclick="return confirm('Eliminar este Registro?')">Eliminar</a>
                            </td>
            
                        </tr>                      
                        <?php
                        $i++;
                    }
                ?>        
            </tbody>                        
        </table>                    
    </div>
    <?php } ?>
</div>
