<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Proyectos_m extends CI_Model {
public $table_name = 'proyectos';
private $id;
private $nombre;
private $descripcion;
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
function get_descripcion(){
                return $this->descripcion;
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
$this->descripcion = $row->descripcion;

            }
        }else{
$this->id =0;
$this->nombre = '';
$this->descripcion = '';
            
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
/* End of file proyectos_m.php */
/* Location: ./application/model/proyectos_m.php */
