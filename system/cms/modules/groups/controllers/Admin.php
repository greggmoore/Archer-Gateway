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
		$this->load->model('groups_m');
	
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
			'title' => 'USER GROUP MANAGER',
			'css_global' => css_global($css_global, ADMIN_THEME) ,
			'css' => css($css, $this->module->uri) ,
			'js_global' => js_global($js_global, ADMIN_THEME) ,
			'js' => js($js, $this->module->uri) ,
			'message' => '' ,
			'groups' => $this->groups_m->get_all() ,
			'success' => '' 
		);
		
		$data['partial']  = $this->load->view('admin/manager', $data, true);
			$this->load->view($this->admin_theme.'/templates/default', $data);
	}
	
	
	public function add()
	{
		$response = 0;
		
		if($this->input->post('add') == 'add_group')
		{
			$uri = $this->input->post('uri');
			if(empty($uri))
			{
				$name = $this->input->post('name');
				$uri = $uri = url_title($name, '-', TRUE);
			}
			
			$data = array(
				'alt_name' => $this->input->post('alt_name') , 
				'name' => $name , 
				'desctiption' => $this->input->post('description') , 
				'uri' => $uri
			);
			
			if($id = $this->groups_m->add($data))
			{
				$response = 1;
			}
			
			echo json_encode(array('response' => $response, 'id' => $id ));
			exit();
		}
		
		$data = array();
		
		$data['partial']  = $this->load->view('admin/add', $data, true);
			$this->load->view($this->admin_theme.'/templates/default', $data);
	}
	
	public function edit()
	{
		
		if($this->input->is_ajax_request())
		{
			$response = 0;
			$response_txt = 'Could not process request. Please try again or contact support.';	
			
			$id = $this->input->post('id');
						
			
			if($this->input->post('update') == 'group_info')
			{
				
				$uri = $this->input->post('uri');
				if(empty($uri))
				{
					$name = $this->input->post('name');
					$uri = $uri = url_title($name, '-', TRUE);
				}
				
				$data = array(
					'alt_name' => $this->input->post('alt_name') , 
					'name' => $name , 
					'desctiption' => $this->input->post('description') , 
					'uri' => $uri
				);
				
				if($this->groups_m->update($id, $data))
				{
					$response = 1;
					$response_txt = 'The <strong>group info</strong> has been updated.';
				}
			}
			
			echo json_encode(array('response' => $response, 'response_txt' => $response_txt ));
			exit();
		}
		
		$data = $css_global = $css = $js_global = $js = array();
		$id = $this->uri->segment(4);
		
		$group = $this->groups_m->get_group($id);
		if(empty($group))
		 {
			 redirect('/admin/groups/index', 'refresh');
		 }
		 
		 $css_global = array();
		
		$js = array('edit.js');
		$js_global = array();

		
		$data = array(
			'title' => 'EDIT USER: '.$group->alt_name,
			'css_global' => css_global($css_global, ADMIN_THEME) ,
			'css' => css('edit.css', $this->module->uri) ,
			'js_global' => js_global($js_global, ADMIN_THEME) ,
			'js' => js($js, $this->module->uri) ,
			'data' => $group ,
			'success' => '' 
		);
		
		$data['partial']  = $this->load->view('admin/edit', $data, true);
			$this->load->view($this->admin_theme.'/templates/default', $data);
	}
	
	
	/**
	 * Check Uri
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
			$valid = TRUE;
			$ou = trim($this->input->post('ou'));
			$uri = trim($this->input->post('uri'));
	
			if($uri == $ou)
			{
				$response = 1;
				$html = '<font style="color: green;">The title/uri is available.</font>';
			}
				else
			{
				if($this->groups_m->check_uri($uri))
				{
					//false
					$response = 0;
					$html = '<font style="color: red">The title/uri is not available.</font>';
				}
					else
				{
					$response = 1;
					$html = '<font style="color: green;">The title/uri is available.</font>';
				}
			}
					
			
				
			echo json_encode(array('response' => $response, 'html' => $html));
			exit();
		}
		
	}
}