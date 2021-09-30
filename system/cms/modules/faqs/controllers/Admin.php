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
	
	}
	
	public function index()
	{
		$css_global = array();
		
		$css = array();

        $js_global = array('plugins/tablednd/tablednd.js');
        
        $js = array(
	        'manager.js'
        );
        
        $sort_status = $this->faqs_m->sort_status($this->module->id);
        
        $data = array(
			'title' => '',
			'css_global' => css_global($css_global, ADMIN_THEME) ,
			'css' => css($css, $this->module->uri) ,
			'js_global' => js_global($js_global, ADMIN_THEME) ,
			'js' => js($js, $this->module->uri) ,
			'message' => '' ,
			'team' => $this->faqs_m->get_all() ,
			'sort_status' => $sort_status->status 
		);
		
		$data['partial']  = $this->load->view('admin/manager', $data, true);
			$this->load->view($this->admin_theme.'/templates/default', $data);
	}
	
	
	public function category()
	{
		$css_global = array();
		
		$css = array();

        $js_global = array('plugins/tablednd/tablednd.js');
        
        $js = array(
	        'manager.js'
        );
        
        $sort_status = $this->faqs_m->sort_status($this->module->id);
        
        $cat = $this->uri->segment(3);
        
        $data = array(
			'title' => '',
			'css_global' => css_global($css_global, ADMIN_THEME) ,
			'css' => css($css, $this->module->uri) ,
			'js_global' => js_global($js_global, ADMIN_THEME) ,
			'js' => js($js, $this->module->uri) ,
			'message' => '' ,
			'team' => $this->faqs_m->get_all() ,
			'sort_status' => $sort_status->status 
		);
		
		$data['partial']  = $this->load->view('admin/manager', $data, true);
			$this->load->view($this->admin_theme.'/templates/default', $data);
	}
	
	
	public function add()
	{
		
		$response = 0;
		
		if($this->input->is_ajax_request())
		{
			if($this->input->post('add') == 'add_faq')
			{
				$data = array(
					'page_id' => $this->input->post('page_id') ,
					'question' => $this->input->post('question') ,
					'answer' => $this->input->post('answer') ,
					'status' => 'pending' ,
					'is_active' => 1
				);
				
				if($id = $this->faqs_m->add($data))
				{
					
					$response = 1;
				}
			}
			
			echo json_encode(array('response' => $response, 'id' => $id ));
			exit();
		}
		
		$data['partial']  = $this->load->view('admin/add', $data, true);
			$this->load->view($this->admin_theme.'/templates/default', $data);
	}
	
	public function edit()
	{
		$data = array();
		
		$data['partial']  = $this->load->view('admin/edit', $data, true);
			$this->load->view($this->admin_theme.'/templates/default', $data);
	}
	
	
	
	public function remove()
	{
		if($this->input->is_ajax_request())
		{
			$success = 0;
			
			$id = $this->input->post('id');
			{
				if($id > 0)
				{
					if($this->faqs_m->remove($id))
					{
						$success = 1;
					}
				}
			}
			echo json_encode(array('success' => $success));
			exit();
		}
	}
	
	public function get_faq()
	{
		if($this->input->is_ajax_request())
		{
			$success = 0;
			$id = $this->input->post('id');
			if($id > 0)
			{
				$success = 1 ;
				
				$faq = $this->faqs_m->get($id);
				
				$staging_status = $faq->status != 'live' ? '
				<div class="row">
					<div class="col-xs-8">
						<div class="alert alert-info" role="alert">
							<p><i class="fa fa-exclamation-circle"></i> You have recent program changes that are pending!</p>
						</div>
					</div>
					<div class="col-xs-4 moxie-btns">
						
						<a class="btn btn-warning" target="_blank" href="http://www.agios.com/staging'.$program->page_link.'">REVIEW</a>
						<a id="publish-program" class="btn btn-success" href="#" data-id="'.$id.'" >PUBLISH</a>
					</div>
				</div>
				' : '' ;
			}
			
			echo json_encode(array('success' => $success, 'question' => $faq->question, 'answer' => $faq->answer, 'staging_status' => $staging_status));
		}
		
		
		exit();
	}
}