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
		//$sort_status = $this->team_m->sort_status($this->module->id);

		$data = array(
			'title' => 'TEAM',
			'css_global' => css_global($css_global, ADMIN_THEME) ,
			'css' => css($css, 'team') ,
			'js_global' => js_global($js_global, ADMIN_THEME) ,
			'js' => js($js, 'team') ,
			'message' => '' ,
			'team' => $this->team_m->get_all() ,
			//'sort_status' => $sort_status->status 
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
	        'manager_by_category.js'
        );
				
		$sort_status = $this->team_m->sort_status($this->module->id);
		
		$cid = $this->uri->segment(4);
		
		$team = $this->team_m->get_all_by_category($cid);
		
		
		if(empty($team))
		{
			redirect('/admin/team', 'refresh');
		}
		
		$category = $this->team_m->get_category($cid);
				
		$data = array(
			'title' => 'TEAM: '.$category->title,
			'css_global' => css_global($css_global, ADMIN_THEME) ,
			'css' => css($css, $this->module->uri) ,
			'js_global' => js_global($js_global, ADMIN_THEME) ,
			'js' => js($js, $this->module->uri) ,
			'message' => '' ,
			'team' => $team ,
			'category' => $category ,
			'sort_status' => $sort_status->status 
		);
		
		$data['partial']  = $this->load->view('admin/manager_by_category', $data, true);
			$this->load->view($this->admin_theme.'/templates/default', $data);
	}
	
	
	public function add()
	{
		$response = 0;
		
		if($this->input->is_ajax_request())
		{
			if($this->input->post('add') == 'add_member')
			{
				$first_name = ucfirst(strtolower($this->input->post('first_name'))) ;
				$last_name = ucfirst(strtolower($this->input->post('last_name'))) ;
				$middle_name = ucfirst(strtolower($this->input->post('middle_name'))) ;
				$fullname = $first_name.' '.$last_name ;
				
				$photo = $this->input->post('photo') ? $this->input->post('photo') : '' ;
				
				//$category = $this->input->post('cid') ? $this->input->post('cid') : 3;
				
				$uri = url_title($fullname, '-', TRUE);
				
				$data = array(
					'first_name' => $first_name ,
					'middle_name' => $middle_name,
					'last_name' => $last_name ,
					'fullname' => $fullname,
					'designation' => $this->input->post('designation') ,
					'title' => $this->input->post('title') ,
					'credentials' => $this->input->post('credentials') ,
					'uri' => $uri ,
					'bio' => $this->input->post('bio') ,
					//'cid' => $category ,
					'status' => 'pending' ,
					'photo' => $photo
				);
				
				
				if($id = $this->team_m->add($data))
				{
					//add to categories
					$categories = $this->input->post('categories') ? $this->input->post('categories') : array(3);
					
					$this->team_m->set_team_meta($id, $categories);
					
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
		
		$category_checkbox = $this->team_m->category_checkbox();
		
		$data = array(
			'title' => 'ADD TEAM MEMBER',
			'css_global' => css_global($css_global, ADMIN_THEME) ,
			'css' => css('add.css', $this->module->uri) ,
			'js_global' => js_global($js_global, ADMIN_THEME) ,
			'js' => js(array('add.js'), $this->module->uri) ,
			'category_checkbox' => $category_checkbox,
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
			
			if($this->input->post('update') == 'name_title')
			{
				$first_name = ucfirst(strtolower($this->input->post('first_name'))) ;
				$last_name = ucfirst(strtolower($this->input->post('last_name'))) ;
				$middle_name = ucfirst(strtolower($this->input->post('middle_name'))) ;
				
				$fullname = $middle_name ? $first_name.' '.$middle_name.' '.$last_name : $first_name.' '.$last_name ;
				
				$uri = url_title($fullname, '-', TRUE);
				
				$data = array(
					'first_name' => $this->input->post('first_name') , 
					'middle_name' => $this->input->post('middle_name') , 
					'last_name' => $this->input->post('last_name') , 
					'fullname' => $fullname , 
					'designation' => $this->input->post('description') ,
					'title' => $this->input->post('title') ,
					'credentials' => $this->input->post('credentials') ,
					'uri' => $uri ,
					'status' => 'pending'
				);
				
				if($this->team_m->update($id, $data))
				{
					$response = 1;
					$response_txt = 'The <strong>member info</strong> has been updated.';
				}
			}
			
			
			if($this->input->post('update') == 'bio')
			{
				$data = array(
					'bio' => $this->input->post('bio') ,
					'status' => 'pending'
				);
				
				if($this->team_m->update($id, $data))
				{
					$response = 1;
					$response_txt = 'The <strong>member bio</strong> has been updated.';
				}
			}
			
			
			if($this->input->post('update') == 'bio_alt')
			{
				$data = array(
					'bio_alt' => $this->input->post('bio_alt') ,
					'status' => 'pending'
				);
				
				if($this->team_m->update($id, $data))
				{
					$response = 1;
					$response_txt = 'The <strong>member\'s alternate bio</strong> has been updated.';
				}
			}
			
			
			if($this->input->post('update') == 'meta_info')
			{
				$data = array(
					'meta_description' => $this->input->post('meta_description') ,
					'meta_title' => $this->input->post('meta_title') ,
					'status' => 'pending'
				);
				
				if($this->team_m->update($id, $data))
				{
					$response = 1;
					$response_txt = 'The <strong>meta info</strong> have been updated.';
				}
			}
			
			
			if($this->input->post('update') == 'options')
			{
				$data = array(
					'status' => 'pending'
				);
				
				$categories = $this->input->post('categories') ? $this->input->post('categories') : array(3);
					$this->team_m->set_team_meta($id, $categories);
				
				if($this->team_m->update($id, $data))
				{
					$response = 1;
					$response_txt = 'The <strong>member options</strong> have been updated.';
				}
			}
			
			
			echo json_encode(array('response' => $response, 'response_txt' => $response_txt ));
			exit();
		}
		
		
		$data = $css_global = $css = $js_global = $js = array();
		$id = $this->uri->segment(4);
		
		$member = $this->team_m->get(array('id' => $id));
		if(empty($member))
		 {
			 redirect('/admin/team/index', 'refresh');
		 }		
		 
		$css_global = array();
		
		$js = array('edit.js');
		$js_global = array();

		$category_checkbox = $this->team_m->category_checkbox($id);
			
		$data = array(
			'title' => 'EDIT: '.$member->fullname,
			'css_global' => css_global($css_global, ADMIN_THEME) ,
			'css' => css('edit.css', $this->module->uri) ,
			'js_global' => js_global($js_global, ADMIN_THEME) ,
			'js' => js($js, $this->module->uri) ,
			'category_checkbox' => $category_checkbox ,
			'data' => $member ,
			'success' => '' 
		);
		
		//form_multiselect
		
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
					if($this->team_m->remove($id))
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
	
	
	public function categories()
	{
		$css_global = array();
		
		$css = array();

        $js_global = array();
        
        $js = array(
	        'category_manager.js'
        );
		
		$data = array(
			'title' => 'TEAM MANAGER',
			'css_global' => css_global($css_global, ADMIN_THEME) ,
			'css' => css($css, $this->module->uri) ,
			'js_global' => js_global($js_global, ADMIN_THEME) ,
			'js' => js($js, $this->module->uri) ,
			'message' => '' ,
			'categories' => $this->team_m->get_all_categories() ,
			'success' => '' 
		);
		
		$data['partial']  = $this->load->view('admin/category_manager', $data, true);
			$this->load->view($this->admin_theme.'/templates/default', $data);
	}
	
	
	public function add_category()
	{
		
		if($this->input->is_ajax_request())
		{
			$response = 0;
			
			if($this->input->post('add') == 'add_category')
			{
				
				$title = $this->input->post('title');
				$uri = $this->input->post('uri');
				$uri = url_title($uri, '-', TRUE);
				if(empty($uri))
				{
					$uri = url_title($title, '-', TRUE);
				}
				
				$data = array(
					'title' => $first_name ,
					'uri' => $middle_name,
					'last_name' => $last_name ,
					'created_ts' => date('Y-m-d H:i:s')
				);
				
				if($id = $this->team_m->add_category($data))
				{
					$response = 1;
				}
			}
			
			echo json_encode( array('response' => 1, 'id' => $id));
		}
		
		
		$data = array();
		$data = $css_global = $css = $js_global = $js = array();
		
		$css_global = array(
			'plugins/summernote/summernote.css'
		);
		
		$js_global = array(
			'plugins/summernote/summernote.min.js'
		);

		
		$data = array(
			'title' => 'ADD TEAM CATEGORY',
			'css_global' => css_global($css_global, ADMIN_THEME) ,
			'css' => css('add_category.css', $this->module->uri) ,
			'js_global' => js_global($js_global, ADMIN_THEME) ,
			'js' => js(array('add_category.js'), $this->module->uri) ,
		);
		
		$data['partial']  = $this->load->view('admin/add_category', $data, true);
			$this->load->view($this->admin_theme.'/templates/default', $data);
	}
	
	
	public function edit_category()
	{
		if($this->input->is_ajax_request())
		{
			$id = $this->input->post('id');
			
			$response = 0;
			$response_txt = 'Could not process request. Please try again or contact support.';
			
			if($this->input->post('update') == 'category_info')
			{
				$title = $this->input->post('title');
				$uri = $this->input->post('uri');
				$uri = url_title($uri, '-', TRUE);
				if(empty($uri))
				{
					$uri = url_title($title, '-', TRUE);
				}
				
				$data = array(
					'title' => $this->input->post('title') ,
					'uri' => $uri
				);
				
				if($this->team_m->update_category($id, $data))
				{
					$response = 1;
					$response_txt = 'The <strong>category</strong> has been updated.';
				}
			}
			
			echo json_encode(array('response' => $response, 'response_txt' => $response_txt ));
			exit();
		}
		
		
		$data = $css_global = $css = $js_global = $js = array();
		$id = $this->uri->segment(4);
		
		$category = $this->team_m->get_category($id);
		if(empty($category))
		 {
			 redirect('/admin/team/categories', 'refresh');
		 }		
		 
		$css_global = array(
			'plugins/summernote/summernote.css'
		);
		
		$js = array('edit_category.js');
		$js_global = array('plugins/summernote/summernote.min.js');

		
		$data = array(
			'title' => 'EDIT TEAM CATEGORY: '.$category->title,
			'css_global' => css_global($css_global, ADMIN_THEME) ,
			'css' => css('edit_category.css', $this->module->uri) ,
			'js_global' => js_global($js_global, ADMIN_THEME) ,
			'js' => js($js, $this->module->uri) ,
			'data' => $category ,
			'success' => '' 
		);
		
		$data['partial']  = $this->load->view('admin/edit_category', $data, true);
			$this->load->view($this->admin_theme.'/templates/default', $data);
	}
	
	
	public function remove_category()
	{
		if($this->input->is_ajax_request())
		{
			$success = 0;
			
			$id = $this->input->post('id');
			{
				if($id > 0)
				{
					if($this->team_m->remove_category($id))
					{
						$success = 1;
					}
				}
			}
			echo json_encode(array('success' => $success));
			exit();
		}
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
			$uploadDir  = $_SERVER['DOCUMENT_ROOT'].'/data/team/tmp/';
			$targetFile = $uploadDir . $filename;
			$savePath = $_SERVER['DOCUMENT_ROOT'] . '/data/team/' . $filename;
			
			if (in_array(strtolower($fileParts['extension']), $fileTypes))
			{
				if(move_uploaded_file($tempFile, $targetFile))
				{
					include('system/cms/libraries/Resize.php');
					$resizeObj = new resize($targetFile);
					$resizeObj -> resizeImage(400, 400, 'crop');
					$resizeObj -> saveImage($savePath, 100);
					
					$data = array(
						'photo' => $filename ,
						'status' => 'pending'
					);
					
					if($this->team_m->update($id, $data))
					{
						$response = 1;
						$response_txt = 'The <strong>photo</strong> has been updated.';
						$response_img = '<img class="img-responsive" src="/data/team/'.$filename.'" />';
					}
				
				}
			}
		}
		
		echo json_encode(array('response' => $response, 'response_txt' => $response_txt, 'response_img' => $response_img));
		exit();

	}
	
	public function add_photo()
	{
		
		$response = 0;

		$fileTypes = array('jpg', 'jpeg', 'gif', 'png');
		$fileParts = pathinfo($_FILES['Filedata']['name']);
		$filename = 'potrait-'.time().'.'.strtolower($fileParts['extension']);
		
		$tempFile   = $_FILES['Filedata']['tmp_name'];
		$uploadDir  = $_SERVER['DOCUMENT_ROOT'].'/data/team/tmp/';
		$targetFile = $uploadDir . $filename;
		$savePath = $_SERVER['DOCUMENT_ROOT'] . '/data/team/' . $filename;
		
		if (in_array(strtolower($fileParts['extension']), $fileTypes))
		{
			if(move_uploaded_file($tempFile, $targetFile))
			{
				include('system/cms/libraries/Resize.php');
				$resizeObj = new resize($targetFile);
				$resizeObj -> resizeImage(400, 400, 'crop');
				$resizeObj -> saveImage($savePath, 100);

					$response = 1;
					$response_txt = 'The <strong>photo</strong> has been updated.';
					$response_img = '<img class="img-responsive" src="/data/team/'.$filename.'" />';
			
			}
		}
		
		echo json_encode(array('response' => $response, 'response_txt' => $response_txt, 'response_img' => $response_img, 'response_filename' => $filename));
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
						'status' => 'live' ,
					);
						
					if($this->team_m->update($id, $data))
					{
						$success = 1;
						$response_txt = 'The <strong>team member</strong> has been published';
						
						$this->team_m->publish();
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
						
					if($this->team_m->update($id, $data))
					{
						$success = 1;
						$response_txt = 'The <strong>member pending status</strong> has been reset.';
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
		
			$table = $this->input->get_post('memberItems');
			
			
			
			if(!empty($table))
			{
				foreach($table as $pos => $item)
				{
					$mi=preg_replace("/row_/", "", $item);
					if(!empty($mi))
					{
						$this->team_m->sort_order($pos, $mi);
					}
				}
				
				$this->team_m->update_team_meta_status($this->module->id, 'sort_status', 'pending');
				
			}
			echo 'Order has been set!';
		}
		exit();

	}
	
	public function publish_team_order()
	{
		$success = 0;
		

		if($this->input->is_ajax_request())
		{
			if($this->team_m->publish_team_order($this->module->id))
			{
				$success = 1;
				$response_txt = 'The <strong>team order</strong> has been published.';
			}
		}
		
		echo json_encode(array('success' => $success, 'response_txt' => $response_txt));
		exit();
	}
	
	
	
}