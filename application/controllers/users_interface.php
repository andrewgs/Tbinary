<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Users_interface extends MY_Controller{
	
	function __construct(){
		
		parent::__construct();
		
	}
	
	public function index(){
		
		$pagevar = array(
			'title'			=> 'Tbinary trading platform',
			'description'	=> 'Tbinary trading platform',
			'baseurl' 		=> base_url(),
			'msgs'			=> $this->session->userdata('msgs'),
			'msgr'			=> $this->session->userdata('msgr')
		);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$this->load->view("users_interface/index",$pagevar);
	}
	
	public function pages($page_url = ''){
		
		$page_data = $this->mdpages->read_fields_url($page_url,'*','pages');
		
		if(!$page_data):
			show_404();
		endif;
		
		$pagevar = array(
			'title'			=> $page_data['title'],
			'description'	=> $page_data['description'],
			'keywords'		=> $page_data['keywords'],
			'content'		=> $page_data['content'],
			'baseurl' 		=> base_url(),
			'news' 			=> $this->mdnews->read_limit_records(3,0,'news','id','DESC'),
			'msgs'			=> $this->session->userdata('msgs'),
			'msgr'			=> $this->session->userdata('msgr')
		);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		for($i=0;$i<count($pagevar['news']);$i++):
			$pagevar['news'][$i]['date'] = $this->operation_dot_date($pagevar['news'][$i]['date']);
		endfor;
		
		$this->load->view("users_interface/pages",$pagevar);
	}
	
	public function trade(){
		
		$pagevar = array(
			'title'			=> 'Tbinary trading platform',
			'description'	=> 'Tbinary trading platform',
			'baseurl' 		=> base_url(),
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
					$statusval['newlink'] .= '<a id="action-cabinet" href="'.base_url().'admin-panel/actions/orders">Personal cabinet</a>';
				endif;
				$statusval['newlink'] .= '<a id="action-cabinet" href="'.base_url().'logoff">Log off</a>';
			endif;
		endif;
		echo json_encode($statusval);
	}
}