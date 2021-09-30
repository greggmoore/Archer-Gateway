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

        $js_global = array();
        
        $js = array(
	        'manager.js'
        );
		
		$data = array(
			'title' => 'PAGE MANAGER',
			'css_global' => css_global($css_global, ADMIN_THEME) ,
			'css' => css($css, $this->module->uri) ,
			'js_global' => js_global($js_global, ADMIN_THEME) ,
			'js' => js($js, $this->module->uri) ,
			'message' => '' ,
			'pages' => $this->pages_m->get_all() ,
			'success' => '' 
		);
		
		$data['partial']  = $this->load->view('admin/manager', $data, true);
			$this->load->view($this->admin_theme.'/templates/default', $data);
	}
	
	
	
	
	public function add()
	{
		$response = 0;
		
		if($this->input->post('add') == 'add_page')
		{
			$title_uri = url_title($this->input->post('title'), '-', TRUE);
				$uri = $this->input->post('uri') ? $this->input->post('uri') : $title_uri;
			
			$seo = new phpSEO($this->input->post('section_1'));
				$meta_title = ($this->input->post('meta_title'))?$this->input->post('meta_title'):$this->input->post('title');
				$meta_description = ($this->input->post('meta_description'))?$this->input->post('meta_description'):$seo->getMetaDescription(160);//$seo->getMetaDescription(160)
				$meta_keywords = ($this->input->post('meta_keywords'))?$this->input->post('meta_keywords'):$seo->getKeyWords(10);//$seo->getKeyWords(10)
			
			$data = array(
				'title' => $this->input->post('title'),
				'uri' => $uri,
				'description' => $this->input->post('description'),
				'content' => $this->input->post('content'),
				'section1' => $this->input->post('section1'),
				'content' => $this->input->post('content'),
				'meta_title' => $meta_title,
				'meta_description' => $meta_description,
				'meta_keywords' => $meta_keywords,
				'is_active' => ($this->input->post('is_active')) ? 1 : 0 ,
				'display_title' => ($this->input->post('display_title')) ? 1 : 0,
				'is_restricted' => ($this->input->post('restricted')) ? 1 : 0 ,
				'created_ts' => date('Y-m-d H:i:s')			
			);
				
			if($id = $this->pages_m->add($data))
			{
				
				if($this->input->post('is_static') == 1)
				{
					$this->pages_m->create_staging_static($uri);
				}
				
				$response = 1;
				
				/**
					if (defined('ENVIRONMENT') == 'production')
				{
					$this->settings_m->ping('sitemap');
				}
				**/
			}
			
			echo json_encode(array('response' => $response, 'id' => $id ));
			exit();
					
		}
		
		$data = array();
		$data = $css_global = $css = $js_global = $js = array();
		
		$css_global = array();
		
		$js_global = array();
		
		$data = array(
			'title' => 'ADD PAGE',
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
			$response = 0;
			$reload = 0;
			$is_program = 0;
			$response_txt = 'Could not process request. Please try again or contact support.';			
			
			if($this->input->post('update') == 'content')
			{
				
				$id = $this->input->post('id');
				
			
				$o_uri = $this->input->post('original_uri');
				$n_uri = $this->input->post('uri');
				//$this->pages_m->check_and_rewrite_staging($o_uri, $n_uri);
				
				$uri = $n_uri ? $n_uri : $o_uri ;
				
				if(empty($uri))
				{
					$uri = url_title($this->input->post('title'), '-', TRUE);
				}

	
				$data = array(
					'content' => $this->input->post('content') ,
					'section1' => $this->input->post('section1') ,
					'section2' => $this->input->post('section2') ,
					'section3' => $this->input->post('section3') ,
					'section4' => $this->input->post('section4') ,
					'section5' => $this->input->post('section5') ,
					'left_card' => $this->input->post('left_card') ,
					'center_card' => $this->input->post('center_card') ,
					'right_card' => $this->input->post('right_card') ,
					'description' => $this->input->post('description') ,
					'title' => $this->input->post('title') 
				);
				
				if($this->pages_m->update($id, $data))
				{
					$response = 1;
					$response_txt = 'The <strong>content</strong> has been updated.';
				}
				
			}
			
			if($this->input->post('update') == 'meta_info')
			{
				$id = $this->input->post('id');
				$content = $this->pages_m->get(array('id' => $id));
				
				$seo = new phpSEO($content->content);
				
				$data = array(
					'meta_title' => $this->input->post('meta_title') ? $this->input->post('meta_title') : $section_1->title ,
					'meta_description' => ($this->input->post('meta_description')) ? $this->input->post('meta_description') : $seo->getMetaDescription(160) ,
					'meta_keywords' => ($this->input->post('meta_keywords'))?$this->input->post('meta_keywords'):$seo->getKeyWords(10) 
				);
				
				if($this->pages_m->update($id, $data))
				{
					$response = 1;
					$response_txt = 'The <strong>meta info</strong> has been updated.';
				}
			}
			
			if($this->input->post('update') == 'options')
			{
				$id = $this->input->post('id');
				
				$data = array(
					'is_active' =>  $this->input->post('is_active') ,
					'is_restricted' => $this->input->post('is_restricted') ,
					'display_title' =>  $this->input->post('display_title')
				);
				
				if($this->pages_m->update($id, $data))
				{
					$response = 1;
					$response_txt = 'The <strong>page options</strong> have been updated.';
				}
			}
			
			echo json_encode(array('response' => $response, 'response_txt' => $response_txt, 'reload' => $reload, 'is_program' => $is_program));
			exit();
		}
		
		$data = $css_global = $css = $js_global = $js = array();
		$id = $this->uri->segment(4);
		
		$page = $this->pages_m->get(array('id' => $id));
	
		if(empty($page))
		 {
			 redirect('/admin/'.$this->uri->segment(2).'/index', 'refresh');
		 }
	
		 
		$css_global = array();
		
		$js = array('edit.js');
		$js_global = array();
	
		$data = array(
			'title' => $page->title,
			'css_global' => css_global($css_global, ADMIN_THEME) ,
			'css' => css('edit.css', $this->module->uri) ,
			'js_global' => js_global($js_global, ADMIN_THEME) ,
			'js' => js($js, $this->module->uri) ,
			'message' => '' ,
			'data' => $page
		);

		$view = file_exists(APPPATH.'modules/pages/views/admin/'.$page->uri.'.php') ? $page->uri : 'edit' ;
			$data['partial']  = $this->load->view('admin/'.$view, $data, true);
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
					if($this->pages_m->remove($id))
					{
						$success = 1;
						$this->pages_m->publish();
					}
				}
			}
			echo json_encode(array('success' => $success));
			exit();
		}
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
				if($this->pages_m->check_uri($uri))
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
	
	
	public function publish()
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
						
					if($this->pages_m->update($id, $data))
					{
						if($id == 6)
						{
							$this->pages_m->update_quote($data);
							//$this->pages_m->publish('quotes');
						}
						
						$this->pages_m->update_faqs_status();
						$this->pages_m->publish('pages');
						
						$success = 1;
						$response_txt = 'The <strong>changes</strong> has been to the live page.';	
					}			
					
				}
			}
			echo json_encode(array('success' => $success, 'id' => $id));
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
						
					if($this->pages_m->update($id, $data))
					{
						$success = 1;
						$response_txt = 'The <strong>page status</strong> has been reset.';
					}
				}
			}
			echo json_encode(array('success' => $success, 'id' => $id, 'response_txt' => $response_txt));
			exit();
		}
	}
	
	
	public function add_faq()
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
				
				if($id = $this->pages_m->add_faq($data))
				{
					$this->pages_m->update($this->input->post('page_id'), array('status' => 'pending'));
					
					$response = 1;
				}
			}
			
			echo json_encode(array('response' => $response, 'id' => $id ));
			exit();
		}

	}
	
}