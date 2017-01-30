<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function mensajeExito() {     
        $this->msj = array('alert alert-success','Datos Guardados');
        $this->index();
    }  

    public function mensajeError() {
        $this->msj = array('alert alert-danger','Error: No se guardaron los datos');
        $this->index();   
    }  
    
    public function mensajeEliminados() {
        $this->msj = array('alert alert-success', 'Datos Eliminados');
        $this->index();
    }  
    
    public function mensajePersonalizado($tipo,$msj) {
        $this->msj = array($tipo,$msj);
        $this->index();
    }      
    
}
