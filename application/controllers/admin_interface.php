<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_interface extends MY_Controller{
	
	function __construct(){
		
		parent::__construct();
		if(!$this->loginstatus || $this->user['uid']):
			redirect('');
		endif;
	}
	
	public function control_panel(){
		
		$pagevar = array(
					'baseurl' 		=> base_url(),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		$this->load->view("admin_interface/control-panel",$pagevar);
	}

	/******************************************* pages_lang ******************************************************/
	
	public function home_page(){
		
		$pagevar = array(
					'baseurl' 		=> base_url(),
					'langs'			=> $this->mdlanguages->read_records('languages'),
					'langs_pages'	=> $this->mdpages->read_pages(),
					'page'			=> $this->mdpages->home_pages($this->uri->segment(5)),
					'form_legend'	=> 'The form of editing home page. Language: ',
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');

		if($this->input->post('submit')):
			unset($_POST['submit']);
			$this->form_validation->set_rules('title',' ','trim');
			$this->form_validation->set_rules('description',' ','trim');
			$this->form_validation->set_rules('link',' ','required|trim');
			$this->form_validation->set_rules('url',' ','trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Error. Incorrectly filled in the required fields!');
				redirect($this->uri->uri_string());
			else:
				$update = $this->input->post();
				$this->mdpages->update_field($update['home_main'],'title',$update['title'],'pages');
				$this->mdpages->update_field($update['home_main'],'description',$update['description'],'pages');
				$this->mdpages->update_field($update['home_main'],'link',$update['link'],'pages');
				$this->mdpages->update_field($update['home_main'],'url','','pages');
				for($i=1;$i<5;$i++):
					$this->mdpages->update_field($update['home_'.$i],'link',$update['link_'.$i],'pages');
					$this->mdpages->update_field($update['home_'.$i],'content',$update['content_'.$i],'pages');
				endfor;
				$this->session->set_userdata('msgs','Page <strong>'.$update['link'].'</strong> updating!');
				redirect('admin-panel/actions/pages');
			endif;
		endif;
		$this->load->view("admin_interface/page-home",$pagevar);
		
	}
	
	public function menu_page(){
		
		$page = $this->mdpages->read_fields_url($this->uri->segment(7),'id',$this->uri->segment(5));
		if($page['id']):
			redirect('admin-panel/actions/pages/lang/'.$this->uri->segment(5).'/page/'.$page['id']);
		else:
			redirect('admin-panel/actions/pages');
		endif;
	}
	
	public function pages_lang(){
		
		$pagevar = array(
					'baseurl' 		=> base_url(),
					'langs'			=> $this->mdlanguages->read_records('languages'),
					'langs_pages'	=> $this->mdpages->read_pages(),
					'page'			=> FALSE,
					'redactor'		=> FALSE,
					'form_legend'	=> FALSE,
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		if($this->input->post('insleng')):
			unset($_POST['insleng']);
			$this->form_validation->set_rules('name',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Error. Incorrectly filled in the required fields!');
				redirect($this->uri->uri_string());
			else:
				$insert = $this->input->post();
				$insert['base'] = 0;
				$cntleng = $this->mdlanguages->count_all_records('languages');
				if(!$cntleng):
					$insert['base'] = 1;
				endif;
				$insert['name'] = $this->english_symbol($insert['name']);
				if($insert['name']):
					$count_pages = $this->mdpages->count_all_records('languages');
					$lang_id = $this->mdlanguages->insert_record($insert);
					if($count_pages):
						$base_language = $this->mdlanguages->base_language();
						if($base_language):
							$pages = $this->mdpages->category_pages(0,$base_language);
							for($i=0;$i<count($pages);$i++):
								$this->mdpages->insert_record(array('language'=>$lang_id,'title'=>$pages[$i]['title'],'description'=>$pages[$i]['description'],'link'=>$pages[$i]['link'],'content'=>$pages[$i]['content'],'url'=>$pages[$i]['url'],'category'=>0),$pages[$i]['manage']);
							endfor;
							//begin inserting home pages parts
							$this->mdpages->insert_record(array('language'=>$lang_id,'title'=>'home_0','description'=>'','link'=>'How to trade options','content'=>'','url'=>'','category'=>-1),0);
							$this->mdpages->insert_record(array('language'=>$lang_id,'title'=>'home_1','description'=>'','link'=>'Tbinary trading platform features','content'=>'','url'=>'','category'=>-1),0);
							$this->mdpages->insert_record(array('language'=>$lang_id,'title'=>'home_2','description'=>'','link'=>'Check out the features below, or go ahead and sign up.','content'=>'Start trade now','url'=>'','category'=>-1),0);
							$this->mdpages->insert_record(array('language'=>$lang_id,'title'=>'home_3','description'=>'','link'=>'','content'=>'','url'=>'','category'=>-1),0);
							//end
							$category = $this->mdcategory->read_records($base_language);
							for($i=0;$i<count($category);$i++):
								$category_id = $this->mdcategory->insert_record(array('language'=>$lang_id,'title'=>$category[$i]['title']));
								$pages = $this->mdpages->category_pages($category[$i]['id'],$base_language);
								for($j=0;$j<count($pages);$j++):
									$this->mdpages->insert_record(array('language'=>$lang_id,'title'=>$pages[$j]['title'],'description'=>$pages[$j]['description'],'link'=>$pages[$j]['link'],'content'=>$pages[$j]['content'],'url'=>$pages[$j]['url'],'category'=>$category_id),$pages[$j]['manage']);
								endfor;
							endfor;
						endif;
						$this->session->set_userdata('msgs','New language added!');
					else:
						
						$this->mdpages->insert_record(array('language'=>$lang_id,'title'=>'Home page','description'=>'','link'=>'home','content'=>'','url'=>'','category'=>0),0);
						$this->mdpages->insert_record(array('language'=>$lang_id,'title'=>'home_0','description'=>'','link'=>'How to trade options','content'=>'','url'=>'','category'=>-1),0);
						$this->mdpages->insert_record(array('language'=>$lang_id,'title'=>'home_1','description'=>'','link'=>'Tbinary trading platform features','content'=>'','url'=>'','category'=>-1),0);
						$this->mdpages->insert_record(array('language'=>$lang_id,'title'=>'home_2','description'=>'','link'=>'Check out the features below, or go ahead and sign up.','content'=>'Start trade now','url'=>'','category'=>-1),0);
						$this->mdpages->insert_record(array('language'=>$lang_id,'title'=>'home_3','description'=>'','link'=>'','content'=>'','url'=>'','category'=>-1),0);
						
						$this->mdpages->insert_record(array('language'=>$lang_id,'title'=>'Trade page','description'=>'','link'=>'trade','content'=>'','url'=>'trade','category'=>0),0);
						$this->mdpages->insert_record(array('language'=>$lang_id,'title'=>'FAQ page','description'=>'','link'=>'faq','content'=>'','url'=>'faq','category'=>0),0);
						$this->mdpages->insert_record(array('language'=>$lang_id,'title'=>'Deposit page','description'=>'','link'=>'deposit','content'=>'','url'=>'deposit','category'=>0),0);
						$this->mdpages->insert_record(array('language'=>$lang_id,'title'=>'Contact us page','description'=>'','link'=>'contact us','content'=>'','url'=>'contact-us','category'=>0),0);
						$this->session->set_userdata('msgs','Base language added!');
					endif;
				endif;
				redirect($this->uri->uri_string());
			endif;
		endif;
		
		$this->load->view("admin_interface/pages",$pagevar);
	}
	
	public function lang_new_page(){
		
		$pagevar = array(
					'baseurl' 		=> base_url(),
					'langs'			=> $this->mdlanguages->read_records('languages'),
					'langs_pages'	=> $this->mdpages->read_pages(),
					'page'			=> array('title'=>'','description'=>'','link'=>'','url'=>'','content'=>'','category'=>0,'manage'=>1),
					'redactor'		=> TRUE,
					'form_legend'	=> 'The form of creating a new page. Language: ',
					'category'		=> $this->mdcategory->read_records($this->uri->segment(5)),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		if($this->input->post('submit')):
			unset($_POST['submit']);
			$this->form_validation->set_rules('title',' ','trim');
			$this->form_validation->set_rules('description',' ','trim');
			$this->form_validation->set_rules('link',' ','required|trim');
			$this->form_validation->set_rules('url',' ','trim');
			$this->form_validation->set_rules('content',' ','trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Error. Incorrectly filled in the required fields!');
				redirect($this->uri->uri_string());
			else:
				$insert = $this->input->post();
				if(!empty($insert['url'])):
					$insert['url'] = $this->valid_url_symbol($insert['url']);
				endif;
				$insert['language'] = $this->uri->segment(5);
				$result = $this->mdpages->insert_record($insert,TRUE);
				if($result):
					$this->session->set_userdata('msgs','Page <strong>'.$insert['link'].'</strong> added!');
				endif;
				redirect('admin-panel/actions/pages');
			endif;
		endif;
		
		$this->load->view("admin_interface/pages",$pagevar);
	}
	
	public function lang_edit_page(){
		
		if(!$this->mdpages->page_on_language($this->uri->segment(5),$this->uri->segment(7))):
			redirect('admin-panel/actions/pages');
		endif;
		
		$pagevar = array(
					'baseurl' 		=> base_url(),
					'langs'			=> $this->mdlanguages->read_records('languages'),
					'langs_pages'	=> $this->mdpages->read_pages(),
					'page'			=> $this->mdpages->read_record($this->uri->segment(7),'pages'),
					'redactor'		=> TRUE,
					'form_legend'	=> 'The form of editing page. Language: ',
					'category'		=> $this->mdcategory->read_records($this->uri->segment(5)),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		if($this->input->post('submit')):
			unset($_POST['submit']);
			$this->form_validation->set_rules('title',' ','trim');
			$this->form_validation->set_rules('description',' ','trim');
			$this->form_validation->set_rules('link',' ','required|trim');
			$this->form_validation->set_rules('url',' ','trim');
			$this->form_validation->set_rules('content',' ','trim');
			$this->form_validation->set_rules('category',' ','trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Error. Incorrectly filled in the required fields!');
				redirect($this->uri->uri_string());
			else:
				$update = $this->input->post();
				if(!empty($update['url'])):
					$update['url'] = $this->valid_url_symbol($update['url']);
				endif;
				if(!isset($update['category'])):
					$update['category'] = 0;
				endif;
				$update['language'] = $this->uri->segment(5);
				$result = $this->mdpages->update_record($this->uri->segment(7),$update);
				if($result):
					$this->session->set_userdata('msgs','Page <strong>'.$update['link'].'</strong> updating!');
				endif;
				redirect('admin-panel/actions/pages');
			endif;
		endif;
		
		$this->load->view("admin_interface/pages",$pagevar);
	}
	
	/******************************************* categories ******************************************************/
	
	public function lang_categories(){
		
		$pagevar = array(
					'baseurl' 		=> base_url(),
					'langs'			=> $this->mdlanguages->read_records('languages'),
					'langs_pages'	=> $this->mdpages->read_pages(),
					'category'		=> $this->mdcategory->read_records($this->uri->segment(5)),
					'form_legend'	=> 'Category list pages. Language: ',
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		if($this->input->post('inscategory')):
			unset($_POST['inscategory']);
			$this->form_validation->set_rules('title',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Error. Incorrectly filled in the required fields!');
				redirect($this->uri->uri_string());
			else:
				$insert = $this->input->post();
				$insert['language'] = $this->uri->segment(5);
				$result = $this->mdcategory->insert_record($insert);
				if($result):
					$this->session->set_userdata('msgs','Category <strong>'.$insert['title'].'</strong> added!');
				endif;
				redirect($this->uri->uri_string());
			endif;
		endif;
		
		$this->load->view("admin_interface/categories",$pagevar);
	}
	
	/********************************************* users ********************************************************/
	
	public function users_list(){
		
		$from = intval($this->uri->segment(5));
		$pagevar = array(
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'users'			=> $this->mdusers->read_limit_clients(10,$from),
					'pages'			=> array(),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$pagevar['pages'] = $this->pagination('admin-panel/actions//users-list',5,$this->mdusers->count_clients(),10);
		
		for($i=0;$i<count($pagevar['users']);$i++):
			$pagevar['users'][$i]['password'] = $this->encrypt->decode($pagevar['users'][$i]['trade_password']);
			$pagevar['users'][$i]['signdate'] = $this->operation_dot_date($pagevar['users'][$i]['signdate']);
		endfor;
		
		$this->session->set_userdata('backpath',$pagevar['baseurl'].$this->uri->uri_string());
		$this->load->view("admin_interface/users/users",$pagevar);
	}
	
	public function user_edit(){
		
		$pagevar = array(
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'user'			=> $this->mdusers->read_record($this->uri->segment(6),'users'),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		if($this->input->post('submit')):
			unset($_POST['submit']);
			$this->form_validation->set_rules('organization',' ','required|trim');
			$this->form_validation->set_rules('grn',' ','required|trim');
			$this->form_validation->set_rules('inn',' ','required|trim');
			$this->form_validation->set_rules('number',' ','required|trim');
			$this->form_validation->set_rules('address',' ','required|trim');
			$this->form_validation->set_rules('phones',' ','trim');
			$this->form_validation->set_rules('login',' ','required|trim');
			$this->form_validation->set_rules('password',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка. Неверно заполены необходимые поля<br/>');
				$this->user_edit();
				return FALSE;
			else:
				$this->mdusers->update_record($this->uri->segment(6),$_POST);
				$this->session->set_userdata('msgs','Запись сохранена успешно.');
				redirect($this->session->userdata('backpath'));
			endif;
		endif;
		$pagevar['user']['pass'] = $this->encrypt->decode($pagevar['user']['cryptpassword']);
		$this->load->view("admin_interface/users/user-edit",$pagevar);
	}
	
	public function user_delete(){
		
		$id = $this->uri->segment(6);
		if($id):
			$result = $this->mdusers->delete_record($id,'users');
			$this->session->set_userdata('msgs','Пользователь удален успешно.');
			redirect($this->session->userdata('backpath'));
		else:
			show_404();
		endif;
	}
}