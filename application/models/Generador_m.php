<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Generador_m extends CI_Model {
    
    function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
    }
       
    
    public function buscar_columna_tabla($bd, $tabla){
        //$this->db->select('*');        
        $query = $this->db->query("SELECT COLUMN_NAME "
                . "FROM INFORMATION_SCHEMA.COLUMNS "
                . "WHERE table_name = '".$tabla."' "
                . "AND table_schema = '".$bd."'");        
        /*$query = $this->db->query("SELECT column_name
                        FROM information_schema.columns
                        WHERE table_name = '".$tabla."'");*/
        //echo  $this->db->last_query();        
        if($query->result()){
            return $query->result();
        }else{ 
            return FALSE;
        }
    }
}