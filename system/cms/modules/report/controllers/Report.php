<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, seorets.com
 * @package \System\Application\
 * copyright Copyright (c) 2017, SEORETS.COM
 */

// ————————————————————————————————————

class Report extends Public_Controller {
	
	protected $_models = array(
		'report/report_m' ,
		'leads/leads_m'
	);
	
	public function __construct()
	{
		parent::__construct();
		
		$property = NULL;
		$formatted_address = NULL;
		
		$today = date('Y-m-d');
		
		//$this->load->vars($data);
		$this->load->model($this->_models);
		//$this->config->load('config');
	
	}
	
	public function index()
	{
		
		$post_data = $this->input->post();
		if(empty($post_data))
		{
			redirect('/', 'refresh');
		}
		$template = 'noreport' ;
		$report = '' ;
		
		$latitude = NULL;
		$longitude = NULL;
		$results = NULL ;
		$lid = NULL;
		
		$center = NULL;
	    
	    $center = LATITUDE.', '.LONGITUDE;
	    		
		if(!empty($post_data))
		{
			$address = $post_data['q'];
			//$user_email = $post_data['email'] ;
			
			$report = $this->report_m->get_report($post_data);
			
			$results = $report['results'];
			$lid = $report['lid'];

			if(!empty($report))
			{
				$template = 'report';
				
				$latitude = $results['latitude'];
				$longitude = $results['longitude'];
				
				$center = $latitude.', '.$longitude;
			}			
		}
		
		
		$array = array(
			'id' => 2,
			'is_active' => 1
		);
		
		$data = $this->pages_m->get($array);
		
		$this->load->library('googlemaps');
	    
		$google_map_type = GOOGLE_MAP_TYPE ? strtoupper(GOOGLE_MAP_TYPE) : 'ROADMAP';
			
	    $map_config = array(
			'apiKey' => 'AIzaSyBtNB4BID17_G8DxQrBrG66vX6KEsZdQMU' ,
			'sensor' => FALSE ,
			'https' => TRUE ,
			'center' => $center ? $center : '42.368812, -71.084455', //Jacob's Field
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
				'infowindow_content' => '<b>'.$results['street'].'</b><br />'.$results['city'].', '.$results['state'].' '.$results['zipcode'] ,
				'icon' => '/system/cms/modules/themes/default/assets/images/map-marker-red.png'
				
			);
		$this->googlemaps->add_marker($marker);			
			$map = $this->googlemaps->create_map();	
		
		
				
		$this->column_layout = $data->column_layout ? $data->column_layout : $this->column_layout ;
		
		$this->meta_info = array(
	        array('name' => 'description', 'content' => $data->meta_description ? $data->meta_description : $this->meta_description ),
	        array('name' => 'author', 'content' => 'MyRocketListing')
	    );
	    
	    $this->meta_title = $data->meta_title ? $data->meta_title : $this->meta_title ;
		
		$title = $data->title ? $data->title : '';
				
		$data = array(
			'title' => $data->display_title == 1 ? $data->title : $data->title ,
			'content' => $data->content,
			'css' => css(array('report.css'), $this->module->uri),
			'js' => js(array('report.js', 'bootstrapvalidator.js'), $this->module->uri) ,
			'results' => $results ? $results : '' ,
			//'user_email' => $user_email ,
			'lid' => $lid ? $lid : '' ,
			'map' => $map ,
			'address' => $address 
		);
		
		$data['partial']  = $this->load->view('public/'.$template, $data, true);
			$this->load->view($this->public_theme.'/templates/default', $data);
		
		
	}
	
	
	public function register()
	{
		if($this->input->is_ajax_request())
		{
			$success = 0;
			
			if($this->input->post('register'))
			{
				$data = $this->input->post();
				
				$id = $data['lid'];
				$first_name = isset($data['first_name']) ? trim(ucfirst(strtolower($this->input->post('first_name')))) : '' ;
				$last_name = isset($data['last_name']) ? trim(ucfirst(strtolower($this->input->post('last_name')))) : '' ;
				$phone = isset($data['phone']) ? $data['phone'] : '' ;
				$message = isset($data['message']) ? $data['message'] : '' ;
				$subject = isset($data['subject']) ? $data['subject'] : '' ;
				
				$array = array(
					'first_name' => $first_name ,
					'last_name' => $last_name ,
					'email' => $data['email'] ,
					'full_name' => $first_name.' '.$last_name ,
					'phone' => $phone ,
					'message' => $message ,
					'subject' => $subject ,
				);
				
				if($this->leads_m->update($id, $array))
				{
					//Assign lead
					$this->leads_m->assign_lead($id);
					
					$success = 1;
				}
			}
			
			echo json_encode(array('success' => $success, 'id' => $id ));
			exit();

		}
	}
	
	
	public function register_noproperty()
	{
		if($this->input->is_ajax_request())
		{
			$success = 0;
			
			if($this->input->post('register_noproperty'))
			{
				$data = $this->input->post();
				
				$id = $data['lid'];
				$first_name = isset($data['first_name']) ? trim(ucfirst(strtolower($this->input->post('first_name')))) : '' ;
				$last_name = isset($data['last_name']) ? trim(ucfirst(strtolower($this->input->post('last_name')))) : '' ;
				$phone = isset($data['phone']) ? $data['phone'] : '' ;
				$message = isset($data['message']) ? $data['message'] : '' ;
				$subject = isset($data['subject']) ? $data['subject'] : '' ;
				$address = isset($data['address']) ? $data['address'] : '' ;
				
				$array = array(
					'first_name' => $first_name ,
					'last_name' => $last_name ,
					'full_name' => $first_name.' '.$last_name ,
					'phone' => $phone ,
					'email' => $data['email'] ,
					'message' => $message ,
					'subject' => $subject ,
					'fulladdress' => $address ,
					'property_not_found' => 1
				);
				
				if($this->leads_m->update($id, $array))
				{
					//Assign lead
					$this->leads_m->property_not_found_lead($id);
					
					$success = 1;
				}
			}
			
			echo json_encode(array('success' => $success, 'id' => $id ));
			exit();

		}
	}
}