<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Mdusers extends MY_Model{

	var $id				= 0;
	var $remote_id		= 0;
	var $first_name		= '';
	var $last_name		= '';
	var $email			= '';
	var $address1		= '';
	var $address2		= '';
	var $city			= '';
	var $state			= '';
	var $zip_code		= '';
	var $country		= '';
	var $day_phone		= '';
	var $home_phone		= '';
	var $password		= '';
	var $coach			= '';
	var $trade_login	 = '';
	var $trade_password = '';
	var $signdate		= '';
	var $active			= 1;
	var $language		= 1;

	function __construct(){
		parent::__construct();
	}
	
	function insert_record($data){

		$this->remote_id 	= $data['remote_id'];
		$this->first_name 	= $data['fname'];
		$this->last_name 	= $data['lname'];
		$this->email 		= $data['email'];
		$this->country 		= $data['country'];
		$this->day_phone 	= $data['phone'];
		$this->coach 		= $data['coach'];
		$this->password		= md5($data['password']);
		$this->trade_login	= $data['trade_login'];
		$this->trade_password= $this->encrypt->encode($data['password']);
		$this->signdate 	= date("Y-m-d");
		
		$this->db->insert('users',$this);
		return $this->db->insert_id();
	}
	
	function update_record($data){

		$this->db->set('first_name',$data['first_name']);
		$this->db->set('last_name',$data['last_name']);
		$this->db->set('address1',$data['address1']);
		$this->db->set('address2',$data['address2']);
		$this->db->set('city',$data['city']);
		$this->db->set('state',$data['state']);
		$this->db->set('zip_code',$data['zip_code']);
		$this->db->set('country',$data['country']);
		$this->db->set('day_phone',$data['day_phone']);
		$this->db->set('home_phone',$data['home_phone']);
		$this->db->set('active',$data['active']);
		$this->db->set('coach',$data['coach']);
		$this->db->where('id',$data['id']);
		$this->db->update('users');
		return $this->db->affected_rows();
	}
	
	function auth_user($login,$password){
		
		$this->db->select('id,email AS login,first_name,last_name');
		$this->db->where('email',$login);
		$this->db->where('password',md5($password));
		$this->db->where('active',1);
		$query = $this->db->get('users',1);
		$data = $query->result_array();
		if($data) return $data[0];
		return 0;
	}

	function user_exist($field,$parameter){
			
		$this->db->where($field,$parameter);
		$query = $this->db->get('users',1);
		$data = $query->result_array();
		if(count($data)) return $data[0]['id'];
		return FALSE;
	}

	function valid_password($id,$field,$parameter){
			
		$this->db->where('id',$id);
		$this->db->where($field,$parameter);
		$query = $this->db->get('users',1);
		$data = $query->result_array();
		if(count($data)) return $data[0]['id'];
		return FALSE;
	}

	function read_limit_clients($count,$from){
		
		$this->db->where("id >",0);
		$this->db->order_by('id','ASC');
		$this->db->limit($count,$from);
		$query = $this->db->get('users');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function count_clients(){
		
		$this->db->select("COUNT(*) AS cnt");
		$this->db->where("id >",1);
		$query = $this->db->get('users');
		$data = $query->result_array();
		if(isset($data[0])) return $data[0]['cnt'];
		return 0;
	}
	
}