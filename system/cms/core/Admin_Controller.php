<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, findmoxie.com
 * @package \System\Application\
 * copyright Copyright (c) 2016, MOXIE.COM
 */

// ------------------------------------------------------------------------

class Admin_Controller extends MY_Controller {
	
	public function __construct() {
		
		parent::__construct();
		
		$this->template_path = $this->settings->app_path.'modules/themes/'.$this->admin_theme;
		
		if ( ! self::_check_access())
		{
			$this->session->set_flashdata('error');
			redirect();
		}
		
		$page_class = '';
		
		if($this->ion_auth->logged_in())
		{
			$this->user = $data['user'] = $this->ion_auth->user()->row();
			
			define('UID', $this->user->id);
						
			$user_image = $this->user->image ? $this->user->image : 'no-user.jpg' ;
			//$moxienews = $this->dashboard_m->moxienews();
			
			$data = array(
				'user' => $this->user,
				'user_image' => $user_image ,
				'page_class' => 'layout layout-header-fixed'
				
			);
			
			$this->load->models(array('Weather_m'));
			$this->load->vars($data);
		}
		
		//Get module
        if ($this->modules_m->exists($this->module))
		{
			ci()->module = $this->module = $this->modules_m->get($this->module);
		}
	}
	
	private function _check_access()
	{
		$ignored_pages = array('admin/contact', 'admin/login', 'admin/logout', 'admin/help', 'admin/forgot_password', 'admin/reset_password', 'admin/password_reset_sent');
		$current_page = $this->uri->segment(1) . '/' . $this->uri->segment(2, 'index');
		
		
		// Dont need to log in, this is an open page
		if (in_array($current_page, $ignored_pages))
		{
			return TRUE;
			//echo $this->template_path;
		}

		if (!$this->ion_auth->logged_in())
		{
			redirect('admin/login', 'refresh');
		}
		
		// Admins can go straight in
		//if ($this->ion_auth->is_admin())
		$admin_groups = array(1,2);
		if ($this->ion_auth->in_group($admin_groups))
		{
			
			return TRUE;
		}
		
		// good Lord knows what this is... erm...
		return FALSE; 
	}
}