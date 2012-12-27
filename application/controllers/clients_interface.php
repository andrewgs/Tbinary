<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Clients_interface extends MY_Controller{
	
	function __construct(){
		
		parent::__construct();
		if(!$this->loginstatus || !$this->user['uid']):
			redirect('');
		endif;
	}
	
	public function balance(){
		
		$pagevar = array(
			'title'			=> 'Cabinet - My balance',
			'description'	=> '',
			'baseurl' 		=> base_url(),
			'userinfo'		=> $this->user,
			'user'			=> $this->mdusers->read_record($this->user['uid'],'users'),
			'msgs'			=> $this->session->userdata('msgs'),
			'msgr'			=> $this->session->userdata('msgr')
		);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$this->load->view("clients_interface/balance",$pagevar);
	}
	
	public function portfolio(){
		
		$pagevar = array(
			'title'			=> 'Cabinet - My portfolio',
			'description'	=> '',
			'baseurl' 		=> base_url(),
			'userinfo'		=> $this->user,
			'user'			=> $this->mdusers->read_record($this->user['uid'],'users'),
			'msgs'			=> $this->session->userdata('msgs'),
			'msgr'			=> $this->session->userdata('msgr')
		);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$this->load->view("clients_interface/portfolio",$pagevar);
	}
	
	public function profile(){
		
		$pagevar = array(
			'title'			=> 'Cabinet - My profile',
			'description'	=> '',
			'baseurl' 		=> base_url(),
			'userinfo'		=> $this->user,
			'user'			=> $this->mdusers->read_record($this->user['uid'],'users'),
			'langs'			=> $this->mdlanguages->read_records('languages'),
			'msgs'			=> $this->session->userdata('msgs'),
			'msgr'			=> $this->session->userdata('msgr')
		);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		if($this->input->post('submit')):
			unset($_POST['submit']);
			$this->form_validation->set_rules('first_name',' ','required|trim');
			$this->form_validation->set_rules('last_name',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Error. Incorrectly filled in the required fields!');
				redirect($this->uri->uri_string());
			else:
				$update = $this->input->post();
				$update['coach'] = $pagevar['user']['coach'];
				$update['active'] = $pagevar['user']['active'];
				$update['id'] = $this->user['uid'];
				$result = $this->mdusers->update_record($update);
				if($result):
					$this->session->set_userdata('msgs','Profile updating!');
				endif;
				redirect($this->uri->uri_string());
			endif;
		endif;
		
		if($this->input->post('newpassword')):
			unset($_POST['newpassword']);
			$this->form_validation->set_rules('password',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Error. Incorrectly filled in the required fields!');
				redirect($this->uri->uri_string());
			else:
				$user_id = $this->mdusers->valid_password($this->user['uid'],'password',md5($this->input->post('password')));
				if($user_id):
					$new_password = $this->randomPassword(10);
					$result = $this->mdusers->update_field($this->user['uid'],'password',md5($new_password),'users');
					if($result):
						ob_start();?>
						<p>Dear <em><?=$this->user['name'];?></em>,</p>
						<p>You have requested a new password to access the site <?=anchor('','Tbinary trading platform');?></p>
						<p>Login: <?=$this->user['email'];?><br/>Password: <?=$new_password;?></p><?
						$mailtext = ob_get_clean();
						$this->send_mail($this->user['email'],'robot@sysfx.com','Tbinary trading platform','Requested a new password to tbinary.com',$mailtext);
						$this->session->set_userdata('msgs','Password changed.');
					endif;
				endif;
				redirect($this->uri->uri_string());
			endif;
		endif;
		$pagevar['user']['password'] = $this->encrypt->decode($pagevar['user']['trade_password']);
		$pagevar['user']['signdate'] = $this->operation_dot_date($pagevar['user']['signdate']);
		$this->load->view("clients_interface/profile",$pagevar);
	}
}