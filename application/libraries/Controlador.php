<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Controlador {
   
     /***********************************
    ************************************
     *          CONTROLADOR    
    ************************************
     *      */       
    public function generarControlador($nombre_tabla, $campos, $array_tabla) {
        $file = fopen("generar/".$array_tabla[1]."_c.php", "w") or die("Error al Crear el archivo");
        
        $cuerpo = '';        
        $cuerpo = '<?php
        if (!defined(\'BASEPATH\')) {
                exit(\'No direct script access allowed\');
        }
        class '.ucwords($array_tabla[1]).'_c extends CI_Controller {
            function __construct() {
                parent::__construct();
                $this->load->model(\'admin_m/'.$array_tabla[1].'_m\');
            }

            function index() {
                $this->breadCrumbs[] = array(\'text\' => \''.$array_tabla[1].'\');
                $data[\'res\']=$this->'.$array_tabla[1].'_m->get_listar_vista();
                $this->load->view(\'admin_v/'.$array_tabla[1].'_v\',$data);
            }

            function cargar_formulario(){       
                /*..........................*/
                //Si esta presente el id,carga el formulario con los datos        
                if ($this->uri->segment(4)){            
                    //Decodificamos el id
                    //$id=urldecode(base64_decode($this->uri->segment(4)));
                    //Aseguramos que el id sea un integer
                    //$id=intval($this->uri->segment(4));
                    $id=$this->uri->segment(4);
                    //Aseguramos que el id sea un integer
                    if($this->uri->segment(4)===\'crear\'){
                        $id = 0;
                    }else{
                        $id=intval($id);
                    }      
                    ';
        
        fwrite($file, $cuerpo . PHP_EOL);
        
        
        $cuerpo = '$this->'.$array_tabla[1].'_m->set_'.$array_tabla[1].'($id);
            $data[\'id\'] = $id;';
        
        fwrite($file, $cuerpo . PHP_EOL);
        foreach($campos as $val){  
            $input = '$data[\''.$val.'\']= $this->'.$array_tabla[1].'_m->get_'.$val.'();';           
            fwrite($file, $input . PHP_EOL);            
        }
            
        $cuerpo = '/*............................*/
                $this->breadCrumbs[] = array(\'text\' => \''.$array_tabla[1].'\', \'href\'=>  site_url(\'admin_c/'.$array_tabla[1].'_c\'));
                if($id===0){
                    $this->breadCrumbs[] = array(\'text\' => \'Crear\');           
                }else{
                    $this->breadCrumbs[] = array(\'text\' => \'Editar\'); 
                }
                $this->load->view(\'admin_v/'.$array_tabla[1].'_u\', $data);
            }else{
                //Si el id esta vacio, entonces redireccionamos al index
                $this->index();
            }

        }';
        
        fwrite($file, $cuerpo . PHP_EOL); 
        
    
        $cuerpo = 'function upsert(){
        //Recepcion de los valores
        //Decodificamos el id
        //$id=urldecode(base64_decode($this->input->post("nivel_id", TRUE)));   
        //$id=urldecode(base64_decode($this->input->post("nivel_id", TRUE)));
        //Aseguramos que el id sea un integer
        $id=$this->input->post("'.$array_tabla[1].'_id", TRUE);
        $data[\'id\']=intval($id);';
            
        fwrite($file, $cuerpo . PHP_EOL); 

        foreach($campos as $val){  
            $input = '$data[\''.$val.'\']=$this->input->post("'.$val.'", TRUE);';           
            fwrite($file, $input . PHP_EOL);            
        }

               
        $cuerpo ='/*...............................................................*/
        //Validaciones';
        fwrite($file, $cuerpo . PHP_EOL); 

        
        foreach($campos as $val){     
            $input = '$this->form_validation->set_rules(\''.$val.'\', \''.$val.'\', \'trim|required|xss_clean\');';
            fwrite($file, $input . PHP_EOL);            
        }
        
        $cuerpo ='/*...............................................................*/
                if ($this->form_validation->run() == FALSE){ 
                    //Si la validacion fallo, reenvia al formulario de llenado         
                    //listado ubicacion

                    //Cargo los CSS Y JS
                    //$data[\'css\'] = array(\'css\' => \'calendario/bootstrap-datepicker\');
                    //$data[\'js\'] = array(\'js\' => \'calendario/bootstrap-datepicker\');

                    //Breadcumbs
                    $this->breadCrumbs[] = array(\'text\' => \''.$array_tabla[1].'\', \'href\'=>  site_url(\'admin_c/'.$array_tabla[1].'_c\'));
                    if($id===0){
                        $this->breadCrumbs[] = array(\'text\' => \'Crear\');
                    } else {
                        $this->breadCrumbs[] = array(\'text\' => \'Editar\');
                    }
                    //Cargo la Vista
                    $this->load->view(\'admin_v/'.$array_tabla[1].'_u\', $data);               
                }else{ 
                    //SI TODO ESTA BIEN:
                    //Con la validacion aceptada,entonces actualiza en la tabla y redirecciona al grid
                    $this->db->set(\'descripcion\',$data[\'descripcion\']);
                    $transaction=$this->estado_m->upsert($data);
                    if($transaction==1){
                        redirect(\'admin_c/'.$array_tabla[1].'_c/index/e/\', \'refresh\');
                    }else{
                        redirect(\'admin_c/'.$array_tabla[1].'_c/index/f/\', \'refresh\');
                    }        
                } 
            }

            function eliminar($id){
                //Decodificamos el id
                //$id = urldecode(base64_decode($id));
                //$id=urldecode(base64_decode($id));
                //Aseguramos que el id sea un integer
                $id = intval($id);
                $transaction=$this->'.$array_tabla[1].'_m->eliminar($id);
                redirect(\'admin_c/'.$array_tabla[1].'_c/index/\'.$transaction, \'refresh\');
            }  
        }
        /* End of file '.$array_tabla[1].'_c.php */
        /* Location: ./application/controller/admin_c/'.$array_tabla[1].'_c.php */';

        fwrite($file, $cuerpo . PHP_EOL);
        fclose($file);
    }

}
