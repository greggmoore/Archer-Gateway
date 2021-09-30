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
		$data = array();
		
		$css_global = array();
		
		$css = array();

        $js_global = array('plugins/tablednd/tablednd.js');
        
        $js = array(
	        'manager.js'
        );
		$sort_status = $this->quotes_m->sort_status($this->module->id);
		
		$data = array(
			'title' => 'QUOTES',
			'css_global' => css_global($css_global, ADMIN_THEME) ,
			'css' => css($css, $this->module->uri) ,
			'js_global' => js_global($js_global, ADMIN_THEME) ,
			'js' => js($js, $this->module->uri) ,
			'quotes' => $this->quotes_m->get_all() ,
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
			if($this->input->post('add') == 'add_quote')
			{
				
				$data = array(
					'quotee' => $this->input->post('quotee') ,
					'quote' => $this->input->post('quote') ,
					'is_active' => 1,
					'status' => 'pending'
				);
				
				if($id = $this->quotes_m->add($data))
				{
					$response = 1;
				}
			}
			
			echo json_encode( array('response' => 1, 'id' => $id));
			exit();
		}
		
		$data = array();
		$data = $css_global = $css = $js_global = $js = array();
		
		$css_global = array();
		
		$js_global = array();
		
		$data = array(
			'title' => 'ADD QUOTE',
			'css_global' => css_global($css_global, ADMIN_THEME) ,
			'css' => css('add.css', $this->module->uri) ,
			'js_global' => js_global($js_global, ADMIN_THEME) ,
			'js' => js(array('add.js'), $this->module->uri)
		);
		
		$data['partial']  = $this->load->view('admin/add', $data, true);
			$this->load->view($this->admin_theme.'/templates/default', $data);
	}
	
	public function edit()
	{
		
		if($this->input->is_ajax_request())
		{
			$id = $this->input->post('id');
			
			$response = 0;
			$response_txt = 'Could not process request. Please try again or contact support.';
			
			if($this->input->post('update') == 'quote_info')
			{
				
				$data = array(
					'quotee' => $this->input->post('quotee') , 
					'quote' => $this->input->post('quote') , 
					'status' => 'pending'
				);
				
				if($this->quotes_m->update($id, $data))
				{
					$response = 1;
					$response_txt = 'The <strong>quote</strong> has been updated.';
				}
			}			
			
			echo json_encode(array('response' => $response, 'response_txt' => $response_txt ));
			exit();
		}
		
		
		$data = $css_global = $css = $js_global = $js = array();
		$id = $this->uri->segment(4);
		
		$quote = $this->quotes_m->get(array('id' => $id));
		if(empty($quote))
		 {
			 redirect('/admin/quotes/index', 'refresh');
		 }		
		 
		$css_global = array(
			'plugins/summernote/summernote.css'
		);
		
		$js = array('edit.js');
		$js_global = array('plugins/summernote/summernote.min.js');
		
		$dd_params = 'class="form-control select2 col-md-3"';
		
		$data = array(
			'title' => 'EDIT QUOTE: '.$quote->quotee,
			'css_global' => css_global($css_global, ADMIN_THEME) ,
			'css' => css('edit.css', $this->module->uri) ,
			'js_global' => js_global($js_global, ADMIN_THEME) ,
			'js' => js($js, $this->module->uri) ,
			'data' => $quote
		);
		
		$data['partial']  = $this->load->view('admin/edit', $data, true);
			$this->load->view($this->admin_theme.'/templates/default', $data);
	}
	
	
	public function upload_photo()
	{
		
		$response = 0;

				
		$id = $this->input->post('id');
				
		if(!empty($id))
		{
			
			$fileTypes = array('jpg', 'jpeg', 'gif', 'png');
			$fileParts = pathinfo($_FILES['Filedata']['name']);
			$filename = time().'.'.strtolower($fileParts['extension']);
			
			$tempFile   = $_FILES['Filedata']['tmp_name'];
			$uploadDir  = $_SERVER['DOCUMENT_ROOT'].'/data/quotes/tmp/';
			$targetFile = $uploadDir . $filename;
			$savePath = $_SERVER['DOCUMENT_ROOT'] . '/data/quotes/' . $filename;
			
			if (in_array(strtolower($fileParts['extension']), $fileTypes))
			{
				if(move_uploaded_file($tempFile, $targetFile))
				{
					include('system/cms/libraries/Resize.php');
					$resizeObj = new resize($targetFile);
					$resizeObj -> resizeImage(204, 272, 'crop');
					$resizeObj -> saveImage($savePath, 100);
					
					$data = array(
						'photo' => $filename
					);
					
					if($this->quotes_m->update($id, $data))
					{
						$response = 1;
						$response_txt = 'The <strong>photo</strong> has been updated.';
						$response_img = '<img class="img-responsive" src="/data/quotes/'.$filename.'" />';
					}
				
				}
			}
		}
		
		echo json_encode(array('response' => $response, 'response_txt' => $response_txt, 'response_img' => $response_img));
		exit();

	}
	
	
	public function publish()
	{
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
						
					if($this->quotes_m->update($id, $data))
					{
						$success = 1;
						$response_txt = 'The <strong>quote</strong> has been published.';
						
						$this->quotes_m->publish();
					}					
					
				}
			}
			echo json_encode(array('success' => $success, 'id' => $id, 'response_txt' => $response_txt));
			exit();
		}
	}
	
	
	public function reset()
	{
		if($this->input->is_ajax_request())
		{
			$success = 0;
			
			$id = $this->input->post('id');
			{
				if($id > 0)
				{
					
					$data = array(
						'status' => 'live'
					);
						
					if($this->quotes_m->update($id, $data))
					{
						$success = 1;
						$response_txt = 'The <strong>quote status</strong> has been reset.';
					}
				}
			}
			echo json_encode(array('success' => $success, 'id' => $id, 'response_txt' => $response_txt));
			exit();
		}
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
					if($this->quotes_m->remove($id))
					{
						$success = 1;
					}
				}
			}
			echo json_encode(array('success' => $success));
			exit();
		}
	}
	
	
	public function sort_order()
	{
		$table = $this->input->get_post('quoteItems');
		
		if(!empty($table))
		{
			foreach($table as $pos => $item)
			{
				$mi=preg_replace("/row_/", "", $item);
				if(!empty($mi))
				{
					$this->quotes_m->sort_order($pos, $mi);
				}
			}
			
			$this->quotes_m->update_quotes_meta_status($this->module->id, 'sort_status', 'pending');
		}
		
		echo 'Order has been set!';
		exit();

	}
	
	public function publish_order()
	{
		$success = 0;

		if($this->input->is_ajax_request())
		{
			if($this->quotes_m->publish_order($this->module->id))
			{
				$success = 1;
				$response_txt = 'The <strong>quptes order</strong> has been published.';
			}
		}
		
		echo json_encode(array('success' => $success, 'response_txt' => $response_txt));
		exit();
	}

}