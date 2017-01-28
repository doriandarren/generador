<?php
        defined('BASEPATH') OR exit('No direct script access allowed');
        class usuarios extends MY_Controller {
            /*
            * VARIABLES CON MSJ:
            * alert alert-info
            * alert alert-success
            * alert alert-danger
            *      */
            public $msj = NULL;
            private $title_head = 'Usuarios';
            private $directorio = 'admin/';
        
            function __construct() {
                parent::__construct();
                $this->load->model('usuarios_m');
            }

            public function index() {
                $data['title_head'] = $this->title_head;
                $data['descripcion_head'] = $this->descripcion_head;
                $data['keywords_head'] = $this->keywords_head;
                $data['img_head'] = $this->img_head;
                $data['msj'] = $this->msj;

                $datos['datos'] = $this->usuarios_m->listar();

                //JS PUBLICOS
                $data['js_p'] = array('tablas/jquery.dataTables','tablas/dataTables.bootstrap','tablas/mi_tabla');

                $this->breadCrumbs[] = array('text' => 'usuarios');

                $this->load->view($this->directorio . 'plantilla/head', $data);
                $this->load->view($this->directorio . strtolower($this->title_head),$datos);
                $this->load->view($this->directorio . 'plantilla/footer');
            }

            public function nueva($id=NULL) {     
                if($id==NULL){
                    $id=0;
                }
                $data['title_head'] = $this->title_head;
                $data['descripcion_head'] = $this->descripcion_head;
                $data['keywords_head'] = $this->keywords_head;
                $data['img_head'] = $this->img_head;
                $data['msj'] = $this->msj;
                
                $this->usuarios_m->setear($id);
$data['id']= $this->usuarios_m->get_id();
$data['nombre']= $this->usuarios_m->get_nombre();
$data['acronimo']= $this->usuarios_m->get_acronimo();
$data['email']= $this->usuarios_m->get_email();
$data['clave']= $this->usuarios_m->get_clave();
$data['fecha_creacion']= $this->usuarios_m->get_fecha_creacion();
$data['fecha_modificacion']= $this->usuarios_m->get_fecha_modificacion();
$data['fecha_conexion']= $this->usuarios_m->get_fecha_conexion();
$data['bloqueo']= $this->usuarios_m->get_bloqueo();
$data['usuario_tipo_id']= $this->usuarios_m->get_usuario_tipo_id();
$data['confirmar_email']= $this->usuarios_m->get_confirmar_email();
$data['confirmar_url']= $this->usuarios_m->get_confirmar_url();
  
                $this->breadCrumbs[] = array('text' => 'Usuarios', 'href'=>  site_url($this->directorio . 'usuarios'));
                if($id===0){
                    $this->breadCrumbs[] = array('text' => 'Crear');           
                }else{
                    $this->breadCrumbs[] = array('text' => 'Editar'); 
                }
                $this->load->view($this->directorio . 'plantilla/head',$data);        
                $this->load->view($this->directorio . 'usuario', $data);        
                $this->load->view($this->directorio . 'plantilla/footer');        
            }
public function guardar() {
$data['id']=$this->input->post("id", TRUE);
$data['nombre']=$this->input->post("nombre", TRUE);
$data['acronimo']=$this->input->post("acronimo", TRUE);
$data['email']=$this->input->post("email", TRUE);
$data['clave']=$this->input->post("clave", TRUE);
$data['fecha_creacion']=$this->input->post("fecha_creacion", TRUE);
$data['fecha_modificacion']=$this->input->post("fecha_modificacion", TRUE);
$data['fecha_conexion']=$this->input->post("fecha_conexion", TRUE);
$data['bloqueo']=$this->input->post("bloqueo", TRUE);
$data['usuario_tipo_id']=$this->input->post("usuario_tipo_id", TRUE);
$data['confirmar_email']=$this->input->post("confirmar_email", TRUE);
$data['confirmar_url']=$this->input->post("confirmar_url", TRUE);
$this->form_validation->set_rules('id','Id','trim|required|xss_clean');
$this->form_validation->set_rules('nombre','Nombre','trim|required|xss_clean');
$this->form_validation->set_rules('acronimo','Acronimo','trim|required|xss_clean');
$this->form_validation->set_rules('email','Email','trim|required|xss_clean');
$this->form_validation->set_rules('clave','Clave','trim|required|xss_clean');
$this->form_validation->set_rules('fecha_creacion','Fecha Creacion','trim|required|xss_clean');
$this->form_validation->set_rules('fecha_modificacion','Fecha Modificacion','trim|required|xss_clean');
$this->form_validation->set_rules('fecha_conexion','Fecha Conexion','trim|required|xss_clean');
$this->form_validation->set_rules('bloqueo','Bloqueo','trim|required|xss_clean');
$this->form_validation->set_rules('usuario_tipo_id','Usuario Tipo Id','trim|required|xss_clean');
$this->form_validation->set_rules('confirmar_email','Confirmar Email','trim|required|xss_clean');
$this->form_validation->set_rules('confirmar_url','Confirmar Url','trim|required|xss_clean');

            if ($this->form_validation->run() === FALSE){
            
                $data['title_head'] = $this->title_head;
                $data['descripcion_head'] = $this->descripcion_head;
                $data['keywords_head'] = $this->keywords_head;
                $data['img_head'] = $this->img_head;
                $data['msj'] = array('alert alert-danger','Error: No se guardaron los datos');
            
            $this->load->view($this->directorio . 'plantilla/head',$data);        
            $this->load->view($this->directorio . 'usuario', $data);        
            $this->load->view($this->directorio . 'plantilla/footer');            
        }else{            
            
            $resultado = $this->usuarios_m->upsert($data);
            if($resultado==TRUE){
                $this->mensajeExito();
            }else{
                $this->mensajePersonalizado('alert-danger','Error: NO se pudo guardar');                
            }
        }        
    }

            public function eliminar($id_e) { 
        
        if($id_e===NULL){
            $this->mensajePersonalizado('alert alert-danger','No existe el ID');
            $this->index();
        }
        $id = intval($id_e);
        
        $resultado = $this->usuarios_m->eliminar($id);
        if ($resultado === TRUE) {
            $this->mensajeExito();
        } else {
            $this->mensajePersonalizado('alert alert-danger','Error: no se elimino el registro'); 
        }
    } 
        }
        /* End of file usuarios.php */
        /* Location: ./application/controller/usuarios.php */
