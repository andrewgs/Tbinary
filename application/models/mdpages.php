<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Mdpages extends MY_Model{
	
	var $id   			= 0;
	var $language		= '';
	var $title 			= '';
	var $description 	= '';
	var $link 			= '';
	var $content		= '';
	var $url			= '';
	var $pages			= 1;
	
	function __construct(){
		parent::__construct();
	}
	
	function insert_record($data){

		$this->language 	= $data['language'];
		$this->title 		= $data['title'];
		$this->description 	= $data['description'];
		$this->link 		= $data['link'];
		$this->content 		= $data['content'];
		$this->url 			= $data['url'];
		
		$this->db->insert('pages',$this);
		return $this->db->insert_id();
	}
	
	function update_record($id,$data){

		$this->db->set('title',$data['title']);
		$this->db->set('description',$data['description']);
		$this->db->set('link',$data['link']);
		$this->db->set('content',$data['content']);
		$this->db->set('url',$data['url']);
		$this->db->where('id',$id);
		$this->db->update('pages');
		return $this->db->affected_rows();
	}
	
	function read_fields_url($url,$fields,$table){
			
		$this->db->select($fields);
		$this->db->where('url',$url);
		$query = $this->db->get($table,1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return FALSE;
	}
}