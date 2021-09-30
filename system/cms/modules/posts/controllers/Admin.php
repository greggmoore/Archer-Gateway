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

        $js_global = array();
        
        $js = array(
	        'manager.js'
        );
		
		$data = array(
			'title' => 'Posts (Blog)',
			'css_global' => css_global($css_global, ADMIN_THEME) ,
			'css' => css($css, $this->module->uri) ,
			'js_global' => js_global($js_global, ADMIN_THEME) ,
			'js' => js($js, $this->module->uri) ,
			'message' => '' ,
			'posts' => $this->posts_m->get_all() ,
			'success' => '' 
		);
		
		$data['partial']  = $this->load->view('admin/manager', $data, true);
			$this->load->view($this->admin_theme.'/templates/default', $data);
	}
	
	
	public function add()
	{
		
		if($this->input->is_ajax_request())
		{
			$response = 0;
			
			if($this->input->post('add') == 'add_post')
			{
				$uri = url_title($this->input->post('title'), '-', TRUE);
				
				//$seo = new phpSEO($this->input->post('content'));
					//$meta_title = ($this->input->post('meta_title'))?$this->input->post('meta_title'):$this->input->post('title');
					//$meta_description = ($this->input->post('meta_description'))?$this->input->post('meta_description'):$seo->getMetaDescription(160);//$seo->getMetaDescription(160)
					//$meta_keywords = ($this->input->post('meta_keywords'))?$this->input->post('meta_keywords'):$seo->getKeyWords(10);//$seo->getKeyWords(10)
								
				$publication_date = $this->input->post('publication_date') ? $this->input->post('publication_date') : date('m/d/Y') ;
					$publication_date = strtotime($publication_date);
						$publication_date = date('Y-m-d H:i:s', $publication_date);
				
				$data = array(
					'title' => $this->input->post('title'),
					'uri' => $uri,
					'content' => $this->input->post('content'),
					'author' => $this->input->post('author'),
					'is_active' => 1,
					'publication_date' => $publication_date,
					'created_ts' => date('Y-m-d H:i:s')
				);
				
				if($id = $this->posts_m->add($data))
				{
					$categories = $this->input->post('category');
					
					if(!empty($categories))
					{
						if(!$this->posts_m->set_categories($id, $categories))
						{
							$response = 0;
						}
					}
					
					$response = 1;
				
				}
				
				echo json_encode(array('response' => $response, 'id' => $id));
				exit();
			
			}
		}
		
		
		$data = array();
		$data = $css_global = $css = $js_global = $js = array();
		
		$css_global = array();
		
		$js_global = array();
		
		$categories = $this->posts_m->categories_array();
		$selected = array();
		$dd_params = 'class="form-control select2 m-b-10 select2-multiple" multiple="multiple" data-placeholder="Choose"';
		
		$catid = $this->uri->segment(4);
		$category = $this->posts_m->get_category($catid);
		
		
		$data = array(
			'title' => 'Add Post' ,
			'css_global' => css_global($css_global, ADMIN_THEME) ,
			'css' => css('add.css', $this->module->uri) ,
			'js_global' => js_global($js_global, ADMIN_THEME) ,
			'js' => js(array('add.js'), $this->module->uri) ,
			//'category' => $category ? $category : '' ,
			'categories' => form_multiselect('category[]', $categories, $selected, $dd_params),
		);

		
		$data['partial']  = $this->load->view('admin/add', $data, true);
			$this->load->view($this->admin_theme.'/templates/default', $data);
	}
	
	public function edit()
	{
		
		if($this->input->is_ajax_request())
		{
			$id = $this->input->post('id');
			
			if($this->input->post('update') == 'content')
			{
				$title_uri = url_title($this->input->post('title'), '-', TRUE);
				$uri = $this->input->post('uri') ? $this->input->post('uri') : $title_uri;
				$link = $this->input->post('link') ? $this->input->post('link') : '' ;
				$is_external = $link ? 1 : 0 ;
				
				$publication_date = $this->input->post('publication_date') ? $this->input->post('publication_date') : date('m/d/Y') ;
					$publication_date = strtotime($publication_date);
						$publication_date = date('Y-m-d H:i:s', $publication_date);
				
				$data = array(
					//'release_date' => $this->input->post('release_date') ,
					'title' => $this->input->post('title') ,
					'author' => $this->input->post('author') ,
					'link' => $this->input->post('link') ,
					'resource' => $this->input->post('resource') ,
					'is_external' => $is_external ,
					'content' => $this->input->post('content') ,
					'uri' => $uri ,
					'status' => 'pending' ,
					'publication_date' => $publication_date,
					'is_active' => 1,
					
				);
				
				if($this->posts_m->update($id, $data))
				{
					$response = 1;
					$response_txt = 'The <strong>post</strong> has been updated.';
				}
			}
			
			if($this->input->post('update') == 'meta_info')
			{
				$content = $this->posts_m->get(array('id' => $id));
					$seo = new phpSEO($content->content);
		
				$data = array(
					'meta_title' => $this->input->post('meta_title') ? $this->input->post('meta_title') : $content->title ,
					'meta_description' => ($this->input->post('meta_description'))?$this->input->post('meta_description'):$seo->getMetaDescription(160) ,
					'meta_keywords' => ($this->input->post('meta_keywords'))?$this->input->post('meta_keywords'):$seo->getKeyWords(10)
				);
				
				if($this->posts_m->update($id, $data))
				{
					$response = 1;
					$response_txt = 'The <strong>meta info</strong> has been updated.';
				}
			}
			
			if($this->input->post('update') == 'options')
			{
				$categories = $this->input->post('category');
				if(!empty($categories))
				{
					$this->posts_m->set_categories($id, $categories) ;
				}
				
				//$post_state_date = $this->input->post('start_date') ? $this->input->post('start_date') : '';
					//$start_date = $this->input->post('start_date') ? date('Y-m-d', strtotime($post_state_date)) : $this->input->post('created_ts') ;
				
				$data = array(
					'is_active' => 1,
					'registration_required' => ($this->input->post('registration_required')) ? 1 : 0 ,
				);
				
				if($this->posts_m->update($id, $data))
				{
					$response = 1;
					$response_txt = 'The <strong>options</strong> have been updated.';
				}
			}
			
			echo json_encode(array('response' => $response, 'response_txt' => $response_txt ));
			exit();
		}
		
		$data = $css_global = $css = $js_global = $js = array();
		$id = $this->uri->segment(4);
		$partial = 'edit';
		
		$post = $this->posts_m->get(array('id' => $id));

		$css_global = array(
			'plugins/summernote/summernote.css'
		);
		
		$js = array('edit.js');
		$js_global = array('plugins/summernote/summernote.min.js');
		
		
		$categories = $this->posts_m->categories_array();
		$selected = $this->posts_m->selected_categories($id);
		$dd_params = 'class="form-control select2 m-b-10 select2-multiple" multiple="multiple" data-placeholder="Choose"';
		
		
		$data = array(
			'title' => 'Edit Post',
			'categories' => form_multiselect('category[]', $categories, $selected, $dd_params),
			'css_global' => css_global($css_global, ADMIN_THEME) ,
			'css' => css('edit.css', $this->module->uri) ,
			'js_global' => js_global($js_global, ADMIN_THEME) ,
			'js' => js($js, $this->module->uri) ,
			'message' => '' ,
			'data' => $post ,
			'success' => '' 
		);
		
		
		$data['partial']  = $this->load->view('admin/edit', $data, true);
			$this->load->view($this->admin_theme.'/templates/default', $data);
	}
	
	
	
	public function category()
	{
		$css_global = array();
		
		$css = array(
			'manager.css'
		);

        $js_global = array('plugins/tablednd/tablednd.js');
        
        $js = array(
	        'manager.js'
        );
				
		//$sort_status = $this->posts_m->sort_status($this->module->id);
		
		$cid = $this->uri->segment(4);
		
		$posts = $this->posts_m->get_all_by_category($cid);
		
		if(empty($posts))
		{
			//redirect('/admin/posts', 'refresh');
		}
				
		$category = $this->posts_m->get_category($cid);

		
		$data = array(
			'title' => 'NEWS: '.$category->title,
			'css_global' => css_global($css_global, ADMIN_THEME) ,
			'css' => css($css, $this->module->uri) ,
			'js_global' => js_global($js_global, ADMIN_THEME) ,
			'js' => js($js, $this->module->uri) ,
			'message' => '' ,
			'posts' => $posts ,
			'category' => $category 		
		);
		
		$data['partial']  = $this->load->view('admin/manager', $data, true);
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
					if($this->posts_m->remove($id))
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
				if($this->posts_m->check_uri($uri))
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
					
					$success = 1;
					$data = array(
						'status' => 'live'
					);
						
					if($this->posts_m->update($id, $data))
					{
						$success = 1;
						$response_txt = 'The <strong>changes</strong> has been to the live areas of research program.';
						
						$this->posts_m->publish();
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
						
					if($this->posts_m->update($id, $data))
					{
						$success = 1;
						$response_txt = 'The <strong>news callout status</strong> has been reset.';
					}
				}
			}
			echo json_encode(array('success' => $success, 'id' => $id, 'response_txt' => $response_txt));
			exit();
		}
	}
	
	public function publication_date()
	{
		$time = strtotime('10/16/2003');
		
		echo date('Y-m-d H:i:s', $time);
		
		//$this->posts_m->publication_date();
	}
}