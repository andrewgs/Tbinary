<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Mdlanguages extends MY_Model{
	
	var $id		= 0;
	var $name	= '';
	var $active = 1;
	var $base 	= 1;
	
	function __construct(){
		parent::__construct();
	}
	
	function visible_languages($field = 'id',$order = 'ASC'){
		
		$this->db->where('active',1);
		$this->db->order_by($field,$order);
		$query = $this->db->get('languages');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function insert_record($data){

		$this->name = $data['name'];
		$this->base = $data['base'];
		
		$this->db->insert('languages',$this);
		return $this->db->insert_id();
	}
	
	function update_record($id,$data){

		$this->db->set('name',$data['name']);
		$this->db->set('active',$data['active']);
		$this->db->where('id',$id);
		$this->db->update('languages');
		return $this->db->affected_rows();
	}
	
	function language_exist($string){
		
		$this->db->select('id,name');
		$this->db->where('name',$string);
		$query = $this->db->get('languages',1);
		$data = $query->result_array();
		if(count($data)) return $data[0];
		return FALSE;
	}
	
	function base_language(){
	
		$this->db->where('base',TRUE);
		$query = $this->db->get('languages',1);
		$data = $query->result_array();
		if($data) return $data[0]['id'];
		return FALSE;
	}
}