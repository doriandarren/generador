<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Generador extends MY_Controller {

    private $title_head = 'Generador';
    private $nombre_bd='';
    private $nombre_tabla='';
    /*
     * VARIABLES CON MSJ:
     * alert alert-info
     * alert alert-success
     * alert alert-danger
     *      */
    public $msj = NULL;

    public function __construct() {
        parent::__construct();
        $this->load->model('Generador_m');
    }

    public function index() {     
        $data_head['title_head'] = $this->title_head;
        $data_head['msj'] = $this->msj;
        
        $datos['nombre_bd']= $this->nombre_bd;
        $datos['nombre_tabla']= $this->nombre_tabla;
        
        $this->breadCrumbs[] = array('text' => 'Tablas'); 
        
        $this->load->view('head', $data_head);
        $this->load->view('tablas', $datos);
        $this->load->view('footer', TRUE);
    }

    function buscar_columnas(){
        $this->form_validation->set_rules('nombre_bd', 'Nombre Bd', 'trim|required|xss_clean');
        $this->form_validation->set_rules('nombre_tabla', 'Nombre Tabla', 'trim|required|xss_clean');
        
        $data_head['title_head'] = 'Buscar Columnas';
        $datos['nombre_bd'] = trim($this->input->post("nombre_bd"));
        $datos['nombre_tabla'] = trim($this->input->post("nombre_tabla"));
                
        $datos['columnas'] = $this->Generador_m->buscar_columna_tabla($datos['nombre_bd'],$datos['nombre_tabla']);
        
        if ($this->form_validation->run() == FALSE){
            //$this->mensajePersonalizado('alert-danger','Error: No aparece la Tabla');
            $this->breadCrumbs[] = array('text' => 'Tablas'); 
            $this->load->view('head', $data_head);
            $this->load->view('tablas', $datos);
            $this->load->view('footer', TRUE);            
        }else{          
            
            $this->breadCrumbs[] = array('text' => 'Tablas','href'=>  site_url('Generador/index'));         
            $this->breadCrumbs[] = array('text' => 'Columnas');                        
            $this->load->view('head', $data_head);
            $this->load->view('columnas', $datos);
            $this->load->view('footer', TRUE);
        }
    }    
    
    function generar_archivo(){          
        $nombre_bd=trim($this->input->post("nombre_bd"));
        $nombre_tabla=trim($this->input->post("nombre_tabla"));
        $campos=$this->input->post("titulos");  
        $tipo=$this->input->post("tipo");    
        
        if(in_array('0', $tipo, true)){
            $this->generarModelo($nombre_tabla, $campos, $nombre_bd);
        }

        if(in_array('1', $tipo, true)){
            $this->generarControlador($nombre_tabla, $campos, $nombre_bd); 
        }
            
        if(in_array('2', $tipo, true)){
            $this->generarVistaPrincipal($nombre_tabla, $campos, $nombre_bd);
        }
        
        if(in_array('3' ,$tipo, true)){
            $this->generarVistaFormulario($nombre_tabla, $campos, $nombre_bd);
        }
        
        $this->nombre_bd = $nombre_bd;  
        $this->nombre_tabla = $nombre_tabla;
        $this->mensajePersonalizado('alert-success','Datos generados table: '.$nombre_tabla);               
    }
    
    
    /***********************************
    ************************************
     *          MODELO     
    ************************************
     *      */    
    function generarModelo($nombre_tabla, $campos, $nombre_bd) {
        //MODELO ---------------------
        $file = fopen("generar/".strtolower($nombre_tabla)."_m.php", "w") or die("Error al Crear el archivo");
        
        $cuerpo = '<?php
defined(\'BASEPATH\') OR exit(\'No direct script access allowed\');
class '.ucwords($nombre_tabla).'_m extends CI_Model {
public $table_name = \''.$nombre_tabla.'\';';
    
        fwrite($file, $cuerpo . PHP_EOL);
        
        
        foreach($campos as $val){  
            $input = 'private $'.$val.';';
            fwrite($file, $input . PHP_EOL);            
        }
        
        $cuerpo = 'function __construct() {
            parent::__construct();      
            $this->load->database();
        }
        
        /******************
        * FUNCIONES GETTER
        ****************** */';
        
        fwrite($file, $cuerpo . PHP_EOL);
        
        foreach($campos as $val){  
            $input = 'function get_'.$val.'(){
                return $this->'.$val.';
            }';
            fwrite($file, $input . PHP_EOL);            
        }
        
        
        $cuerpo = '/******************
        * FUNCIONES SETTER
        *******************/';
        fwrite($file, $cuerpo . PHP_EOL); 
        
        $cuerpo = 'function set_variables_on($query){
            foreach($query->result() as $row){';                
                fwrite($file, $cuerpo . PHP_EOL);                
                foreach($campos as $val){  
                    $input = '$this->'.$val.' = $row->'.$val.';';
                    fwrite($file, $input . PHP_EOL);            
                }                
        $cuerpo = '
            }
        }';
        fwrite($file, $input . PHP_EOL); 
        
        
        $cuerpo = 'function set_variables_off() {';
        fwrite($file, $cuerpo . PHP_EOL);
        foreach($campos as $val){                 
                $pos = strpos($val, '_id');
                if($val==='id' || $pos > 0){
                    $input = '$this->'.$val.' =0;';
                }else{
                    $input = '$this->'.$val.' = \'\';';
                }
                fwrite($file, $input . PHP_EOL);            
            }
        $cuerpo = '}';
        fwrite($file, $cuerpo . PHP_EOL);
        
        $cuerpo = 'function setear($id){
        $id = intval($id);
        $this->db->where(\'id\',$id);
        $this->db->select(\'*\');
        $query = $this->db->get($this->table_name);
        if($query->result()){            
            $this->set_variables_on($query);
        }else{';
             
            fwrite($file, $cuerpo . PHP_EOL); 
             
            
    $cuerpo = '    
    function upsert($data){
        $this->db->where(\'id\', $data[\'id\']);
        $this->db->select(\'id\');
        $query = $this->db->get($this->table_name);
        if ($query->result()) {
            $this->db->set($data);
            $this->db->where(\'id\', $data[\'id\']);
            $this->db->update($this->table_name, $data);
        } else {
            unset($data[\'id\']);
            $this->db->set($data);
            $this->db->insert($this->table_name);
        }
        if ($query->result() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    function listar($where = NULL, $limit = NULL){           
        if($where!=NULL){            
            foreach ($where as $key => $value) {
                $this->db->where($key,$value);
            }
        }           
        $query = $this->db->get_where($this->table_name);       
        //echo "<br>".$this->db->last_query();
        //exit();
        if($query->result()){
            return $query->result();
        }else{
            return 0;
        }        
    }

    public function eliminar($id) {
        $id = intval($id);
        $this->db->where(\'id\', $id);
        $this->db->delete($this->table_name); 
        if (empty ($query)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
}
/* End of file '.$nombre_tabla.'_m.php */
/* Location: ./application/model/'.$nombre_tabla.'_m.php */';        
        fwrite($file, $cuerpo . PHP_EOL);
        fclose($file);
        
    }
    
    
     /***********************************
    ************************************
     *          CONTROLADOR    
    ************************************
     *      */       
    public function generarControlador($nombre_tabla, $campos, $nombre_bd) {
        $form = substr($nombre_tabla,0,-1);
        
        $file = fopen("generar/".strtolower($nombre_tabla)."_c.php", "w") or die("Error al Crear el archivo");
             
        $cuerpo = '<?php
        defined(\'BASEPATH\') OR exit(\'No direct script access allowed\');
        class '.strtolower($nombre_tabla).' extends MY_Admin {';
            
        
        $cuerpo .= '
            /*
            * VARIABLES CON MSJ:
            * alert alert-info
            * alert alert-success
            * alert alert-danger
            *      */
            public $msj = NULL;
            private $title_head = \''.ucwords($nombre_tabla).'\';
            private $directorio = \'admin/\';
        
            function __construct() {
                parent::__construct();
                $this->load->model(\''.strtolower($nombre_tabla).'_m\');
            }

            public function index() {
                $data[\'title_head\'] = $this->title_head;
                $data[\'msj\'] = $this->msj;

                $datos[\'datos\'] = $this->'.strtolower($nombre_tabla).'_m->listar();

                //JS PUBLICOS
                $data[\'js\'] = array(\'tablas/jquery.dataTables\',\'tablas/dataTables.bootstrap\',\'tablas/mi_tabla\');

                $this->breadCrumbs[] = array(\'text\' => \''.strtolower($nombre_tabla).'\');

                $this->load->view($this->directorio . \'plantilla/head\', $data);
                $this->load->view($this->directorio . strtolower($this->title_head),$datos);
                $this->load->view($this->directorio . \'plantilla/footer\');
            }

            public function nueva($id=NULL) {     
                if($id==NULL){
                    $id=0;
                }
                $data[\'title_head\'] = $this->title_head;
                $data[\'msj\'] = $this->msj;
                
                $this->'.strtolower($nombre_tabla).'_m->setear($id);';        
        fwrite($file, $cuerpo . PHP_EOL);
        
        foreach($campos as $val){  
            $input = '$data[\''.$val.'\']= $this->'.strtolower($nombre_tabla).'_m->get_'.$val.'();';           
            fwrite($file, $input . PHP_EOL);            
        }
     
        $cuerpo = '  
                $this->breadCrumbs[] = array(\'text\' => \''.ucwords($nombre_tabla).'\', \'href\'=>  site_url($this->directorio . \''.$nombre_tabla.'\'));
                if($id===0){
                    $this->breadCrumbs[] = array(\'text\' => \'Crear\');           
                }else{
                    $this->breadCrumbs[] = array(\'text\' => \'Editar\'); 
                }
                $this->load->view($this->directorio . \'plantilla/head\',$data);        
                $this->load->view($this->directorio . \''.$form.'\', $data);        
                $this->load->view($this->directorio . \'plantilla/footer\');        
            }';
        
        fwrite($file, $cuerpo . PHP_EOL);
        
        
        $cuerpo = 'public function guardar() {'; 
        fwrite($file, $cuerpo . PHP_EOL);

        foreach($campos as $val){  
            $input = '$data[\''.$val.'\']=$this->input->post("'.$val.'", TRUE);';           
            fwrite($file, $input . PHP_EOL);            
        }

        foreach($campos as $val){ 
            $des=  str_replace('_', ' ', $val);
            $input = '$this->form_validation->set_rules(\''.$val.'\',\''.ucwords($des).'\',\'trim|required|xss_clean\');';           
            fwrite($file, $input . PHP_EOL);            
        }
                
        $cuerpo = '
            if ($this->form_validation->run() === FALSE){
            
                $data[\'title_head\'] = $this->title_head;
                $data[\'msj\'] = array(\'alert alert-danger\',\'Error: No se guardaron los datos\');
            
            $this->load->view($this->directorio . \'plantilla/head\',$data);        
            $this->load->view($this->directorio . \''.$form.'\', $data);        
            $this->load->view($this->directorio . \'plantilla/footer\');            
        }else{            
            
            $resultado = $this->'.strtolower($nombre_tabla).'_m->upsert($data);
            if($resultado==TRUE){
                $this->mensajeExito();
            }else{
                $this->mensajePersonalizado(\'alert-danger\',\'Error: NO se pudo guardar\');                
            }
        }        
    }';
        
        
        fwrite($file, $cuerpo . PHP_EOL); 
        
        $cuerpo ='
            public function eliminar($id_e) { 
        
        if($id_e===NULL){
            $this->mensajePersonalizado(\'alert alert-danger\',\'No existe el ID\');
            $this->index();
        }
        $id = intval($id_e);
        
        $resultado = $this->'.strtolower($nombre_tabla).'_m->eliminar($id);
        if ($resultado === TRUE) {
            $this->mensajeExito();
        } else {
            $this->mensajePersonalizado(\'alert alert-danger\',\'Error: no se elimino el registro\'); 
        }
    } ';
        
        $cuerpo .='
        }
        /* End of file '.$nombre_tabla.'.php */
        /* Location: ./application/controller/'.$nombre_tabla.'.php */';

        fwrite($file, $cuerpo . PHP_EOL);
        fclose($file);
    }
    
    
     /***********************************
    ************************************
     *          VISTA    
    ************************************
     *      */   
    
    public function generarVistaPrincipal($nombre_tabla, $campos, $nombre_bd) {
        $file = fopen("generar/".$nombre_tabla."_.php", "w") or die("Error al Crear el archivo");
        
        $des=str_replace('_', ' ', $nombre_tabla);
        
        $cuerpo ='<div class="col-md-12 text-center">
    <h1>'.strtoupper($des).'</h1>
</div> 
<div class="col-md-12">
    <a href="<?= site_url(\'admin/'.strtolower($nombre_tabla).'/nueva\') ?>" class="btn btn-success">Nueva</a>
</div>
';
        fwrite($file, $cuerpo . PHP_EOL); 
    
   
$cuerpo = '   
<div class="row">         
    <?php
    if ($datos) {
        ?>       
        <div class="col-md-12 table-responsive w-margen-50">                    
            <table class="table" id="mi_tabla">
                <thead>
                    <tr>';
        fwrite($file, $cuerpo . PHP_EOL); 

        
                $input='<th>#</th>';        
                foreach($campos as $val){ 
                    $des=  str_replace('_', ' ', $val);
                    $input .= '<th>'.strtoupper($des).'</th>';
                }
                fwrite($file, $input . PHP_EOL); 
                
                $cuerpo = '
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($datos as $row) {
                        ?>
                        <tr>';
            fwrite($file, $cuerpo . PHP_EOL);    
                
                           
                $input = '<td><?= $i ?></td>'; 
                foreach($campos as $val){                     
                    $input .= '<td><?= $row->'.$val.'?></td>';    
                }
                $input .= '<td>
                                <a href="<?= site_url(\'admin/'.strtolower($nombre_tabla).'/nueva\') . \'/\' . $row->id ?>" class="btn btn-info">Editar</a>
                                <a href="<?= site_url(\'admin/'.strtolower($nombre_tabla).'/eliminar\') . \'/\' . $row->id ?>" class="btn btn-danger" title="Eliminar" onclick="return confirm(\'Eliminar este Registro?\')">Eliminar</a>
                            </td>';
                fwrite($file, $input . PHP_EOL);
                
            
                $cuerpo = '            
                        </tr>                      
                        <?php
                        $i++;
                    }
                ?>        
            </tbody>                        
        </table>                    
    </div>
    <?php } ?>
</div>';
        fwrite($file,$cuerpo . PHP_EOL);         
        fclose($file);   
    }
    
    
    public function generarVistaFormulario ($nombre_tabla, $campos, $nombre_bd) {
        
        $form = substr($nombre_tabla,0,-1);
        
        $file = fopen("generar/".$form."_.php", "w") or die("Error al Crear el archivo");
        
        $des=str_replace('_', ' ', $form);
        $body = '';
        $body .= '<div class="row">
                <div class="col-md-12 text-center">
                    <h1>'.strtoupper($des).'</h1>
                </div>
            </div>           
<div class="row">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                            FORMULARIO DE REGISTRO
                            </div>
                            <div class="panel-body">'.
                '<?php $attributes = array(\'name\' => \'formx\', 
                    \'id\' => \'formx\', 
                    \'class\' => \'form-horizontal formular\', 
                    \'role\' => \'form\');
                    echo form_open(\'admin/'.strtolower($nombre_tabla).'/guardar/\', $attributes); ?>
                    <input type="hidden" name="id" value="<?= $id ?>">';
                
        fwrite($file, $body . PHP_EOL);
        
        foreach($campos as $val){  
            $des= str_replace('_', ' ', $val);
            
            if($des!='id'){
            $input = '<div class="form-group">
                    <label for="'.$val.'" class="control-label col-sm-2">'.ucwords($des).'</label>
                    <div class="col-sm-4">
                        <input type="text" name="'.$val.'" id="'.$val.'" 
                               class="form-control" value="<?= $'.$val.' ?>" placeholder="'.$val.'">
                    </div><?= form_error(\''.$val.'\'); ?>
                </div>';    
            
            
            
            
            fwrite($file, $input . PHP_EOL);
            }
        }
        
        $final = '<div class="col-sm-4 col-sm-offset-6">
                    <button type="submit" id="consultar" class="btn btn-primary">Guardar</button>
                </div>
                </form>
                
        </div>
    </div>
</div>
';
        
        fwrite($file,$final . PHP_EOL);        
        fclose($file);
    }
    
    
}
