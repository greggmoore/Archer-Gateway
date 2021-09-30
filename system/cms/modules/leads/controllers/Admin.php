<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, seorets.com
 * @package \System\Application\Servers
 * copyright Copyright (c) 2017, SEORETS.COM
 */

// ------------------------------------------------------------------------

class Admin extends Admin_Controller {

	protected $_models = array(
		'leads/leads_m'
	);
	 
	public function __construct()
	{
		parent::__construct();
		$this->load->model($this->_models);
	
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
			'title' => 'LEADS MANAGER',
			'css_global' => css_global($css_global, ADMIN_THEME) ,
			'css' => css($css, $this->module->uri) ,
			'js_global' => js_global($js_global, ADMIN_THEME) ,
			'js' => js($js, $this->module->uri) ,
			'message' => '' ,
			'leads' => $this->leads_m->get_all() ,
			'success' => '' 
		);
		
		$data['partial']  = $this->load->view('admin/manager', $data, true);
			$this->load->view($this->admin_theme.'/templates/default', $data);
	}
	
	

	
	public function details()
	{
		
		
		$data = $css_global = $css = $js_global = $js = $map = array();
		$id = $this->uri->segment(4);
		
		$lead = $this->leads_m->get($id);
		$details = $this->leads_m->lead_details($id);
				
		if(empty($lead))
		 {
			 redirect('/admin/leads/index', 'refresh');
		 }		
		 
		$css_global = array(
			'plugins/summernote/summernote.css'
		);
		
		$js = array('details.js');
		$js_global = array('plugins/summernote/summernote.min.js');
		
		
	    
	    if(!empty($lead->latitude) && !empty($lead->longitude))
	    {
		    $this->load->library('googlemaps');
		    $center = $lead->latitude.', '.$lead->longitude;
		    
		    $google_map_type = GOOGLE_MAP_TYPE ? strtoupper(GOOGLE_MAP_TYPE) : 'ROADMAP';
			
		    $map_config = array(
				'apiKey' => 'AIzaSyBtNB4BID17_G8DxQrBrG66vX6KEsZdQMU' ,
				'center' => $center ? $center : '34.244946, -77.866203', //Jacob's Field
				'directions' => FALSE ,
				'directionsDivID' => 'directionsPanel' ,
				'directionsStart' => 'document.getElementById("start_address").value;' ,
				'directionsEnd' => DEFAULT_FULL_ADDRESS ,
				'directionsStartIsDynamic' => TRUE ,
				'map_height' => '390px',
				'map_name' => 'Map',
				'map_div_id' => 'map_canvas',
				'map_type' => $google_map_type,
				'tilt' => 0,
				'scrollwheel' => FALSE ,
				'geocodeCaching' => TRUE ,
				'onload' => "google.maps.event.trigger(marker_0, 'click');" ,
				'styles' =>  array(
					  array("name"=>"Blue Parks", "definition"=>array(
					    array("featureType"=>"all", "stylers"=>array(array("saturation"=>"-70"))),
					    array("featureType"=>"poi.park", "stylers"=>array(array("saturation"=>"30"), array("hue"=>"#076791")))
					  )),
					  array("name"=>"Black Roads", "definition"=>array(
					    array("featureType"=>"all", "stylers"=>array(array("saturation"=>"-70"))),
					    array("featureType"=>"road.arterial", "elementType"=>"geometry", "stylers"=>array(array("hue"=>"#000000")))
					  ))
					) ,
				'stylesAsMapTypes' => TRUE ,
				'stylesAsMapTypesDefault' => 'Black Roads' ,
				'zoom' => 15
			);
			
			$this->googlemaps->initialize($map_config);
			$marker = array();
			$marker = array(
				'position' => $center,
				'infowindow_content' => '<b>'.$lead->street.'</b><br />'.$lead->city.', '.$lead->state.' '.$lead->zipcode.'' ,
				'icon' => SITE_URL.'/data/site/map-marker-red.png'
				
			);		    
	    }
	    
		
		$this->googlemaps->add_marker($marker);			
			$map = $this->googlemaps->create_map();	
		
		$data = array(
			'title' => 'LEAD: '.$lead->street,
			'css_global' => css_global($css_global, ADMIN_THEME) ,
			'css' => css('details.css', $this->module->uri) ,
			'js_global' => js_global($js_global, ADMIN_THEME) ,
			'js' => js($js, $this->module->uri) ,
			'data' => $lead ,
			'details' => $details ,
			'map' => $map 
		);
		
		$data['partial']  = $this->load->view('admin/details', $data, true);
			$this->load->view($this->admin_theme.'/templates/default', $data);
	}
}