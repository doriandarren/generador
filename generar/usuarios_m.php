<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Usuarios_m extends CI_Model {
public $table_name = 'usuarios';
private $id;
private $nombre;
private $acronimo;
private $email;
private $clave;
private $fecha_creacion;
private $fecha_modificacion;
private $fecha_conexion;
private $bloqueo;
private $usuario_tipo_id;
private $confirmar_email;
private $confirmar_url;
function __construct() {
            parent::__construct();      
            $this->load->database();
        }
function get_id(){
                return $this->id;
            }
function get_nombre(){
                return $this->nombre;
            }
function get_acronimo(){
                return $this->acronimo;
            }
function get_email(){
                return $this->email;
            }
function get_clave(){
                return $this->clave;
            }
function get_fecha_creacion(){
                return $this->fecha_creacion;
            }
function get_fecha_modificacion(){
                return $this->fecha_modificacion;
            }
function get_fecha_conexion(){
                return $this->fecha_conexion;
            }
function get_bloqueo(){
                return $this->bloqueo;
            }
function get_usuario_tipo_id(){
                return $this->usuario_tipo_id;
            }
function get_confirmar_email(){
                return $this->confirmar_email;
            }
function get_confirmar_url(){
                return $this->confirmar_url;
            }
function setear($id){
        $id = intval($id);
        $this->db->where('id',$id);
        $this->db->select('*');
        $query = $this->db->get($this->table_name);
        if($query->result()){            
            foreach($query->result() as $row){
$this->id = $row->id;
$this->nombre = $row->nombre;
$this->acronimo = $row->acronimo;
$this->email = $row->email;
$this->clave = $row->clave;
$this->fecha_creacion = $row->fecha_creacion;
$this->fecha_modificacion = $row->fecha_modificacion;
$this->fecha_conexion = $row->fecha_conexion;
$this->bloqueo = $row->bloqueo;
$this->usuario_tipo_id = $row->usuario_tipo_id;
$this->confirmar_email = $row->confirmar_email;
$this->confirmar_url = $row->confirmar_url;

            }
        }else{
$this->id =0;
$this->nombre = '';
$this->acronimo = '';
$this->email = '';
$this->clave = '';
$this->fecha_creacion = '';
$this->fecha_modificacion = '';
$this->fecha_conexion = '';
$this->bloqueo = '';
$this->usuario_tipo_id =0;
$this->confirmar_email = '';
$this->confirmar_url = '';
            
        }
    }
    
    function upsert($data){
        $this->db->where('id', $data['id']);
        $this->db->select('id');
        $query = $this->db->get($this->table_name);
        if ($query->result()) {
            $this->db->set($data);
            $this->db->where('id', $data['id']);
            $this->db->update($this->table_name, $data);
        } else {
            unset($data['id']);
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
        $this->db->where('id', $id);
        $this->db->delete($this->table_name); 
        if ($query->result() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
}
/* End of file usuarios_m.php */
/* Location: ./application/model/usuarios_m.php */
