<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Mdlanguages extends MY_Model{
	
	var $id		= 0;
	var $name	= '';
	var $active = 1;
	var $base 	= 1;
	
	function __construct(){
		parent::__construct();
	}
	
	function insert_record($data){

		$this->name = $data['name'];
		$this->base = $data['base'];
		
		$this->db->insert('​​languages',$this);
		return $this->db->insert_id();
	}
	
	function update_record($id,$data){

		$this->db->set('name',$data['name']);
		$this->db->where('id',$id);
		$this->db->update('​​languages');
		return $this->db->affected_rows();
	}
}