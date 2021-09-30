<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Public_Controller extends MY_Controller {
	
	function __construct()
	{
		parent::__construct();
				
		// Check the frontend hasnt been disabled by an admin
		if ( ! $this->settings->frontend_enabled && (empty($this->current_user) or !$this->ion_auth->is_admin() ))
		{
			header('Retry-After: 600');

			$error = $this->settings->unavailable_message ? $this->settings->unavailable_message : 'Sorry, the site is down. Be gone!';
			show_error($error, 503);
		}
		
		//Define template path
		$this->template_path = $this->settings->app_path.'modules/themes/'.$this->public_theme;
		
		// Define default logo 
		//Get module
        if ($this->modules_m->exists($this->module))
		{
			ci()->module = $this->module = $this->modules_m->get($this->module);
		}
		
		$this->open_graph = array();
		
		ci()->domain_string = $domain_string = explode('.', $_SERVER['HTTP_HOST'], 2); //creates the various parts
		$domain = $domain_string[1];
		$subdomain = $domain_string[0];

		
		//Set Meta Author
		$this->meta_author = $this->settings->default_author ? $this->settings->default_author : 'Admin';
		
		//Set default meta if individual modules has any, else revert to site default meta… pass it on!
		$this->meta_title = ($this->module->meta_title) ? $this->module->meta_title : $this->settings->default_meta_title;
		$this->meta_description = ($this->module->meta_description) ? $this->module->meta_description : $this->settings->default_meta_description;
    	
    	$this->meta_info = array(
    		array('name' => 'description', 'content' => $this->meta_description) ,
    			array('name' => 'author', 'content' => $this->meta_author)
    	);
    	
    	//Default Site URL
    	$this->site_url = ($this->settings->site_url) ? $this->settings->site_url : '';;
    	
    	//Site Verifications
    	$this->site_verifications = $this->settings_m->site_verifications();
    	
    	//Google Analytics
    	$this->ga_tracking = ($this->settings->ga_tracking_code) ? $this->settings->ga_tracking_code : '';
    		
				
		//Set layout style
    	$this->column_layout = ($this->settings->default_column_layout)?$this->settings->default_column_layout:'two_column_right';
    	
    	//Set current Page or URI
		$this->current_uri = $this->uri->segment(1, 'index');
			define('URI', $this->current_uri);
		
		
		$this->seg2 = $this->uri->segment(2, '');
			define('SEG2', $this->seg2);		
		
		//prepare page widgets
		$wmodule = $this->module->id ? $this->module->id : DEFAULT_MODULE_ID ;
			$this->widgets = $this->widgets_m->prepare_widgets($wmodule);
			
			//set widgets path
			ci()->widget_path = $this->widget_path = $this->settings->app_path.'widgets/';
		
		$this->is_home = $this->module->uri == 'home' ? TRUE : FALSE ;

		//$this->left_menu = $this->menus_m->prepare_menu(1, URI, $this->seg2, $this->is_home);
		//$this->right_menu = $this->menus_m->prepare_menu(2, URI, $this->seg2, $this->is_home);
		//$this->bottom_menu = $this->menus_m->prepare_menu(2, URI, $this->seg2, $this->is_home);
		
		$this->main_menu = $this->menus_m->prepare_menu(1, $this->current_uri);
		$this->footer_menu_our_company = $this->menus_m->footer_menu(2, $this->current_uri);
		$this->footer_menu_services = $this->menus_m->footer_menu(5, $this->current_uri);
		$this->footer_menu_products = $this->menus_m->footer_menu(6, $this->current_uri);
		
		$this->load->library('googlemaps');
	    $center = NULL;
	    
	    $center = LATITUDE.', '.LONGITUDE;
		$google_map_type = GOOGLE_MAP_TYPE ? strtoupper(GOOGLE_MAP_TYPE) : 'ROADMAP';
			
	    $map_config = array(
			'apiKey' => 'AIzaSyCk3SxMnnqg4hWwmeLqGHtsWW-8nwUNXLQ' ,
			'center' => $center ? $center : '34.244946, -77.866203', //Jacob's Field
			'https' => TRUE ,
			'map_height' => '390px',
			'map_name' => 'map',
			'map_div_id' => 'map_canvas',
			'map_type' => $google_map_type,
			'maxzoom' => 20,
			'minzoom' => 10,
			'tilt' => 0,
			'zoom' => 13 ,
			'scrollwheel' => FALSE ,
			'sensor' => FALSE ,
			'geocodeCaching' => TRUE ,
			'onload' => "google.maps.event.trigger(marker_0, 'click');" ,
			'styles' =>  array(
				  array("name"=>"Orange Parks", "definition"=>array(
				    array("featureType"=>"all", "stylers"=>array(array("saturation"=>"-30"))),
				    array("featureType"=>"poi.park", "stylers"=>array(array("saturation"=>"10"), array("hue"=>"#ff9900")))
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
		$marker = array();
			$marker = array(
				'position' => $center,
				'infowindow_content' => '<b>'.SITE_TITLE.'</b><br />'.DEFAULT_ADDRESS.'<br />'.DEFAULT_ADDRESS2.'<br />'.DEFAULT_CITY.', '.DEFAULT_STATE.'<br /><b>Phone:</b> '.DEFAULT_TOLL_FREE.'' ,
				//'icon' => base_url().'data/markers/map-marker-grey.png'
				'icon' => base_url().'data/markers/map-marker-red.png'
				
			);
			
		$this->googlemaps->add_marker($marker);			
			$this->map = $this->googlemaps->create_map();
			
		//Load main navigation
		/**
			$this->main_menu = $this->menus_m->prepare_menu(1, $this->current_uri);
		$this->sidenav = $this->menus_m->sidenav(2, $this->current_uri);
		$this->footer_menu = $this->menus_m->footer_menu('footer', $this->current_uri);
		
		$data = array(
			'main_menu' => $this->main_menu,
			'sidenav' => $this->sidenav,
			'footer_menu' => $this->footer_menu
		);

		$this->load->vars($data);
		**/
   
	}
}