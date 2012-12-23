<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Mdcategory extends MY_Model{
	
	var $id			= 0;
	var $language	= 1;
	var $title		= '';
	
	function __construct(){
		parent::__construct();
	}
	
	function insert_record($data){

		$this->language = $data['language'];
		$this->title = $data['title'];
		
		$this->db->insert('category',$this);
		return $this->db->insert_id();
	}
	
	function update_record($id,$data){

		$this->db->set('title',$data['title']);
		$this->db->where('id',$id);
		$this->db->update('category');
		return $this->db->affected_rows();
	}

	function read_records($language){
		
		$this->db->where('language',$language);
		$query = $this->db->get('category');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
}