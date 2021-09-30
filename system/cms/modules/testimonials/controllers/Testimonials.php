<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore BluMoo Creative
 * @package System\Cms\Modules\Changeme\Controllers
 * copyright Copyright (c) 2017, BluMoo Creative, LLC
 */

class Testimonials extends Public_Controller {

	public function __construct()
	{
		parent::__construct();
	
	}
	
	public function index()
	{
		$array = array(
			'uri' => 'testimonials',
			'is_active' => 1
		);
		
		
		$data = $this->pages_m->get($array);
						
		$this->meta_info = array(
	        array('name' => 'description', 'content' => $data->meta_description ? $data->meta_description : $this->meta_description ),
	        array('name' => 'author', 'content' => 'Rasa Love')
	    );
	    
	    $this->meta_title = $data->meta_title ? $data->meta_title : $this->meta_title ;
				$subheader = $data->subheader ? $data->subheader : 'carolina-beach-sun-rise.jpg' ;

		$title = $data->title ? $data->title : '';
				
		$data = array(
			'title' => $data->display_title == 1 ? $data->title : $data->title ,
			'css' => css(array('testimonials.css'), $this->module->uri),
			'js' => js(array('testimonials.js'), $this->module->uri) ,
			'subheader' => $subheader
		);
		
		$data['partial']  = $this->load->view('public/testimonials', $data, true);
			$this->load->view($this->public_theme.'/templates/default', $data);
	}
}