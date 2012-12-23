<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Mdpages extends MY_Model{
	
	var $id   		= 0;
	var $language	= '';
	var $title 		= '';
	var $description= '';
	var $link 		= '';
	var $content	= '';
	var $url		= '';
	var $manage		= 1;
	var $category	= 1;
	
	function __construct(){
		parent::__construct();
	}
	
	function insert_record($data,$manage = 1){

		$this->language 	= $data['language'];
		$this->title 		= $data['title'];
		$this->description 	= $data['description'];
		$this->link 		= $data['link'];
		$this->content 		= $data['content'];
		$this->url 			= $data['url'];
		$this->manage 		= $manage;
		$this->category 	= $data['category'];
		
		$this->db->insert('pages',$this);
		return $this->db->insert_id();
	}
	
	function update_record($id,$data){

		$this->db->set('title',$data['title']);
		$this->db->set('description',$data['description']);
		$this->db->set('link',$data['link']);
		$this->db->set('content',$data['content']);
		$this->db->set('url',$data['url']);
		$this->db->set('category',$data['category']);
		$this->db->where('language',$data['language']);
		$this->db->where('id',$id);
		
		$this->db->update('pages');
		return $this->db->affected_rows();
	}
	
	function read_fields_url($url,$fields,$language){
			
		$this->db->select($fields);
		$this->db->where('url',$url);
		$this->db->where('language',$language);
		$query = $this->db->get('pages',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return FALSE;
	}
	
	function read_fields($fields){
			
		$this->db->select($fields);
		$query = $this->db->get('pages');
		$data = $query->result_array();
		if($data) return $data;
		return FALSE;
	}

	function read_records($fields,$language){
			
		$this->db->select($fields);
		$this->db->where('language',$language);
		$query = $this->db->get('pages');
		$data = $query->result_array();
		if($data) return $data;
		return FALSE;
	}
	
	function category_records($category,$language){
			
		$this->db->where('category',$category);
		$this->db->where('language',$language);
		$query = $this->db->get('pages');
		$data = $query->result_array();
		if($data) return $data;
		return FALSE;
	}

	function page_on_language($language,$page){
			
		$this->db->where('id',$page);
		$this->db->where('language',$language);
		$query = $this->db->get('pages',1);
		$data = $query->result_array();
		if($data) return TRUE;
		return FALSE;
	}
}