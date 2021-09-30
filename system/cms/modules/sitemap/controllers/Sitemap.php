<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, findmoxie.com
 * @package \System\Application\
 * copyright Copyright (c) 2016, MOXIE.COM
 */

// ------------------------------------------------------------------------


class Sitemap extends Public_Controller {
	
	protected $_models = array(
		'sitemap_m'
	);
	
	public $author;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model($this->_models);	
		
	}
	
	public function index()
	{
		$array = array(
			'uri' => 'sitemap',
			'is_active' => 1
		);
		
		
		$data = $this->pages_m->get($array);
		
		$this->meta_info = array(
	        array('name' => 'description', 'content' => 'WCI Sitemap' ),
	        array('name' => 'author', 'content' => 'WCI')
	    );
	    
	    $js = array();
	    
	    $this->meta_title = 'Sitemap | WCI' ;		
		
		//$this->meta_title = $data->meta_title ? $data->meta_title : $this->meta_title ;
		
		$title = $data->title ? $data->title : '';
				
		$data = array(
			'title' => $data->display_title == 1 ? $data->title : $data->title ,
			'subtitle' => $data->display_title == 1 ? $data->subtitle : $data->subtitle ,
			'data' => $data,
			'header_title' => 'SITEMAP',
			'css' => css(array('sitemap.css'), $this->module->uri),
			'js' => js(array('sitemap.js'), $this->module->uri) ,
			//'map' => $map 
		);
				
			$data['partial']  = $this->load->view('public/sitemap', $data, true);
				$this->load->view($this->public_theme.'/templates/default', $data);
	}
	
	public function publications()
	{
		
		$data = NULL;
		
		$data['data'] = $this->sitemap_m->properties();
	
		header("Content-Type: text/xml;charset=iso-8859-1");
		$this->load->view('publications', $data);
		
	}
	
	public function pages()
	{
		
		$data = NULL;
		
		$data['data'] = $this->sitemap_m->properties();
	
		header("Content-Type: text/xml;charset=iso-8859-1");
		$this->load->view('pages', $data);
		
	}
	
	
	public function xml()
	{
		
		if(!file_exists('robots.txt'))
		{
			$robotfile = 'robots.txt';
			$fh = fopen($robotfile, 'w+') or die('Can\'t open file');
			$string = "User-agent:*\nSitemap: ".base_url()."sitemap.xml";
			fwrite($fh, $string);
			fclose($fh);
		}

				
		$data['data'] = $this->sitemap_m->prepare();
			
		header("Content-Type: text/xml;charset=iso-8859-1");
		$this->load->view('xml', $data);
	}
	
	
	public function rss()
	{
		$data = NULL;
		$data['data'] = $this->sitemap_m->rss();
		$this->load->view('rss', $data);
		
	}
}