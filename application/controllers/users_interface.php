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
		
		$page_data = $this->mdpages->home_pages($this->language);
		$pagevar = array(
			'title'			=> (isset($page_data[0]['title']) && !empty($page_data[0]['title']))?$page_data[0]['title']:'Tbinary trading platform',
			'description'	=> (isset($page_data[0]['description']) && !empty($page_data[0]['description']))?$page_data[0]['description']:'Tbinary trading platform',
			'baseurl' 		=> base_url(),
			'page'			=> (isset($page_data))?$page_data:array(),
			'languages'		=> $this->mdlanguages->visible_languages(),
			'main_menu'		=> $this->mdpages->read_top_menu($this->language),
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
			'title'				=> (!empty($page_data['title']))?$page_data['title']:'Tbinary trading platform',
			'description'		=> $page_data['description'],
			'content'			=> $page_data['content'],
			'active_category'	=> $page_data['category'],
			'baseurl' 			=> base_url(),
			'main_menu'			=> $this->mdpages->read_top_menu($this->language),
			'languages'			=> $this->mdlanguages->visible_languages(),
			'footer'			=> array('category'=>$this->mdcategory->read_records($this->language),'pages'=>$this->mdpages->read_records('id,title,link,url,category',$this->language)),
			'msgs'				=> $this->session->userdata('msgs'),
			'msgr'				=> $this->session->userdata('msgr')
		);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$this->load->view("users_interface/pages",$pagevar);
	}
	
	public function trade(){
		
		$page_data = $this->mdpages->read_fields_url('trade','*',$this->language);
		
		$pagevar = array(
			'title'			=> (!empty($page_data['title']))?$page_data['title']:'Tbinary trading platform',
			'description'	=> $page_data['description'],
			'content'		=> $page_data['content'],
			'baseurl' 		=> base_url(),
			'languages'		=> $this->mdlanguages->visible_languages(),
			'main_menu'		=> $this->mdpages->read_top_menu($this->language),
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
		
		$this->session->unset_userdata(array('logon'=>'','userid'=>''));
		$this->session->set_userdata('current_language',$this->language);
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
					$statusval['newlink'] .= '<a class="action-cabinet" href="'.base_url().'cabinet/balance">My Account</a>';
				else:
					$statusval['newlink'] .= '<a class="action-cabinet" href="'.base_url().'admin-panel/actions/users-list">Administration Panel</a>';
				endif;
				$statusval['newlink'] .= '<a class="action-cabinet" href="'.base_url().'logoff">Logout</a>';
			endif;
		endif;
		echo json_encode($statusval);
	}
	
	public function forgot_password(){
		
		$statusval = array('status'=>FALSE,'title'=>'<span class="label label-success">Successfully</span>','message'=>'New password sent to your email');
		$user_email = trim($this->input->post('user_email'));
		if(!$user_email):
			show_404();
		endif;
		$user_id = $this->mdusers->user_exist('email',trim($user_email));
		if($user_id):
			$new_password = $this->randomPassword(10);
			$result = $this->mdusers->update_field($user_id,'password',md5($new_password),'users');
			if($result):
				$user = $this->mdusers->read_record($user_id,'users');
				ob_start();?>
				<p>Dear <em><?=$user['first_name'].' '.$user['last_name'];?></em>,</p>
				<p>You have requested a new password to access the site <?=anchor('','Tbinary trading platform');?></p>
				<p>Login: <?=$user['email'];?><br/>Password: <?=$new_password;?></p><?
				$mailtext = ob_get_clean();
				$this->send_mail($user['email'],'robot@sysfx.com','Tbinary trading platform','Requested a new password to tbinary.com',$mailtext);
				$statusval['status'] = TRUE;
				$this->session->set_userdata('msgs','Password changed.');
			endif;
		else:
			$statusval['title'] = '<span class="label label-warning">Specified Email does not exist</span>';
		endif;
		echo json_encode($statusval);
	}

	public function registering(){
		
		$statusval = array('status'=>FALSE,'message'=>'Logon failure','newlink'=>'','mode'=>'');
		$data = trim($this->input->post('postdata'));
		if(!$data):
			show_404();
		endif;
		$data = preg_split("/&/",$data);
		for($i=0;$i<count($data);$i++):
			$dataid = preg_split("/=/",$data[$i]);
			$dataval[$dataid[0]] = $dataid[1];
		endfor;
		if($this->mdusers->record_exist('users','email',trim($dataval['email']))):
			$statusval['message'] = 'Email is already registered';
		else:
			if($dataval && !$this->loginstatus):
				$dataval['answerType'] = 'xml'; $dataval['act'] = 'send'; $dataval['office'] = 'main';
				$postdata = http_build_query(array('answerType'=>$dataval['answerType'],'act'=>$dataval['act'],'office'=>$dataval['office'],
							'fname'=>$dataval['fname'],'lname'=>$dataval['lname'],'email'=>$dataval['email'],'country'=>$dataval['country'],
							'phone' => $dataval['phone']));
				$opts = array('http' =>array('method'=>'POST','header'=>'Content-type: application/x-www-form-urlencoded','content'=>$postdata));
				$context  = stream_context_create($opts);
				if($dataval['demo']):
					$statusval['mode'] = 'demo';
					$xml_string = file_get_contents('http://vl608.sysfx.com:8022/registration.aws?SCHEMA$=tfx22&demo=1',false,$context);
				else:
					$statusval['mode'] = 'real';
					$xml_string = file_get_contents('http://vl608.sysfx.com:8022/registration.aws?SCHEMA$=tfx22',false,$context);
				endif;
				//обработка XML-документа
				$xml_document = simplexml_load_string($xml_string);
				if($xml_document && ($xml_document->getName() == 'success')):
					$dataval['remote_id'] = (int)$xml_document->accounts->acct_id;
					$dataval['trade_login'] = (string)$xml_document->login;
					$dataval['password'] = (string)$xml_document->password;
					if($dataval['remote_id']):
						$user_id = $this->mdusers->insert_record($dataval);
						if($user_id):
							$statusval['status'] = TRUE;
							$statusval['message'] = 'Registration is successful!';
							$this->session->set_userdata(array('logon'=>md5(trim($dataval['email'])),'userid'=>$user_id));
							$statusval['newlink'] = 'Hello, <strong>'.$dataval['fname'].' '.$dataval['lname'].'</strong><br/>';
							$statusval['newlink'] .= '<a class="action-cabinet" href="'.base_url().'cabinet/balance">My Account</a>';
							$statusval['newlink'] .= '<a class="action-cabinet" href="'.base_url().'logoff">Logout</a>';
							$this->mdusers->update_field($user_id,'language',$this->language,'users');
							ob_start();?>
							<p>Dear <em><?=$dataval['fname'].' '.$dataval['lname'];?></em>,</p>
							<p>Thank you for registration on tbinary.com. To gain access to your account, please use these credentials:</p>
							<p>Login: <?=$dataval['email'];?><br/>Password: <?=$dataval['password'];?></p><?
							$mailtext = ob_get_clean();
							$this->send_mail($dataval['email'],'robot@sysfx.com','Tbinary trading platform','Register to tbinary.com',$mailtext);
						endif;
					else:
						$statusval['message'] = 'Error when registering!';
					endif;
				else:
					$statusval['message'] = 'Error when registering!';
				endif;
			endif;
		endif;
		echo json_encode($statusval);
	}
}