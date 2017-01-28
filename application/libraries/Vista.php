<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vista {
   
     /***********************************
    ************************************
     *          VISTA    
    ************************************
     *      */   
    public function generarVista($nombre_tabla, $campos, $array_tabla) {
        $file = fopen("generar/".$array_tabla[1]."_u.php", "w") or die("Error al Crear el archivo");
        //Creo el header
        fwrite($file, '<?= $this->load->view(\'admin_v/header\', TRUE) ?>' . PHP_EOL);
                
        $body = '';
        $body .= '<div class="container-fluid">
                    <div class="rows">
                        <div class="panel panel-info">
                            <div class="panel-heading">'.
                            strtoupper($array_tabla[1]).
                            '</div>
                            <div class="panel-body">'.
                '<?php $attributes = array(\'name\' => \'formx\', 
                    \'id\' => \'formx\', 
                    \'class\' => \'form-horizontal formular\', 
                    \'role\' => \'form\');
                    echo form_open(\'admin_c/generador_c/buscar_columnas/\', $attributes); ?>';
                
        fwrite($file, $body . PHP_EOL);
        
        foreach($campos as $val){  
            $input = '<div class="form-group">
                    <label for="'.$val.'" class="control-label col-sm-2">'.$val.'</label>
                    <div class="col-sm-4">
                        <input type="text" name="'.$val.'" id="'.$val.'" 
                               class="form-control" value="<?= $'.$val.' ?>" placeholder="'.$val.'">
                    </div><?= form_error(\''.$val.'\'); ?>
                </div>';           
            fwrite($file, $input . PHP_EOL);            
        }
        
        $final = '<div class="col-sm-4 col-sm-offset-6">
                    <button type="submit" id="consultar" class="btn btn-primary">Guardar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>';
        
        fwrite($file,$final . PHP_EOL);
        //Creo el footer
        fwrite($file, '<?= $this->load->view(\'admin_v/footer\', TRUE) ?>' . PHP_EOL);
        
        fclose($file);
    }

}
