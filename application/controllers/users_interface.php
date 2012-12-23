<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Users_interface extends MY_Controller{
	
	var $language = 0;
	
	function __construct(){
		
		parent::__construct();
		
		if($this->loginstatus):
			$this->language = $this->mdusers->read_field($this->user['uid'],'users','language');
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
		
		$page_data = $this->mdpages->read_fields_url('','*',$this->language);
		
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
		
<<<<<<< HEAD
		$page_data = $this->mdpages->read_fields_url('trade','*',$this->language);
=======
		$page_data = $this->mdpages->read_fields_url('','*',$this->language);
>>>>>>> 67e6ddfa85cd3202d802f7f358e865563742bf14
		
		$pagevar = array(
			'title'			=> $page_data['title'],
			'description'	=> $page_data['description'],
			'content'		=> $page_data['content'],
			'baseurl' 		=> base_url(),
			'languages'		=> $this->mdlanguages->read_records('languages'),
			'client'		=> array(),
			'footer'		=> array('category'=>$this->mdcategory->read_records($this->language),'pages'=>$this->mdpages->read_records('id,title,link,url,category',$this->language)),
			'msgs'			=> $this->session->userdata('msgs'),
			'msgr'			=> $this->session->userdata('msgr')
		);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		if($this->loginstatus):
			$pagevar['client'] = $this->mdusers->read_record($this->user['uid'],'users');
			$pagevar['client']['password'] = $this->encrypt->decode($pagevar['client']['trade_password']);
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
				$statusval['newlink'] = 'Hello, <strong>'.$user['first_name'].' '.$user['last_name'].'</strong><br/>';
				if($user['id']):
<<<<<<< HEAD
//					$statusval['newlink'] .= '<a id="action-cabinet" href="'.base_url().'cabinet/orders"> Personal cabinet</a>';
					$statusval['newlink'] .= '<a id="action-cabinet" class="none" href="'.base_url().'#"> Personal cabinet</a>';
=======
					$statusval['newlink'] .= '<a class="action-cabinet" href="'.base_url().'cabinet/orders">My Account</a>';
>>>>>>> 67e6ddfa85cd3202d802f7f358e865563742bf14
				else:
					$statusval['newlink'] .= '<a class="action-cabinet" href="'.base_url().'admin-panel/actions/users-list">My Account</a>';
				endif;
				$statusval['newlink'] .= '<a class="action-cabinet" href="'.base_url().'logoff">Logout</a>';
			endif;
		endif;
		echo json_encode($statusval);
	}

	public function registering(){
		
		$statusval = array('status'=>FALSE,'message'=>'Logon failure','newlink'=>'');
		$data = trim($this->input->post('postdata'));
		if(!$data):
			show_404();
		endif;
		$data = preg_split("/&/",$data);
		for($i=0;$i<count($data);$i++):
			$dataid = preg_split("/=/",$data[$i]);
			$dataval[$dataid[0]] = $dataid[1];
		endfor;
		if($dataval):
			/*$postdata = http_build_query(array('answerType'=>$dataval['answerType'],'act'=>$dataval['act'],'office'=>$dataval['office'],
						'fname'=>$dataval['fname'],'lname'=>$dataval['lname'],'email'=>$dataval['email'],'country'=>$dataval['country'],
						'phone' => $dataval['phone']));
			$opts = array('http' =>array('method'=>'POST','header'=>'Content-type: application/x-www-form-urlencoded','content'=>$postdata));
			$context  = stream_context_create($opts);
			if($dataval['demo']):
				$result = file_get_contents('http://vl608.sysfx.com:8022/registration.aws?SCHEMA$=tfx22&demo=1',false,$context);
			else:
				$result = file_get_contents('http:vl608.sysfx.com:8022/registration.aws?SCHEMA$=tfx22',false,$context);
			endif;
			header('Content-type: text/xml');
			echo($result);*/
			//обработка XML-документа
			$dataval['zip_code'] = 'none';
			$dataval['state'] = 'none';
			$dataval['city'] = 'none';
			$dataval['address1'] = 'none';
			$dataval['address2'] = 'none';
			$dataval['password'] = $this->randomPassword(12);
			$xml = TRUE;
			if($xml):
				$user_id = $this->mdusers->insert_record($dataval);
				if($user_id):
					$statusval['status'] = TRUE;
					$statusval['message'] = '';
					$this->session->set_userdata(array('logon'=>md5($dataval['email']),'userid'=>$user_id));
					$statusval['newlink'] = 'Welcome, '.$dataval['fname'].' '.$dataval['lname'].'<br/>';
//					$statusval['newlink'] .= '<a id="action-cabinet" href="'.base_url().'cabinet/orders"> Personal cabinet</a>';
					$statusval['newlink'] .= '<a id="action-cabinet" class="none" href="'.base_url().'#"> Personal cabinet</a>';
					$statusval['newlink'] .= '<a id="action-cabinet" href="'.base_url().'logoff">Log off</a>';
					$this->mdusers->update_field($user_id,'language',$this->language,'users');
				endif;
			endif;
		endif;
		echo json_encode($statusval);
	}
}