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
		
		if($this->input->is_ajax_request())
		{
						
			$contact = array(
				'first_name' => $this->input->post('first_name') ? $this->input->post('first_name') : '',
				'last_name' => $this->input->post('last_name') ? $this->input->post('last_name') : '',
				'email' => $this->input->post('email') ? $this->input->post('email') : '',
				'telephone' => $this->input->post('telephone') ? $this->input->post('telephone') : '',
				'comments' => $this->input->post('comments') ? strip_tags($this->input->post('comments')) : '' ,
				'form_title' => $this->input->post('form_title') ? $this->input->post('form_title') : '' ,
				'location_url' => $this->input->post('location_url') ? $this->input->post('location_url') : '' 
			);
		
 			if($this->contact_m->send_mail($contact))
			{
				$ajax_message = '
				<div class="row">
					<div class="col-md-12">
						<h2>Message has been sent!</h2>
						<p>Thank you for taking the time to send us a message.<br />We will respond to your questions or comments very soon.</p>
						<p>Again, thank you, and we hope you have a great day!<br /><strong>'.SITE_NAME.'</strong></p>
					</div>
				</div>
				';
			}
				else
			{
				$ajax_message = "<h2>Mail not sent!</h2>";
			}
				
			echo json_encode(array('response' => 1, 'message' => $ajax_message, 'css' => ''));
			exit();
		}
		
		$array = array(
			'uri' => 'contact',
			'is_active' => 1
		);
		
		$data = $this->pages_m->get($array);
		
		$this->meta_info = array(
	        array('name' => 'description', 'content' => $data->meta_description ? $data->meta_description : $this->meta_description ),
	        array('name' => 'author', 'content' => SITE_TITLE)
	    );	
				
	    $this->meta_title = $data->meta_title ? $data->meta_title : $this->meta_title ;
		
		$title = $data->title ? $data->title : '';
		$canonical = '<link rel="canonical" href="'.base_url().'/contact" />';
		
		$this->ogimage = base_url().'/data/screenshots/screenshot.jpg' ;	
				
		$data = array(
			'title' => $data->display_title == 1 ? $data->title : $data->title ,
			'subtitle' => $data->display_title == 1 ? $data->subtitle : $data->subtitle ,
			'data' => $data,
			'header_title' => 'CONTACT US',
			'css' => css(array('contact.css'), $this->module->uri),
			'js' => js(array('contact.js'), $this->module->uri) ,
			'canonical' => $canonical
		);
		
		
		
		$data['partial']  = $this->load->view('public/contact', $data, true);
				$this->load->view($this->public_theme.'/templates/default', $data);
	}
	
	
	public function join_our_team()
	{
		
		if($this->input->is_ajax_request())
		{
						
			$contact = array(
				'first_name' => $this->input->post('first_name') ? $this->input->post('first_name') : '',
				'last_name' => $this->input->post('last_name') ? $this->input->post('last_name') : '',
				'email' => $this->input->post('email') ? $this->input->post('email') : '',
				'telephone' => $this->input->post('telephone') ? $this->input->post('telephone') : '',
				'comments' => $this->input->post('comments') ? strip_tags($this->input->post('comments')) : '',
				'form_title' => $this->input->post('form_title') ? $this->input->post('form_title') : '' ,
				'location_url' => $this->input->post('location_url') ? $this->input->post('location_url') : '' 
			);
		
 			if($this->contact_m->send_mail($contact))
			{
				$ajax_message = '
				<div class="row">
					<div class="col-md-12">
						<h2>Message has been sent!</h2>
						<p>Thank you for taking the time to send us a message.<br />We will respond to your questions or comments very soon.</p>
						<p>Again, thank you, and we hope you have a great day!<br /><strong>'.SITE_NAME.'</strong></p>
					</div>
				</div>
				';
			}
				else
			{
				$ajax_message = "<h2>Mail not sent!</h2>";
			}
				
			echo json_encode(array('response' => 1, 'message' => $ajax_message, 'css' => ''));
			exit();
		}
		
		$array = array(
			'uri' => 'contact',
			'is_active' => 1
		);
		
		$data = $this->pages_m->get($array);
		
		$this->meta_info = array(
	        array('name' => 'description', 'content' => $data->meta_description ? $data->meta_description : $this->meta_description ),
	        array('name' => 'author', 'content' => SITE_TITLE)
	    );	
				
	    $this->meta_title = $data->meta_title ? $data->meta_title : $this->meta_title ;
		
		$title = $data->title ? $data->title : '';
		$canonical = '<link rel="canonical" href="'.base_url().'/join-our-team" />';
				
		$data = array(
			'title' => $data->display_title == 1 ? $data->title : $data->title ,
			'subtitle' => $data->display_title == 1 ? $data->subtitle : $data->subtitle ,
			'data' => $data,
			'header_title' => 'CONTACT US',
			'css' => css(array('contact.css'), $this->module->uri),
			'js' => js(array('join_our_team.js'), $this->module->uri) ,
			'canonical' => $canonical
		);
		
		
		
		$data['partial']  = $this->load->view('public/join_our_team', $data, true);
				$this->load->view($this->public_theme.'/templates/default', $data);
	}


	
	
	public function quote()
	{
		
		if($this->input->is_ajax_request())
		{
						
			$contact = array(
				'first_name' => $this->input->post('first_name') ? $this->input->post('first_name') : '',
				'last_name' => $this->input->post('last_name') ? $this->input->post('last_name') : '',
				'email' => $this->input->post('email') ? $this->input->post('email') : '',
				'telephone' => $this->input->post('telephone') ? $this->input->post('telephone') : '',
				'comments' => $this->input->post('comments') ? strip_tags($this->input->post('comments')) : ''
			);
		
 			if($this->contact_m->send_mail($contact))
			{
				$ajax_message = '
				<div class="row">
					<div class="col-md-12">
						<h2>Message has been sent!</h2>
						<p>Thank you for taking the time to send us a message.<br />We will respond to your questions or comments very soon.</p>
						<p>Again, thank you, and we hope you have a great day!<br /><strong>'.SITE_NAME.'</strong></p>
					</div>
				</div>
				';
			}
				else
			{
				$ajax_message = "<h2>Mail not sent!</h2>";
			}
				
			echo json_encode(array('response' => 1, 'message' => $ajax_message, 'css' => ''));
			exit();
		}
		
		$array = array(
			'uri' => 'contact',
			'is_active' => 1
		);
		
		$data = $this->pages_m->get($array);
		
		$this->meta_info = array(
	        array('name' => 'description', 'content' => $data->meta_description ? $data->meta_description : $this->meta_description ),
	        array('name' => 'author', 'content' => SITE_TITLE)
	    );	
				
	    $this->meta_title = $data->meta_title ? $data->meta_title : $this->meta_title ;
		
		$title = $data->title ? $data->title : '';
		$canonical = '<link rel="canonical" href="https://www.precip.com/quote" />';
		$header_img = $data->header_img ? $data->header_img : 'DSC_5010.jpg' ;
				
		$data = array(
			'title' => $data->display_title == 1 ? $data->title : $data->title ,
			'subtitle' => $data->display_title == 1 ? $data->subtitle : $data->subtitle ,
			'data' => $data,
			'header_title' => 'CONTACT US',
			'css' => css(array('contact.css'), $this->module->uri),
			'js' => js(array('contact.js'), $this->module->uri) ,
			'header_img' => $header_img ,
			'map' => $this->map ,
			'canonical' => $canonical
		);
		
		
		
		$data['partial']  = $this->load->view('public/quote', $data, true);
				$this->load->view($this->public_theme.'/templates/default', $data);
	}
	
	
	public function request_consultation()
	{
		
		if($this->input->is_ajax_request())
		{
						
			$contact = array(
				'first_name' => $this->input->post('first_name') ? $this->input->post('first_name') : '',
				'last_name' => $this->input->post('last_name') ? $this->input->post('last_name') : '',
				'email' => $this->input->post('email') ? $this->input->post('email') : '',
				'telephone' => $this->input->post('telephone') ? $this->input->post('telephone') : '',
				'website' => $this->input->post('website') ? $this->input->post('website') : '',
				'industry' => $this->input->post('industry') ? $this->input->post('industry') : '',
				'comments' => $this->input->post('comments') ? strip_tags($this->input->post('comments')) : ''
			);
		
 			if($this->contact_m->request_consultation($contact))
			{
				$ajax_message = '
				<div class="row">
					<div class="col-md-12">
						<h2>Message has been sent!</h2>
						<p>Thank you for taking the time to send us a message.<br />We will respond to your questions or comments very soon.</p>
						<p>Again, thank you, and we hope you have a great day!<br /><strong>'.SITE_NAME.'</strong></p>
					</div>
				</div>
				';
			}
				else
			{
				$ajax_message = "<h2>Mail not sent!</h2>";
			}
				
			echo json_encode(array('response' => 1, 'message' => $ajax_message, 'css' => ''));
			exit();
		}
		
		$array = array(
			'uri' => 'request-consultation',
			'is_active' => 1
		);
		
		$data = $this->pages_m->get($array);
		
		$this->meta_info = array(
	        array('name' => 'description', 'content' => $data->meta_description ? $data->meta_description : $this->meta_description ),
	        array('name' => 'author', 'content' => SITE_TITLE)
	    );
	    
	    $this->load->library('googlemaps');
	    $center = NULL;
	    
	    $center = LATITUDE.', '.LONGITUDE;
		$google_map_type = GOOGLE_MAP_TYPE ? strtoupper(GOOGLE_MAP_TYPE) : 'ROADMAP';
			
	    $map_config = array(
			'apiKey' => 'AIzaSyDB2fQrd_2S1JkLOZDiIP73e3zez8LlQE0' ,
			'center' => $center ? $center : '34.244946, -77.866203', //Jacob's Field
			'directions' => TRUE ,
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
				'infowindow_content' => '<b>'.SITE_TITLE.'</b><br />'.DEFAULT_ADDRESS.'<br />'.DEFAULT_CITY.', '.DEFAULT_STATE.' '.DEFAULT_ZIPCODE.'<br /><b>Phone:</b> '.DEFAULT_TELEPHONE.'' ,
				'icon' => SITE_URL.'/data/site/map-marker-blue.png'
				
			);
		$this->googlemaps->add_marker($marker);			
			$map = $this->googlemaps->create_map();		
				
	    $this->meta_title = 'Request Consultation | Before You Start, Talk To Us' ;
		
		$title = $data->title ? $data->title : '';
		$canonical = '<link rel="canonical" href="https://www.precip.com/request-consultation" />';
		$data = array(
			'title' => 'Request Consultation' ,
			'subtitle' => 'Let\'s Chat' ,
			'data' => $data,
			'header_title' => 'CONTACT US',
			'css' => css(array('contact.css'), $this->module->uri),
			'js' => js(array('request_consultation.js'), $this->module->uri) ,
			'map' => $this->map ,
			'canonical' => $canonical
		);
		
		
		
		$data['partial']  = $this->load->view('public/request_consultation', $data, true);
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
				'apiKey' => GOOGLE_API_KEY ,
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