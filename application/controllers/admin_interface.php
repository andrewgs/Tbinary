<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_interface extends MY_Controller{
	
	function __construct(){
		
		parent::__construct();
		if(!$this->loginstatus || $this->user['uid']):
			redirect('');
		endif;
	}
	
	public function actions_settings(){
		
		$pagevar = array(
					'baseurl' 		=> base_url(),
					'settings'		=> array('registration'=>$this->mdsettings->read_field(1,'settings','link'),'charts'=>$this->mdsettings->read_field(2,'settings','link'),'deposit'=>$this->mdsettings->read_field(3,'settings','link')),
					'form_legend'	=> 'The form of editing settings links.',
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');

		if($this->input->post('submit')):
			unset($_POST['submit']);
			$this->form_validation->set_rules('registration',' ','trim');
			$this->form_validation->set_rules('charts',' ','trim');
			$this->form_validation->set_rules('deposit',' ','trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Error. Incorrectly filled in the required fields!');
				redirect($this->uri->uri_string());
			else:
				$update = $this->input->post();
				$this->mdsettings->update_field(1,'link',$update['registration'],'settings');
				$this->mdsettings->update_field(2,'link',$update['charts'],'settings');
				$this->mdsettings->update_field(3,'link',$update['deposit'],'settings');
				$this->session->set_userdata('msgs','Settings saved!');
				redirect($this->uri->uri_string());
			endif;
		endif;
		$this->load->view("admin_interface/settings",$pagevar);
	}
	
	/******************************************* pages_lang ******************************************************/
	
	public function home_page(){
		
		$pagevar = array(
					'baseurl' 		=> base_url(),
					'langs'			=> $this->mdlanguages->read_records('languages'),
					'langs_pages'	=> $this->mdpages->read_pages(),
					'page'			=> $this->mdpages->home_pages($this->uri->segment(5)),
					'form_legend'	=> 'The form of editing home page. Language: '.strtoupper($this->mdlanguages->read_field($this->uri->segment(5),'languages','name')),
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
				if(!empty($insert['name'])):
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
				else:
					$this->session->set_userdata('msgr','Error. Incorrect language name!');
					redirect($this->uri->uri_string());
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
					'form_legend'	=> 'The form of creating a new page. Language: '.strtoupper($this->mdlanguages->read_field($this->uri->segment(5),'languages','name')),
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
					'form_legend'	=> 'The form of editing page. Language: '.strtoupper($this->mdlanguages->read_field($this->uri->segment(5),'languages','name')),
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
	
	public function lang_delete_page(){
		
		$page = $this->uri->segment(5);
		$manage = $this->mdpages->read_field($page,'pages','manage');
		if($page && $manage):
			$this->mdpages->delete_record($page,'pages');
			$this->session->set_userdata('msgs','Page deleted successfully.');
		else:
			$this->session->set_userdata('msgr','Error! Impossible to remove page.');
		endif;
		if(isset($_SERVER['HTTP_REFERER'])):
			redirect($_SERVER['HTTP_REFERER']);
		else:
			redirect('admin-panel/actions/pages');
		endif;
	}
	
	
	/******************************************* categories ******************************************************/
	
	public function lang_categories(){
		
		$pagevar = array(
					'baseurl' 		=> base_url(),
					'langs'			=> $this->mdlanguages->read_records('languages'),
					'langs_pages'	=> $this->mdpages->read_pages(),
					'category'		=> $this->mdcategory->read_records($this->uri->segment(5)),
					'form_legend'	=> 'Category list pages. Language: '.strtoupper($this->mdlanguages->read_field($this->uri->segment(5),'languages','name')),
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
		
		if($this->input->post('updcategory')):
			unset($_POST['updcategory']);
			$this->form_validation->set_rules('title',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Error. Incorrectly filled in the required fields!');
				redirect($this->uri->uri_string());
			else:
				$result = $this->mdcategory->update_record($this->input->post());
				if($result):
					$this->session->set_userdata('msgs','Category <strong>'.$this->input->post('title').'</strong> updated!');
				endif;
				redirect($this->uri->uri_string());
			endif;
		endif;
		
		$this->load->view("admin_interface/categories",$pagevar);
	}
	
	public function category_detele(){
		
		$category = $this->uri->segment(5);
		if($category):
			$this->mdcategory->delete_record($category,'category');
			$this->mdpages->delete_category($category);
			$this->session->set_userdata('msgs','Category deleted successfully.');
		else:
			$this->session->set_userdata('msgr','Error! Impossible to remove category.');
		endif;
		if(isset($_SERVER['HTTP_REFERER'])):
			redirect($_SERVER['HTTP_REFERER']);
		else:
			redirect('admin-panel/actions/pages');
		endif;
	}
	
	/******************************************* properties ******************************************************/
	
	public function lang_properties(){
		
		$pagevar = array(
					'baseurl' 		=> base_url(),
					'langs'			=> $this->mdlanguages->read_records('languages'),
					'langs_pages'	=> $this->mdpages->read_pages(),
					'lang'			=> $this->mdlanguages->read_record($this->uri->segment(5),'languages'),
					'form_legend'	=> 'Properties language. Language: '.strtoupper($this->mdlanguages->read_field($this->uri->segment(5),'languages','name')),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		if($this->input->post('submit')):
			unset($_POST['submit']);
			$this->form_validation->set_rules('name',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Error. Incorrectly filled in the required fields!');
				redirect($this->uri->uri_string());
			else:
				$update = $this->input->post();
				$update['name'] = $this->english_symbol($update['name']);
				if(!empty($update['name'])):
					if(!isset($update['active'])):
						$update['active'] = 0;
						$base_language = $this->mdlanguages->base_language();
						$this->mdusers->set_base_lang($this->uri->segment(5),$base_language);
					endif;
					$result = $this->mdlanguages->update_record($this->uri->segment(5),$update);
					if($result):
						$this->session->set_userdata('msgs','Language <strong>'.$update['name'].'</strong> updated!');
					endif;
					redirect('admin-panel/actions/pages');
				else:
					$this->session->set_userdata('msgr','Error. Incorrect language name!');
					redirect($this->uri->uri_string());
				endif;
			endif;
		endif;
		
		$this->load->view("admin_interface/properties",$pagevar);
	}
	
	public function lang_detele(){
		
		$base_language = $this->mdlanguages->base_language();
		$lang = $this->uri->segment(5);
		if($lang != $base_language):
			$this->mdlanguages->delete_record($lang,'languages');
			$this->mdpages->delete_language($lang);
			$this->mdcategory->delete_language($lang);
			$this->mdusers->set_base_lang($lang,$base_language);
			$this->session->set_userdata('msgs','Languages deleted successfully.');
			redirect('admin-panel/actions/pages');
		else:
			$this->session->set_userdata('msgr','Error! Impossible to remove language.');
			redirect($this->uri->uri_string());
		endif;
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
		
		$pagevar['pages'] = $this->pagination('admin-panel/actions/users-list',5,$this->mdusers->count_clients(),10);
		
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
					'langs'			=> $this->mdlanguages->read_records('languages'),
					'user'			=> $this->mdusers->read_record($this->uri->segment(6),'users'),
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
				if(isset($update['coach'])):
					$update['coach'] = 0;
				else:
					$update['coach'] = 1;
				endif;
				if(!isset($update['active'])):
					$update['active'] = 0;
				endif;
				$update['id'] = $this->uri->segment(6);
				$result = $this->mdusers->update_record($update);
				if($result):
					$this->session->set_userdata('msgs','Profile <strong>'.$pagevar['user']['email'].'</strong> updating!');
				endif;
				redirect($this->session->userdata('backpath'));
			endif;
		endif;
		$pagevar['user']['password'] = $this->encrypt->decode($pagevar['user']['trade_password']);
		$pagevar['user']['signdate'] = $this->operation_dot_date($pagevar['user']['signdate']);
		$this->load->view("admin_interface/users/user-edit",$pagevar);
	}
	
	public function user_delete(){
		
		$id = $this->uri->segment(6);
		if($id):
			$result = $this->mdusers->delete_record($id,'users');
			$this->session->set_userdata('msgs','User deleted successfully.');
			redirect($this->session->userdata('backpath'));
		else:
			show_404();
		endif;
	}
}