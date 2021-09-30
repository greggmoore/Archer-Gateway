<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, blumoocreative.com
 * @package System\Cms\Modules\Changeme\Models
 * copyright Copyright (c) 2016, BluMoo Creative, LLC
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
		$data = array();
		$css_global = array();
		$css = array();
        $js_global = array('plugins/tablednd/tablednd.js');
        
        $js = array(
	        'manager.js'
        );
        
        $sort_status = $this->testimonials_m->sort_status($this->module->id);
        
       
		
		$data = array(
			'title' => 'TESTIMONIALS',
			'css_global' => css_global($css_global, ADMIN_THEME) ,
			'css' => css($css, $this->module->uri) ,
			'js_global' => js_global($js_global, ADMIN_THEME) ,
			'js' => js($js, $this->module->uri) ,
			'message' => '' ,
			'testimonials' => $this->admin_m->get_all() ,
			'sort_status' => $sort_status->status 
		);
		
		$data['partial']  = $this->load->view('admin/manager', $data, true);
			$this->load->view($this->admin_theme.'/templates/default', $data);
	}
	
	public function patient_stories()
	{
		$data = array();
		$css_global = array();
		$css = array();
        $js_global = array('plugins/tablednd/tablednd.js');
        
        $js = array(
	        'manager.js'
        );
        
        $sort_status = $this->testimonials_m->sort_status($this->module->id);
        $testimonials = $this->testimonials_m->get_all(array('t.cid' => 1));
        
		
		$data = array(
			'title' => 'Patient Stories',
			'css_global' => css_global($css_global, ADMIN_THEME) ,
			'css' => css($css, $this->module->uri) ,
			'js_global' => js_global($js_global, ADMIN_THEME) ,
			'js' => js($js, $this->module->uri) ,
			'testimonials' => $testimonials ,
			'sort_status' => $sort_status->status
		);
		
		$data['partial']  = $this->load->view('admin/manager_patient_stories', $data, true);
			$this->load->view($this->admin_theme.'/templates/default', $data);
	}
	
	
	public function add_patient_stories()
	{
		
		if($this->input->is_ajax_request())
		{
			$response = 0;
			if($this->input->post('add') == 'add_story')
			{
				$photo = $this->input->post('photo') ? $this->input->post('photo') : '' ;
				
				$data = array(
					'quote' => $this->input->post('quote'),
					'cite' => $this->input->post('cite'),
					'photo' => $photo,
					'created_ts' => date('Y-m-d H:i:s') ,
					'cid' => 1 ,
					'status' => 'pending'
				);
				
				
				
				if($id = $this->testimonials_m->add($data))
				{
					$response = 1;
				}
				
				echo json_encode(array('response' => $response, 'id' => $id));
				exit();
			}
		}
		
		$data = $css_global = $css = $js_global = $js = array();
		
		$category = $this->uri->segment(3);

		switch($category)
		{
			case 'patient-stories':
				$section_title = 'Patients &amp; Caregivers';
				$section_path = '/admin/patients-caregivers/edit/7';
				$view_file = 'add_patient_stories';
				$cat_title = 'Patient Stories';
				$cat_path = '/admin/patients-caregivers/patient-stories';
				$js_file = 'add_patient_stories.js';
				break;
			
			case 'team-testimonials':
				$section_title = 'Patients &amp; Caregivers';
				$section_path = '/admin/patients-caregivers/edit/7';
				$view_file = 'edit_team_testimonials';
				$cat_title = 'Team Testimonials';
				$cat_path = 'team-testimonials';
				$js_file = 'add_team_testimonials.js';
				break;
			
			default:
				$section_title = 'Patients &amp; Caregivers';
				$section_path = '/admin/patients-caregivers/edit/7';
				break;
		}
		
		
		$data = array(
			'title' => $cat_title ? $cat_title : 'Testimonials' ,
			'cat_path' => $cat_path ? $cat_path : '' ,
			'cat_title' => $cat_title ? $cat_title : '' ,
			'css_global' => css_global($css_global, ADMIN_THEME) ,
			'css' => css('add.css', $this->module->uri) ,
			'js_global' => js_global($js_global, ADMIN_THEME) ,
			'js' => js(array('add_patient_stories.js'), $this->module->uri) ,
			'section_title' => $section_title ? $section_title : '',
			'section_path' => $section_path ? $section_path : '' 
		);
		
		$data['partial']  = $this->load->view('admin/'.$view_file, $data, true);
			$this->load->view($this->admin_theme.'/templates/default', $data);
	}
	
	
	
	public function edit()
	{
		
		$data = $css_global = $css = $js_global = $js = array();
		
		if($this->input->is_ajax_request())
		{
			
			$response = 0;
			$id = $this->input->post('id');
			
			
			if($this->input->post('update') == 'quote')
			{
				$data = array(
					'quote' => $this->input->post('quote') ,
					'cite' => $this->input->post('cite') ,
					'cid' => $this->input->post('cid') ,
					'status' => 'pending'
				);
				
				if($this->testimonials_m->update($id, $data))
				{
					$response = 1;
					$response_txt = 'The <strong>quote</strong> has been updated.';
				}
			}

			echo json_encode(array('response' => $response, 'response_txt' => $response_txt ));
			exit();
		}
		
		$id = $this->uri->segment(4);
		if($this->uri->segment(5))
		{
			$id = $this->uri->segment(5);
		}
		
		$category = $this->uri->segment(3);
		
		switch($category)
		{
			case 'patient-stories':
				
				$section_title = 'Patients &amp; Caregivers';
				$section_path = '/admin/patients-caregivers/edit/7';
				$cat_title = 'Patient Stories';
				$cat_path = '/admin/patients-caregivers/patient-stories';
				$full_path = '/admin/patients-caregivers/patient-stories';
				$panel_heading = 'Patient Story';
				$review_path = '/staging/patients-caregivers/our-commitment#stories';
				$view_file = 'edit_patient_stories';
				break;
			
			case 'team-testimonials':
				$section_title = '' ;
				$section_path = '';
				$cat_title = 'Team Testimonials';
				$cat_path = 'team-testimonials';
				$review_path = '/staging/careers/inside-agios#testimonials';
				$view_file = 'edit_team_testimonials';
				break;
			
			default:
				$section_title = 'Testimonials' ;
				$full_path = 'testimonials/index';
				$review_path = '/staging/careers/inside-agios#testimonials';
				$view_file = 'edit';
				break;
		}
		
		
		
		
		$testimonial = $this->testimonials_m->get(array('id' => $id));
		if(empty($testimonial))
		 {
			 redirect('/admin/'.$full_path, 'refresh');
		 }
		
		$css_global = array();
		
		$js = array('edit.js');
		$js_global = array();
		
		$data = array(
			'title' => $cat_title ? $cat_title : 'Testimonials' ,
			'cat_path' => $cat_path ? $cat_path : '' ,
			'cat_title' => $cat_title ? $cat_title : '' ,
			'css_global' => css_global($css_global, ADMIN_THEME) ,
			'css' => css('edit.css', $this->module->uri) ,
			'full_path' => $full_path ? $full_path : '' ,
			'js_global' => js_global($js_global, ADMIN_THEME) ,
			'js' => js($js, $this->module->uri) ,
			'message' => '' ,
			'panel_heading' => $panel_heading ,
			'data' => $testimonial ,
			'section_title' => $section_title ? $section_title : '',
			'section_path' => $section_path ? $section_path : '' ,
			'review_path' => $review_path
		);
				
		$data['partial']  = $this->load->view('admin/'.$view_file, $data, true);
			$this->load->view($this->admin_theme.'/templates/default', $data);
	}
	
	
	
	public function add_photo()
	{
		
		$response = 0;

		$fileTypes = array('jpg', 'jpeg', 'gif', 'png');
		$fileParts = pathinfo($_FILES['Filedata']['name']);
		$filename = 'testimonial-'.time().'.'.strtolower($fileParts['extension']);
		
		$tempFile   = $_FILES['Filedata']['tmp_name'];
		$uploadDir  = $_SERVER['DOCUMENT_ROOT'].'/data/testimonials/tmp/';
		$targetFile = $uploadDir . $filename;
		$savePath = $_SERVER['DOCUMENT_ROOT'] . '/data/testimonials/' . $filename;
		
		if (in_array(strtolower($fileParts['extension']), $fileTypes))
		{
			if(move_uploaded_file($tempFile, $targetFile))
			{
				include('system/cms/libraries/Resize.php');
				$resizeObj = new resize($targetFile);
				$resizeObj -> resizeImage(300, 300, 'crop');
				$resizeObj -> saveImage($savePath, 100);

					$response = 1;
					$response_txt = 'The <strong>photo</strong> has been updated.';
					$response_img = '<img class="img-responsive" src="/data/testimonials/'.$filename.'" />';
			
			}
		}
		
		echo json_encode(array('response' => $response, 'response_txt' => $response_txt, 'response_img' => $response_img, 'response_filename' => $filename));
		exit();

	}
	
	
	
	public function upload_photo()
	{
		
		$response = 0;

				
		$id = $this->input->post('id');
				
		if(!empty($id))
		{
			
			$uri = $this->input->post('uri');
			
			$fileTypes = array('jpg', 'jpeg', 'gif', 'png');
			$fileParts = pathinfo($_FILES['Filedata']['name']);
			$filename = $uri.'-'.time().'.'.strtolower($fileParts['extension']);
			
			$tempFile   = $_FILES['Filedata']['tmp_name'];
			$uploadDir  = $_SERVER['DOCUMENT_ROOT'].'/data/testimonials/tmp/';
			$targetFile = $uploadDir . $filename;
			$savePath = $_SERVER['DOCUMENT_ROOT'] . '/data/testimonials/' . $filename;
			
			if (in_array(strtolower($fileParts['extension']), $fileTypes))
			{
				if(move_uploaded_file($tempFile, $targetFile))
				{
					include('system/cms/libraries/Resize.php');
					$resizeObj = new resize($targetFile);
					$resizeObj -> resizeImage(300, 300, 'crop');
					$resizeObj -> saveImage($savePath, 100);
					
					$data = array(
						'photo' => $filename
					);
					
					if($this->testimonials_m->update($id, $data))
					{
						$response = 1;
						$response_txt = 'The <strong>photo</strong> has been updated.';
						$response_img = '<img class="img-responsive" src="/data/testimonials/'.$filename.'" />';
					}
				
				}
			}
		}
		
		echo json_encode(array('response' => $response, 'response_txt' => $response_txt, 'response_img' => $response_img));
		exit();

	}
	
	
	
	public function publish()
	{
		$response = 0;
		$response_txt = 'error';
		
		if($this->input->is_ajax_request())
		{
			$success = 0;
			
			$id = $this->input->post('id');
			{
				if($id > 0)
				{
					
					$success = 1;
					$data = array(
						'status' => 'live'
					);
						
					if($this->testimonials_m->update($id, $data))
					{
						$success = 1;
						$response_txt = 'The <strong>testimonial</strong> has been published';
						
						$this->testimonials_m->publish();
					}					
					
				}
			}
			echo json_encode(array('success' => $success, 'id' => $id, 'response_txt' => $response_txt));
			exit();
		}
	}
	
	
	public function sort_order()
	{
		if($this->input->is_ajax_request())
		{
		
			$table = $this->input->get_post('testimonialItems');
			
			
			
			if(!empty($table))
			{
				foreach($table as $pos => $item)
				{
					$mi=preg_replace("/row_/", "", $item);
					if(!empty($mi))
					{
						$this->testimonials_m->sort_order($pos, $mi);
					}
				}
				
				$this->testimonials_m->update_testimonials_meta_status($this->module->id, 'sort_status', 'pending');
				
			}
			echo 'Order has been set!';
		}
		exit();

	}
	
	public function publish_testimonials_order()
	{
		$success = 0;
		

		if($this->input->is_ajax_request())
		{
			if($this->testimonials_m->publish_testimonials_order($this->module->id))
			{
				$success = 1;
				$response_txt = 'The <strong>order</strong> has been published.';
			}
		}
		
		echo json_encode(array('success' => $success, 'response_txt' => $response_txt));
		exit();
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
					if($this->testimonials_m->remove($id))
					{
						$success = 1;
					}
				}
			}
			echo json_encode(array('success' => $success));
			exit();
		}
	}
} 