<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, findmoxie.com
 * @package \System\Application\
 * copyright Copyright (c) 2016, MOXIE.COM
 */

// ------------------------------------------------------------------------

class Careers extends Public_Controller {

	
	public function __construct()
	{
		parent::__construct();
	
	}
	
	public function index()
	{
		
		if($this->input->is_ajax_request())
		{
						
			$careers = array(
				'first_name' => $this->input->post('first_name') ? $this->input->post('first_name') : '',
				'last_name' => $this->input->post('last_name') ? $this->input->post('last_name') : '',
				'email' => $this->input->post('email') ? $this->input->post('email') : '',
				'telephone' => $this->input->post('telephone') ? $this->input->post('telephone') : '',
				'website' => $this->input->post('website') ? $this->input->post('website') : '',
				'facebook' => $this->input->post('facebook') ? $this->input->post('facebook') : '',
				'skills_software' => $this->input->post('skills_software') ? $this->input->post('skills_software') : '',
				'project_experience' => $this->input->post('project_experience') ? $this->input->post('project_experience') : '',
				'self_description' => $this->input->post('self_description') ? $this->input->post('self_description') : '',
				'resume_url' => $this->input->post('response_filename') ? $this->input->post('response_filename') : ''
			);
		
 			if($this->careers_m->send_mail($careers))
			{
				$ajax_message = '
				<div class="row">
					<div class="col-md-6">
						<h2>Message has been sent!</h2>
						<p>Thank you for taking the time to send us a message.<br />We will respond to your questions or comments very soon.</p>
						<p>Again, thank you, and we hope you have a day!<br /><strong>WCI</strong></p>
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
			'uri' => 'careers',
			'is_active' => 1
		);
		
		$data = $this->pages_m->get($array);
		
		$this->meta_info = array(
	        array('name' => 'description', 'content' => $data->meta_description ? $data->meta_description : $this->meta_description ),
	        array('name' => 'author', 'content' => SITE_TITLE)
	    );
	  	
				
	    $this->meta_title = $data->meta_title ? $data->meta_title : $this->meta_title ;
		
		$title = $data->title ? $data->title : '';
		$canonical = '<link rel="canonical" href="https://www.precip.com/careers" />';
		$breadcrumbs = $this->pages_m->breadcrumbs($data->title);
		$seo = new phpSEO($data->section1);
		
		$meta_description = $data->meta_description ? $data->meta_description : $seo->getMetaDescription(160);
		
		$this->meta_info = array(
	        array('name' => 'description', 'content' => $data->meta_description ? $data->meta_description : $meta_description ),
	        array('name' => 'author', 'content' => 'WCI')
	    );
	    		
		$data = array(
			'title' => $data->display_title == 1 ? $data->title : $data->title ,
			'pretitle' => $data->pretitle == 1 ? $data->pretitle : $data->pretitle ,
			'subtitle' => $data->subtitle == 1 ? $data->subtitle : $data->subtitle ,
			'data' => $data,
			'header_title' => 'CAREERS',
			'css' => css(array('uploadifive/uploadifive.css', 'careers.css'), $this->module->uri),
			'js' => js(array('uploadifive/jquery.uploadifive.js','careers.js'), $this->module->uri) ,
			'map' => $this->map ,
			'breadcrumbs' => $breadcrumbs ,
			'canonical' => $canonical
		);
		
		
		
		$data['partial']  = $this->load->view('public/careers', $data, true);
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
	
	
	public function upload_resume()
	{
		
		$response = 0;

				
		$id = $this->input->post('id');
				
		if(!empty($id))
		{
			
			$fileTypes = array('pdf', 'doc');
			$fileParts = pathinfo($_FILES['Filedata']['name']);
			
			$filename = url_title($fileParts['filename'], 'underscore', TRUE).'_'.time().'.'.strtolower($fileParts['extension']);
			
			//$filename = $uri.'-'.time().'.'.strtolower($fileParts['extension']);
			
			$tempFile   = $_FILES['Filedata']['tmp_name'];
			$uploadDir  = $_SERVER['DOCUMENT_ROOT'].'/data/documents/';
			$targetFile = $uploadDir . $filename;
			$savePath = $_SERVER['DOCUMENT_ROOT'] . '/data/documents/' . $filename;
			
			if (in_array(strtolower($fileParts['extension']), $fileTypes))
			{
				if(move_uploaded_file($tempFile, $targetFile))
				{
					$data = array(
						'resume' => $filename
					);
					
						$response = 1;
						$response_txt = 'Your <strong>resume</strong> has been uploaded.';
						//$response_attachment = '<a href="/data/documents/'.$filename.'"><i class="fa fa-file-pdf-o"></i> '.$filename.'</a>';
				
				}
			}
		}
		
		echo json_encode(array('response' => $response, 'response_txt' => $response_txt, 'response_filename' => $filename));
		exit();

	}
	
}