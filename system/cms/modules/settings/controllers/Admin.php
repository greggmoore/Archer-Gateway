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
		$this->load->library('phpSEO');
		$this->config->load('environments');
		$this->config->load('states');
	
	}
	
	public function index()
	{
		
		if($this->input->is_ajax_request())
		{
			$response = 0;
			
			if($this->input->post('update') == 'site_settings')
			{
				unset($_POST['update']);
				$data = $this->input->post();
				
				$valid_keys = array(
					'site_name',
					'site_domain',
					'public_theme',
					'admin_theme'
				);
				
				if($this->settings_m->update($data, $valid_keys))
				{
					$response = 1;
					$response_txt = 'The <strong>site settings</strong> have been updated.';
				}
			}
			
			if($this->input->post('update') == 'contact_settings')
			{
				unset($_POST['update']);
				$data = $this->input->post();
				
				$valid_keys = array(
					'default_email',
					'default_telephone',
					'default_mobile_phone',
					'default_toll_phone' ,
					'default_fax'
				);
				
				if($this->settings_m->update($data, $valid_keys))
				{
					$response = 1;
					$response_txt = 'The <strong>contact settings</strong> have been updated.';
				}
			}
			
			if($this->input->post('update') == 'location_settings')
			{
				unset($_POST['update']);
				$data = $this->input->post();
				
				$valid_keys = array(
					'default_address',
					'default_address2',
					'default_city',
					'default_state' ,
					'default_zipcode'
				);
				
				if($this->settings_m->update($data, $valid_keys))
				{
					$response = 1;
					$response_txt = 'The <strong>location settings</strong> have been updated.';
				}
			}
			
			
			if($this->input->post('update') == 'analytics_settings')
			{
				unset($_POST['update']);
				$data = $this->input->post();
				
				$valid_keys = array(
					'ga_profile',
					'ga_tracking_code',
					'ga_tag_manager',
					'bing_verification_code'
				);
				
				if($this->settings_m->update($data, $valid_keys))
				{
					$response = 1;
					$response_txt = 'The <strong>analytics settings</strong> have been updated.';
				}
			}
			
			echo json_encode(array('response' => $response, 'response_txt' => $response_txt ));
			exit();
		}
		
		$data = $css_global = $css = $js_global = $js = array();
		
		$settings = $this->settings_m->site_settings();

		$css_global = array();
		$js = array('settings.js');
		$js_global = array();
		
		$data = array(
			'title' => 'SITE SETTINGS ' ,
			'css_global' => css_global($css_global, ADMIN_THEME) ,
			'css' => css('edit.css', $this->module->uri) ,
			'js_global' => js_global($js_global, ADMIN_THEME) ,
			'js' => js($js, $this->module->uri) ,
			'data' => $settings ,
			'states' => $this->config->item('states')
		);

		
		$data['partial']  = $this->load->view('admin/settings', $data, true);
			$this->load->view($this->admin_theme.'/templates/default', $data);
	}

}