<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Whma extends Public_Controller {
	
	protected $_models = array();
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('Cpanel_Api');
		
	}	
	
	
	public function index()
	{				
		
		
		$repsonse = $this->whma_m->park('rasalovesss.com', 1);
		
		echo '<pre>';
			print_r($repsonse);
		echo '</pre>'; 
	}
}