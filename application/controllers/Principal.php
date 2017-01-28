<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {

    private $title_head = 'Principal';
    //private $descripcion_head = "Generador";
    //private $keywords_head = 'Generador';
    //private $img_head = "http://wizakor.com/public/img/head/logo.jpg";
    
    
    public function __construct() {
        parent::__construct();      
        
    }
    
    public function index() {
                                  
        $data['title_head'] = $this->title_head;
        //$data['descripcion_head'] = $this->descripcion_head;
        //$data['keywords_head'] = $this->keywords_head;
        //$data['img_head'] = $this->img_head;
        
        //$data['js'] = array('animated-header');
        $this->breadCrumbs[] = array('text' => '');
        
        $this->load->view('head', $data);
        $this->load->view(strtolower($this->title_head));
        $this->load->view('footer', TRUE);
    }
}
