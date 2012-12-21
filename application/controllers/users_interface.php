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
	
	public function news(){
	
		$from = intval($this->uri->segment(3));
		$pagevar = array(
			'title'			=> 'СРО НП «Энергоаудит» в Ростове, Элисте, Краснодаре, Сочи: энергетический паспорт, энергетическое обследование',
			'description'	=> 'СРО ЮФО – некоммерческая саморегулируемая организация в Ростове на Дону, которая предлагает оформить энергетический паспорт.',
			'keywords'		=> 'сро юфо, вступить в, стоимость энергопаспорта, ростов на дону, энергосбережение, ставрополь, энергетический паспорт, краснодар, программа энергосбережения, сочи, обследования, астрахань, обязательное энергетическое обследование, пятигорск, энергоаудит, элиста, нп обинж энерго, майкоп, энергопаспорт, гильдия энергоаудиторов, волгоград, махачкала',
			'baseurl' 		=> base_url(),
			'allnews'		=> $this->mdnews->read_limit_records(5,$from,'news','id','DESC'),
			'news' 			=> NULL,
			'pages'			=> array(),
			'msgs'			=> $this->session->userdata('msgs'),
			'msgr'			=> $this->session->userdata('msgr')
		);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$pagevar['pages'] = $this->pagination('news',3,$this->mdnews->count_all_records('news'),5);
		
		for($i=0;$i<count($pagevar['allnews']);$i++):
			$pagevar['allnews'][$i]['date'] = $this->operation_dot_date($pagevar['allnews'][$i]['date']);
		endfor;
		
		$this->load->view("users_interface/news",$pagevar);
	}
	
	public function logoff(){
		
		$this->session->sess_destroy();
		redirect('');
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
				$session_data = array('logon'=>md5($user['login']),'userid'=>$user['id']);
				$this->session->set_userdata($session_data);
				if($user['id']):
					$statusval['newlink'] = '<a id="action-cabinet" href="'.base_url().'cabinet/orders">Личный кабинет</a>';
				else:
					$statusval['newlink'] = '<a id="action-cabinet" href="'.base_url().'admin-panel/actions/orders">Личный кабинет</a>';
				endif;
			endif;
		endif;
		echo json_encode($statusval);
	}
}