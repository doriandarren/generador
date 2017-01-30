<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Modelo {
    
    /***********************************
    ************************************
     *          MODELO     
    ************************************
     *      */    
    function generarModelo($nombre_tabla, $campos, $array_tabla) {
        $file = fopen("generar/".$array_tabla[1]."_m.php", "w") or die("Error al Crear el archivo");
        
        $cuerpo = ''; 
        
        $cuerpo = '<?php
defined(\'BASEPATH\') OR exit(\'No direct script access allowed\');
class '.ucwords($array_tabla[1]).'_m extends CI_Model {
public $table_name = \''.$array_tabla[1].'\';';
    
        fwrite($file, $cuerpo . PHP_EOL);
        
        
        foreach($campos as $val){  
            $input = 'private $'.$val.';';
            fwrite($file, $input . PHP_EOL);            
        }
        
        $cuerpo = 'function __construct() {
            parent::__construct();      
            $this->load->database();
        }';
        
        fwrite($file, $cuerpo . PHP_EOL);
        
        foreach($campos as $val){  
            $input = 'function get_'.$val.'(){
                return $this->'.$val.';
            }';
            fwrite($file, $input . PHP_EOL);            
        }
        
        $cuerpo = 'function setear($id){
        $id = intval($id);
        $this->db->where(\'id\',$id);
        $this->db->select(\'*\');
        $query = $this->db->get($this->table_name);
        if($query->result()){            
            foreach($query->result() as $row){';
                
                fwrite($file, $cuerpo . PHP_EOL);
                
                foreach($campos as $val){  
                    $input = '$this->'.$val.' = $row->'.$val.';';
                    fwrite($file, $input . PHP_EOL);            
                }
                
             $cuerpo = '
            }
        }else{';
             
            fwrite($file, $cuerpo . PHP_EOL); 
             
            foreach($campos as $val){  
                $input = '$this->'.$val.' = \'\';';
                fwrite($file, $input . PHP_EOL);            
            }
            
           $cuerpo = '            
        }
    }
    
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
        if ($query->result() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
}
/* End of file '.$array_tabla[1].'_m.php */
/* Location: ./application/model/'.$array_tabla[1].'_m.php */';        
        fwrite($file, $cuerpo . PHP_EOL);
        fclose($file);
        
    }

}
