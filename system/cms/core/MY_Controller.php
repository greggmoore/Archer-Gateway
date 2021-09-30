<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends MX_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		ci()->settings = $this->settings = array_to_object($this->settings_m->site_settings());
				
		//Define default site settings
		if(!empty($this->settings))
		{
			foreach($this->settings as $key => $setting)
			{
				defined(strtoupper($key)) or define(strtoupper($key), $setting).'<br />';
			}
		}
		
		//set ajax request
		ci()->is_ajax = $this->is_ajax = $this->input->is_ajax_request();
		// Get user data
		ci()->user = $this->user = $this->ion_auth->user();
		// Work out module, controller and method and make them accessable throught the CI instance
		ci()->module = $this->module = $this->router->fetch_module();

		
		ci()->controller = $this->controller = $this->router->fetch_class();
		ci()->method = $this->method = $this->router->fetch_method();
		
		//Set themes
		ci()->admin_theme = $this->admin_theme = $this->settings->admin_theme ? $this->settings->admin_theme : 'admin';
		ci()->public_theme = $this->public_theme = $this->settings->public_theme ? $this->settings->public_theme : 'default';
		ci()->staging_theme = $this->staging_theme = 'staging';
		//ci()->assets = $this->assets = $this->settings->app_path.'assets';
		
		$this->session->set_userdata('previous_page', uri_string());
		
		if (!$this->modules_m->exists($this->module) && !in_array($this->module, $this->config->item('ignore_modules')))
		{
			//show_404();
			//redirect('/', 'refresh');
		}
		
		
		header("Access-Control-Allow-Headers: Authorization, Content-Type");
		header("Access-Control-Allow-Origin: *");
		header('content-type: application/json; charset=utf-8');
		
		
	}
}

/**
 * Returns the CodeIgniter object.
 *
 * Example: ci()->db->get('table');
 *
 * @return \CI_Controller
 */
function ci()
{
	return get_instance();
}