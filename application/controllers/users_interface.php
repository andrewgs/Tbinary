<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Users_interface extends MY_Controller{
	
	var $language = 0;
	
	function __construct(){
		
		parent::__construct();
		
		if($this->loginstatus):
			$this->mdusers->read_field($this->user['uid'],'users','language');
		else:
			$this->language = $this->session->userdata('current_language');
		endif;
		if(empty($this->language) || is_null($this->language)):
			$this->language = $this->mdlanguages->base_language();
		endif;
	}
	
	public function change_language(){
		
		$language = $this->uri->segment(2);
		if(!empty($language) && is_string($language)):
			$new_language = $this->mdlanguages->language_exist($language);
			if($new_language):
				$this->session->set_userdata('current_language',$new_language['id']);
				if($this->loginstatus):
					$this->mdusers->update_field($this->user['uid'],'language',$new_language['id'],'users');
				endif;
			endif;
		endif;
		if(isset($_SERVER['HTTP_REFERER'])):
			redirect($_SERVER['HTTP_REFERER']);
		else:
			redirect('');
		endif;
	}
	
	public function index(){
		
		$page_data = $this->mdpages->read_fields_url('','*');
		
		$pagevar = array(
			'title'			=> $page_data['title'],
			'description'	=> $page_data['description'],
			'content'		=> $page_data['content'],
			'baseurl' 		=> base_url(),
			'languages'		=> $this->mdlanguages->read_records('languages'),
			'footer'		=> array('category'=>$this->mdcategory->read_records($this->language),'pages'=>$this->mdpages->read_records('id,title,link,url,category',$this->language)),
			'msgs'			=> $this->session->userdata('msgs'),
			'msgr'			=> $this->session->userdata('msgr')
		);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$this->load->view("users_interface/index",$pagevar);
	}
	
	public function pages($page_url = ''){
		
		$page_data = $this->mdpages->read_fields_url($this->uri->uri_string(),'*',$this->language);
		if(!$page_data):
			show_404();
		endif;
		
		$pagevar = array(
			'title'				=> $page_data['title'],
			'description'		=> $page_data['description'],
			'content'			=> $page_data['content'],
			'active_category'	=> $page_data['category'],
			'baseurl' 			=> base_url(),
			'languages'			=> $this->mdlanguages->read_records('languages'),
			'footer'			=> array('category'=>$this->mdcategory->read_records($this->language),'pages'=>$this->mdpages->read_records('id,title,link,url,category',$this->language)),
			'msgs'				=> $this->session->userdata('msgs'),
			'msgr'				=> $this->session->userdata('msgr')
		);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$this->load->view("users_interface/pages",$pagevar);
	}
	
	public function trade(){
		
		$pagevar = array(
			'title'			=> 'Tbinary trading platform',
			'description'	=> 'Tbinary trading platform',
			'baseurl' 		=> base_url(),
			'languages'		=> $this->mdlanguages->read_records('languages'),
			'client'		=> array(),
			'msgs'			=> $this->session->userdata('msgs'),
			'msgr'			=> $this->session->userdata('msgr')
		);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		if($this->loginstatus):
			$pagevar['user'] = $this->mdusers->read_record($this->user['uid'],'users');
		endif;
		
		$this->load->view("users_interface/trade",$pagevar);
	}
	
	public function logoff(){
		
		$this->session->sess_destroy();
		if(isset($_SERVER['HTTP_REFERER'])):
			redirect($_SERVER['HTTP_REFERER']);
		else:
			redirect('');
		endif;
	}
	
	public function login(){
		
		$statusval = array('status'=>FALSE,'message'=>'Logon failure','newlink'=>'');
		$data = trim($this->input->post('postdata'));
		if(!$data):
			show_404();
		endif;
		$data = preg_split("/&/",$data);
		for($i=0;$i<count($data);$i++):
			$dataid = preg_split("/=/",$data[$i]);
			$dataval[$i] = $dataid[1];
		endfor;
		if($dataval):
			$user = $this->mdusers->auth_user($dataval[0],$dataval[1]);
			if($user):
				$statusval['status'] = TRUE;
				$statusval['message'] = '';
				$this->session->set_userdata(array('logon'=>md5($user['login']),'userid'=>$user['id']));
				$statusval['newlink'] = 'Welcome, '.$user['first_name'].' '.$user['last_name'].'<br/>';
				if($user['id']):
					$statusval['newlink'] .= '<a id="action-cabinet" href="'.base_url().'cabinet/orders">Personal cabinet</a>';
				else:
					$statusval['newlink'] .= '<a id="action-cabinet" href="'.base_url().'admin-panel/actions/users-list">Personal cabinet</a>';
				endif;
				$statusval['newlink'] .= '<a id="action-cabinet" href="'.base_url().'logoff">Log off</a>';
			endif;
		endif;
		echo json_encode($statusval);
	}
}