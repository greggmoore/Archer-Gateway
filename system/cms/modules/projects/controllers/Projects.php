<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, findmoxie.com
 * @package \System\Application\
 * copyright Copyright (c) 2016, MOXIE.COM
 */

// ------------------------------------------------------------------------

class Projects extends Public_Controller {

	
	public function __construct()
	{
		parent::__construct();
	
	}
	
	public function index()
	{
		$uri = 'projects';
		
		$array = array(
			'uri' => $uri,
			'is_active' => 1
		);

		$data = $this->pages_m->get($array);
		if(empty($data))
		{
			redirect('/', 'refresh');
		}
		
		$this->meta_info = array(
	        array('name' => 'description', 'content' => $data->meta_description ? $data->meta_description : $this->meta_description ),
	        array('name' => 'author', 'content' => 'BluMoo Creative')
	    );
	    
	    $this->meta_title = $data->meta_title ? $data->meta_title : $this->meta_title ;
		
		$title = $data->title ? $data->title : '';
		
		
		$page_css = file_exists(APPPATH.'modules/'.$uri.'/assets/css/'.$uri.'.css') ? $uri.'.css' : '' ;
		$page_js = file_exists(APPPATH.'modules/'.$uri.'/assets/js/'.$uri.'.js') ? $uri.'.js' : '' ;
		$js = js(array($page_js), $this->module->uri) ;
		
		$header_img = $data->header_img ? $data->header_img : 'DSC_5010.jpg' ;
		
		$projects = $this->projects_m->projects();
		
		$data = array(
			'title' => $data->display_title == 1 ? $data->title : $data->title ,
			'pretitle' => $data->display_title == 1 ? $data->pretitle : $data->pretitle ,
			'subtitle' => $data->display_title == 1 ? $data->subtitle : $data->subtitle ,
			'data' => $data,
			'css' => css(array($page_css), $this->module->uri),
			'js' => $js ,
			//'map' => $map ,
			'header_img' => $header_img ,
			'projects' => $projects,
			'onload' => 'class="preloaded"' ,
		);
		
		$data['partial']  = $this->load->view('public/projects', $data, true);
			$this->load->view($this->public_theme.'/templates/default', $data);
			
	}
	
	
	public function project()
	{
		$uri = 'projects';
		$project_uri = $this->uri->segment(2);
		
		$project = $this->projects_m->get($project_uri);
		$gallery = $this->projects_m->get_gallery($project->id);
		
		if(empty($project))
		{
			redirect('/', 'refresh');
		}
		
		$array = array(
			'uri' => 'projects',
			'is_active' => 1
		);

		$data = $this->pages_m->get($array);
		
		$this->meta_info = array(
	        array('name' => 'description', 'content' => $data->meta_description ? $data->meta_description : $this->meta_description ),
	        array('name' => 'author', 'content' => 'BluMoo Creative')
	    );
	    
	    $this->meta_title = $data->meta_title ? $data->meta_title : $this->meta_title ;
		
		$title = $data->title ? $data->title : '';
		
		
		$page_css = file_exists(APPPATH.'modules/'.$uri.'/assets/css/'.$uri.'.css') ? $uri.'.css' : '' ;
		$page_js = file_exists(APPPATH.'modules/'.$uri.'/assets/js/'.$uri.'.js') ? $uri.'.js' : '' ;
		$js = js(array($page_js), $this->module->uri) ;
		
		$header_img = $data->header_img ? $data->header_img : 'DSC_5010.jpg' ;
		
		
		
		$data = array(
			'title' => $data->display_title == 1 ? $data->title : $data->title ,
			'pretitle' => $data->display_title == 1 ? $data->pretitle : $data->pretitle ,
			'subtitle' => $data->display_title == 1 ? $data->subtitle : $data->subtitle ,
			'data' => $data,
			'css' => css(array($page_css), $this->module->uri),
			'js' => $js ,
			//'map' => $map ,
			'header_img' => $header_img ,
			'project' => $project,
			'gallery' => $gallery,
			'onload' => 'class="preloaded"' ,
		);
		
		$data['partial']  = $this->load->view('public/project', $data, true);
				$this->load->view($this->public_theme.'/templates/default', $data);
	}
	
	public function delete_img()
	{
		$this->projects_m->delete_img('IMG_2341.jpg');	
	}
}