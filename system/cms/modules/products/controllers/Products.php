<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, findmoxie.com
 * @package \System\Application\
 * copyright Copyright (c) 2016, MOXIE.COM
 */

// ------------------------------------------------------------------------

class Products extends Public_Controller {

	
	public function __construct()
	{
		parent::__construct();
	
	}
	
	public function index()
	{
		
		$uri = $this->uri->segment(2);
		
		
		
		$uri = empty($uri) ? 'products' : $uri ;
		
		$array = array(
			'uri' => $uri,
			'is_active' => 1
		);
		
		
		$partial_uri = $uri == 'products' ? 'overview' : $uri;
		
		
		$data = $this->pages_m->get($array);
		
		$this->meta_info = array(
	        array('name' => 'description', 'content' => $data->meta_description ? $data->meta_description : $this->meta_description ),
	        array('name' => 'author', 'content' => SITE_TITLE)
	    );
	    
	    
	    $this->meta_title = $data->meta_title ? $data->meta_title : $this->meta_title ;
		
		$canonical = '';
		$title = $data->title ? $data->title : '';
		
		$breadcrumb_title = $data->uri == 'products' ? 'Overview' : $data->title;
		$breadcrumbs = $this->products_m->breadcrumbs($breadcrumb_title);
		
		$page_css = file_exists(APPPATH.'modules/services/assets/css/'.$uri.'.css') ? $uri.'.css' : '' ;
		$page_js = file_exists(APPPATH.'modules/services/assets/js/'.$uri.'.js') ? $uri.'.js' : '' ;
		$js = js(array($page_js), $this->module->uri) ;
		$canonical = '<link rel="canonical" href="https://www.precip.com/products/'.$uri.'" />';
		
		if($uri == 'products')
		{
			$canonical = '<link rel="canonical" href="https://www.precip.com/'.$uri.'" />';
		}
		
		$data = array(
			'title' => $data->display_title == 1 ? $data->title : $data->title ,
			'data' => $data,
			'css' => css(array($page_css,'products.css'), $this->module->uri),
			'js' => js(array('products.js'), $this->module->uri) ,
			'breadcrumbs' => $breadcrumbs  ,
			'partial_uri' => $partial_uri ,
			'canonical' => $canonical
		);
		
		$data['partial']  = $this->load->view('public/products', $data, true);
			$this->load->view($this->public_theme.'/templates/default', $data);
	}
}