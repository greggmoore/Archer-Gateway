<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, findmoxie.com
 * @package \System\Application\
 * copyright Copyright (c) 2016, MOXIE.COM
 */

// ------------------------------------------------------------------------

class Admin extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_m');
	
	}
	
	public function index()
	{
		$css_global = array();
		
		$css = array();

        $js_global = array();
        
        $js = array(
	        'manager.js'
        );
		
		$data = array(
			'title' => 'USER MANAGER',
			'css_global' => css_global($css_global, ADMIN_THEME) ,
			'css' => css($css, $this->module->uri) ,
			'js_global' => js_global($js_global, ADMIN_THEME) ,
			'js' => js($js, $this->module->uri) ,
			'message' => '' ,
			'users' => $this->users_m->get_all() ,
			'success' => '' 
		);
		
		$data['partial']  = $this->load->view('admin/manager', $data, true);
			$this->load->view($this->admin_theme.'/templates/default', $data);
	}
	
	
	public function add()
	{
		$response = 0;
		
		if($this->input->is_ajax_request())
		{
			if($this->input->post('add') == 'add_user')
			{
				$first_name = ucfirst(strtolower($this->input->post('first_name'))) ;
				$last_name = ucfirst(strtolower($this->input->post('last_name'))) ;
				$fullname = $first_name.' '.$last_name ;
				$email = ucfirst(strtolower($this->input->post('email'))) ;
				$username = ucfirst(strtolower($this->input->post('username'))) ;
				
				$groups = $this->input->post('groups') ? $this->input->post('groups') : array(3);
				$password = $this->input->post('password');
				
				$uri = url_title($fullname, '-', TRUE);
				
				$data = array(
					'active' => $this->input->post('active') ,
					'http_user_agent' => $this->input->user_agent(),
					'first_name' => $first_name,
					'last_name' => $last_name,
					'fullname' => $fullname,
					'uri' => $uri
				);
				
				if($id = $this->ion_auth->register($username, $password, $email, $data, $groups))
				{
					$response = 1;
				}
			}
			
			echo json_encode( array('response' => 1, 'id' => $id));
		}
		
		$data = array();
		$data = $css_global = $css = $js_global = $js = array();
		
		$css_global = array();
		
		$js_global = array();
		
		$dd_params = 'class="form-control select2 m-b-10 select2-multiple" multiple="multiple" data-placeholder="Choose"';
		$groups = $this->users_m->groups();
		$users_groups = array();
		
		$data = array(
			'title' => 'ADD PAGE',
			'css_global' => css_global($css_global, ADMIN_THEME) ,
			'css' => css('add.css', $this->module->uri) ,
			'js_global' => js_global($js_global, ADMIN_THEME) ,
			'js' => js(array('add.js'), $this->module->uri) ,
			'groups' => form_multiselect('groups[]', $groups, $users_groups, $dd_params)
		);
		
		$data['partial']  = $this->load->view('admin/add', $data, true);
			$this->load->view($this->admin_theme.'/templates/default', $data);
	}
	
	
	
	public function edit()
	{
		$id = $this->uri->segment(4);
		if($this->input->is_ajax_request())
		{
			$response = 0;
			$html = '';
			$has_html = 0;
			$response_txt = 'Could not process request. Please try again or contact support.';	
			
			$id = $this->input->post('id');
			
			if($this->input->post('update') == 'account_info')
			{
				
				$first_name = ucfirst(strtolower($this->input->post('first_name'))) ;
				$last_name = ucfirst(strtolower($this->input->post('last_name'))) ;
				
				$fullname = $first_name.' '.$last_name ;
				
				$uri = url_title($fullname, '-', TRUE);
				$username = url_title($fullname, '', TRUE);
				
				$data = array(
					'first_name' => $first_name , 
					'last_name' => $last_name , 
					'fullname' => $fullname , 
					'uri' => $uri ,
					'username' => $username ,
					'phone' => $this->input->post('phone'),
					'mobile' => $this->input->post('mobile') ,
					'email' => $this->input->post('email')
				);
				
				if ($this->ion_auth->update($id, $data))
				{
					$response = 1;
					$response_txt = 'The <strong>account info</strong> has been updated.';
				}
			}
						
			if($this->input->post('update') == 'security')
			{
				$password = $this->input->post('password');
				
				$data = array(
					'password' => $password
				);
				
				if($this->ion_auth->update($id, $data))
				{
					$response = 1;
					$response_txt = 'The <strong>password</strong> has been updated.';
				}
			}
			
			//Add Zip Codes
			if($this->input->post('update') == 'add_zipcodes')
			{
				$zipcodes = explode("\n", $this->input->post('zipcodes'));
				if(!empty($zipcodes))
				{
					foreach($zipcodes as $key)
					{
						$zip=trim($key);
						if (!$zip) { continue; }
						
						$this->users_m->toggle_zipcode($id, $zip);
							
					}
					
					$response = 1;
					$has_html = 1;
					$html = $this->users_m->user_zipcodes($id);
					$response_txt = 'The users <strong>zip codes</strong> have been updated.';
				}
			}
			
			//Remove zipcodes
			if($this->input->post('update') == 'remove_zipcodes')
			{
				$zipcodes = $this->input->post('deletezip');
				foreach($zipcodes as $zip)
				{
					$this->users_m->zipcode_delete($id, $zip);					
				}
				
					$response = 1;
					$has_html = 1 ;
					$html = $this->users_m->user_zipcodes($id);
					$response_txt = 'The users <strong>zip codes</strong> have been removed.';
			}
			
			if($this->input->post('update') == 'options')
			{
				$groups = $this->input->post('groups');
				
				$data = array(
					'active' => $this->input->post('active')
				);
				
				
				if(!empty($groups))
				{
					if($this->ion_auth->remove_from_group($group_ids = false, $id))
					{
						foreach ($groups as $group)
						{
							$this->ion_auth->add_to_group($group, $id);
						}
					}
				}
				
				if ($this->ion_auth->update($id, $data))
				{
					$response = 1;
					$response_txt = 'The <strong>options</strong> have been updated.';
				}
			}
			
			echo json_encode(array('response' => $response, 'response_txt' => $response_txt, 'has_html' => $has_html, 'html' => $html ));
			exit();
		}
		
		
		$data = $css_global = $css = $js_global = $js = array();
		
		
		$u = $this->ion_auth->user($id)->row();
		if(empty($u))
		 {
			 redirect('/admin/users/index', 'refresh');
		 }
		 
		 $css_global = array(
			'plugins/summernote/summernote.css'
		);
		
		$js = array('edit.js');
		$js_global = array('plugins/summernote/summernote.min.js');
		
		
		$dd_params = 'class="form-control select2 m-b-10 select2-multiple" multiple="multiple" data-placeholder="Choose"';
		$groups = $this->users_m->groups();
		
		$users_groups = $this->users_m->users_groups($id);
		$zipcodes = $this->users_m->user_zipcodes($id);
		
		//print_r($zipcodes); exit();
		
		$micros = NULL ;
		$micros = $this->users_m->micro_get_all_for_admin($id);
		
		
		$data = array(
			'title' => 'EDIT USER: '.$u->fullname,
			'css_global' => css_global($css_global, ADMIN_THEME) ,
			'css' => css('edit.css', $this->module->uri) ,
			'js_global' => js_global($js_global, ADMIN_THEME) ,
			'js' => js($js, $this->module->uri) ,
			'groups' => form_multiselect('groups[]', $groups, $users_groups, $dd_params),
			'data' => $u ,
			'zipcodes' => $zipcodes ,
			'micros' => $micros ,
			'success' => '' 
		);
		
		$data['partial']  = $this->load->view('admin/edit', $data, true);
			$this->load->view($this->admin_theme.'/templates/default', $data);
	}
	
	
	
	public function remove()
	{
		//$this->ion_auth->delete_user($id)
		
		if($this->input->is_ajax_request())
		{
			$success = 0;
			
			$id = $this->input->post('id');
			{
				if($id > 0)
				{
					if($this->ion_auth->delete_user($id))
					{
						$success = 1;
					}
				}
			}
			echo json_encode(array('success' => $success));
			exit();
		}
	}
	
	
	/**
	 * Check username
	 *
	 * @access	public
	 * @param	string
	 * @return	array
	 */
	public function check_username()
	{
		$html = NULL ;
		if($this->input->is_ajax_request())
		{
		
			$username = trim($this->input->post('username'));
			$original_username = trim($this->input->post('original_username'));
	
			if($username == $ousername)
			{
				$response = 1;
				$html = '<font style="color: green;">The username is available.</font>';
			}
				else
			{
				if($this->users_m->check_username($username))
				{
					//false
					$response = 0;
					$html = '<font style="color: red">The username is not available.</font>';
				}
					else
				{
					$response = 1;
					$html = '<font style="color: green;">The username is available.</font>';
				}
			}
					
			
				
			echo json_encode(array('response' => $response, 'html' => $html));
			exit();
		}
		
	}
	
	public function remove_group()
	{
		if($this->input->is_ajax_request())
		{
			$success = 0;
			
			$id = $this->input->post('id');
			{
				if($id > 0)
				{
					if($this->ion_auth->delete_group($id))
					{
						$success = 1;
					}
				}
			}
			echo json_encode(array('success' => $success));
			exit();
		}
	}
	
	/**
	 * Check uri
	 *
	 * @access	public
	 * @param	string
	 * @return	array
	 */
	public function check_uri()
	{
		$html = NULL ;
		if($this->input->is_ajax_request())
		{
		
			$uri = trim($this->input->post('uri'));
			$original_uri = trim($this->input->post('original_uri'));
	
			if($uri == $original_uri)
			{
				$response = 1;
				$html = '<font style="color: green;">The uri is available.</font>';
			}
				else
			{
				if($this->users_m->check_uri($uri))
				{
					//false
					$response = 0;
					$html = '<font style="color: red">The uri is not available.</font>';
				}
					else
				{
					$response = 1;
					$html = '<font style="color: green;">The uri is available.</font>';
				}
			}
					
			
				
			echo json_encode(array('response' => $response, 'html' => $html));
			exit();
		}
		
	}
	
	
	public function get_micro()
	{
		$response = 0;
		
		$data = NULL ;
		
		if($this->input->is_ajax_request())
		{
			$id = $this->input->post('id');
			
			if($data = $this->users_m->micro_get($id, ''))
			{
				$response = 1;
			}
			
		}
		echo json_encode(array('response' => $response, 'data' => $data));
		exit();
	}

}