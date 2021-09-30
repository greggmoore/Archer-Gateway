<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, findmoxie.com
 * @package \System\Application\
 * copyright Copyright (c) 2016, MOXIE.COM
 */

// ------------------------------------------------------------------------

class Contact extends Public_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('contact_m');
	
	}
	
	public function index()
	{
		$array = array(
			'uri' => 'contact',
			'is_active' => 1
		);
		
		$data = $this->pages_m->get($array);
		
		
		$this->meta_info = array(
	        array('name' => 'description', 'content' => $data->meta_description ? $data->meta_description : $this->meta_description ),
	        array('name' => 'author', 'content' => SITE_TITLE)
	    );
	    
	    $center = NULL;
	    
	    $center = LATITUDE.', '.LONGITUDE;
		$google_map_type = GOOGLE_MAP_TYPE ? strtoupper(GOOGLE_MAP_TYPE) : 'ROADMAP';
			
	    $map_config = array(
			'apiKey' => 'AIzaSyCO3p9YrnzYUcNkwo1ieTuoQSAPQ3S_ie4' ,
			'center' => $center ? $center : '34.244946, -77.866203', //Jacob's Field
			'map_height' => '390px',
			'map_name' => 'Map',
			'map_div_id' => 'map_canvas',
			'map_type' => $google_map_type,
			'maxzoom' => 20,
			'minzoom' => 10,
			'tilt' => 0,
			'zoom' => 15 ,
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
			'position' => $center,
			'infowindow_content' => '<b>'.SITE_TITLE.'</b><br />'.DEFAULT_ADDRESS.'<br />'.DEFAULT_CITY.', '.DEFAULT_STATE.' '.DEFAULT_ZIPCODE.'<br /><b>Phone:</b> '.DEFAULT_TELEPHONE.'' ,
			'icon' => SITE_URL.'/data/site/map-marker-blue.png'
		);
		
		
		$map = $this->contact_m->directions_map($map_config);
	
				
	    $this->meta_title = $data->meta_title ? $data->meta_title : $this->meta_title ;
		
		$title = $data->title ? $data->title : '';
				
		$data = array(
			'title' => $data->display_title == 1 ? $data->title : $data->title ,
			'section_1' => $data->section_1,
			'header_title' => 'CONTACT US',
			'css' => css(array('contact.css'), $this->module->uri),
			'js' => js(array('bootstrapValidator/bootstrapValidator.js','contact.js'), $this->module->uri) ,
			'map' => $map 
		);
		
		
		
		$data['partial']  = $this->load->view('public/contact', $data, true);
				$this->load->view($this->public_theme.'/templates/default', $data);
	}
	
	
	
	public function get_directions()
	{
		if($this->input->is_ajax_request())
		{
			$start_address = $this->input->post('startAddress');
			
			$this->load->library('googlemaps');
		    $center = NULL;
		    
		    $center = LATITUDE.', '.LONGITUDE;
			$google_map_type = GOOGLE_MAP_TYPE ? strtoupper(GOOGLE_MAP_TYPE) : 'ROADMAP';
				
		    $map_config = array(
				'apiKey' => 'AIzaSyCO3p9YrnzYUcNkwo1ieTuoQSAPQ3S_ie4' ,
				'center' => $center ? $center : '34.244946, -77.866203', //Jacob's Field
				'map_height' => '390px',
				'map_name' => 'Map',
				'map_div_id' => 'map_canvas',
				'map_type' => $google_map_type,
				'maxzoom' => 20,
				'minzoom' => 10,
				'tilt' => 0,
				'zoom' => 'auto' ,
				'directions' => TRUE ,
				'directionsStart' => $start_address ,
				'directionsEnd' => DEFAULT_FULL_ADDRESS,
				'directionsDivID' => 'directionsPanel' ,
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
				'stylesAsMapTypesDefault' => 'Black Roads'
			);
			
			$this->googlemaps->initialize($map_config);
			
			$map = $this->googlemaps->create_map();
			
			echo json_encode(array('response' => 1, 'map' => $map ));
		}
		
		exit();
	}
}