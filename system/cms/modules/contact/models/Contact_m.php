<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, findmoxie.com
 * @package \System\Application\
 * copyright Copyright (c) 2016, MOXIE.COM
 */

// ------------------------------------------------------------------------

class Contact_m extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		
	}
	
	
	public function send_mail($array)
	{
		
		$data = array(
			'first_name' => $array['first_name'] ? ucwords(strtolower($array['first_name'])) : 'n/a',
			'last_name' => $array['last_name'] ? ucwords(strtolower($array['last_name'])) : 'n/a' ,
			'fullname' => ucwords(strtolower($array['first_name'])).' '.ucwords(strtolower($array['last_name'])),
			'email' => $array['email'] ? $array['email'] : 'n/a' ,
			//'address' => '' ,
			//'city' => '' ,
			//'state' => '' ,
			//'zipcode' => '',
			'telephone' => $array['telephone'] ? $array['telephone'] : 'n/a' ,
			'comments' => $array['comments'] ? $array['comments'] : 'n/a' ,
			'form_name' => $array['form_title'] ? $array['form_title'] : 'n/a' ,
			'location_url' => $array['location_url'] ? $array['location_url'] : 'n/a' 
		);
		
		
		$config['protocol'] = 'smtp';
		$config['smtp_host'] ='smtp.sendgrid.net';
		$config['smtp_port'] = 587;
		$config['smtp_user'] = 'apikey';
		$config['smtp_pass'] = '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';
		$config['validate'] = TRUE;
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';
		$config['newline'] = "\r\n";
		$config['crlf'] = "\r\n";
		$config['smtp_timeout'] = '30';
		$config['priority']= 1;

		
		$this->email->initialize($config);
		
		$this->email->from('info@bluechiptransact.com', 'BCTS');
		$this->email->to('gregg@blumoocreative.com'); 
		//$this->email->bcc('gregg@blumoocreative.com'); 
		$this->email->subject('BCTS '.$data['form_name']);
		$message = $this->load->view('email/html', $data, true );
		
		$this->email->message($message);
		if($this->email->send())
		{
			
			if(STORE_CONTACT_DATA == 1)
			{
				//$this->db->replace($this->_contact_meta, $data);
				
			}

			return TRUE;
		}
		
		//$this->db->replace($this->_contact_meta, $data);
		
		return FALSE;
			
			
	}
	
	
	public function request_consultation($array)
	{
		
		$data = array(
			'first_name' => $array['first_name'] ? ucwords(strtolower($array['first_name'])) : 'n/a',
			'last_name' => $array['last_name'] ? ucwords(strtolower($array['last_name'])) : 'n/a' ,
			'fullname' => ucwords(strtolower($array['first_name'])).' '.ucwords(strtolower($array['last_name'])),
			'email' => $array['email'] ? $array['email'] : 'n/a' ,
			'address' => '' ,
			'city' => '' ,
			'state' => '' ,
			'zipcode' => '',
			'telephone' => $array['telephone'] ? $array['telephone'] : 'n/a' ,
			'website' => $array['website'] ? $array['website'] : 'n/a' ,
			'industry' => $array['industry'] ? $array['industry'] : 'n/a' ,
			'comments' => $array['comments'] ? $array['comments'] : 'n/a' ,
			'category' => 'Consultation' 
		);
		
		
		/**
		$config['protocol']='smtp';
		$config['smtp_host']='smtp.gmail.com';
		$config['smtp_port']='465';
		$config['smtp_user']='info@blumoocreative.com';
		$config['smtp_pass']='1965Chevy!';
		$config['validate'] = 'false';
		$config['wordwrap'] = TRUE;
		$config['mailtype']="html";
		$config['charset']='utf-8';
		$config['newline']="\r\n";
		$config['crlf'] = "\r\n";
		$config['smtp_timeout']='30';
		**/
		
		$config['protocol'] = 'smtp';
		$config['smtp_host'] ='smtp.sendgrid.net';
		$config['smtp_port'] = 587;
		$config['smtp_user'] = 'apikey';
		$config['smtp_pass'] = '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';
		$config['validate'] = TRUE;
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';
		$config['newline'] = "\r\n";
		$config['crlf'] = "\r\n";
		$config['smtp_timeout'] = '30';
		$config['priority']= 1;
		
		$this->email->initialize($config);
		
		$this->email->from('amandam@precip.com', 'WCI');
		$this->email->to('amandam@precip.com'); 
		$this->email->bcc('gregg@blumoocreative.com'); 
		$this->email->subject('WCI Inquiry');
		$message = $this->load->view('email/consultation', $data, true );
		
		$this->email->message($message);
		if($this->email->send())
		{
			
			if(STORE_CONTACT_DATA == 1)
			{
				//$this->db->replace($this->_contact_meta, $data);
				
			}

			return TRUE;
		}
		
		//$this->db->replace($this->_contact_meta, $data);
		
		return FALSE;
			
			
	}
	
	
	public function directions_map($data)
	{
		if(!empty($data['center']))
		{
			$data = '
				<div class="row">
					<div class="col-md-12">	
				
						<div id="map_canvas" ></div>
							<form id="gform" class="" action="#" onsubmit="return false">
								<div class="form-group col-md-9 no-padding-left">
									<label for="start" class="sr-only">Name</label>
									<input type="text" class="form-control" id="start" placeholder="From address" >
								</div>
								<div class="form-group col-md-3 no-padding-right">
									<input class="btn btn-primary btn-block" id="submit-button" type="submit" onclick="calcRoute();" value="Get Directions" >
								</div>
						
							</form>
						<div id="directions-panel"></div>
						
						<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key='.$data['apiKey'].'"></script>	
						<script type="text/javascript">
						      var directionDisplay;
						      var directionsService = new google.maps.DirectionsService();
						      var arrLatLon = [];
						
							      function initialize() {
							      	var mapStyles = [
								    {
								        "featureType": "landscape",
								        "stylers": [
								            {
								                "hue": "#FFA800"
								            },
								            {
								                "saturation": 0
								            },
								            {
								                "lightness": 0
								            },
								            {
								                "gamma": 1
								            }
								        ]
								    },
								    {
								        "featureType": "road",
								        "elementType": "labels",
								        "stylers": [
								            {
								                "visibility": "simplified"
								            },
								            {
								                "lightness": 20
								            }
								        ]
								    },
								    {
								        "featureType": "administrative.land_parcel",
								        "elementType": "all",
								        "stylers": [
								            {
								                "visibility": "off"
								            }
								        ]
								    },
								    {
								        "featureType": "landscape.man_made",
								        "elementType": "all",
								        "stylers": [
								            {
								                "visibility": "off"
								            }
								        ]
								    },
								    {
								        "featureType": "transit",
								        "elementType": "all",
								        "stylers": [
								            {
								                "visibility": "off"
								            }
								        ]
								    },
								    {
								        "featureType": "road.local",
								        "elementType": "labels",
								        "stylers": [
								            {
								                "visibility": "simplified"
								            }
								        ]
								    },
								    {
								        "featureType": "road.local",
								        "elementType": "geometry",
								        "stylers": [
								            {
								                "visibility": "simplified"
								            }
								        ]
								    },
								    {
								        "featureType": "road.highway",
								        "elementType": "labels",
								        "stylers": [
								            {
								                "visibility": "simplified"
								            }
								        ]
								    },
								    {
								        "featureType": "poi",
								        "stylers": [
								            {
								                "hue": "#679714"
								            },
								            {
								                "saturation": 33.4
								            },
								            {
								                "lightness": -25.4
								            },
								            {
								                "gamma": 1
								            }
								        ]
								    },
								    {
								        "featureType": "road.arterial",
								        "elementType": "labels",
								        "stylers": [
								            {
								                "visibility": "off"
								            }
								        ]
								    },
								    {
								        "featureType": "water",
								        "elementType": "all",
								        "stylers": [
								            {
								                "hue": "#00BFFF"
								            },
								            {
								                "saturation": 6
								            },
								            {
								                "lightness": 8
								            },
								            {
								                "gamma": 1
								            }
								        ]
								    },
								    {
								        "featureType": "road.highway",
								        "elementType": "geometry",
								        "stylers": [
								            {
								                "hue": "#f49935"
								            }
								        ]
								    },
								    {
								        "featureType": "road.arterial",
								        "elementType": "geometry",
								        "stylers": [
								            {
								                "hue": "#fad959"
								            }
								        ]
								    }
								]
							
							
							        directionsDisplay = new google.maps.DirectionsRenderer();
							        // replace LatLng values with map center location, also used for marker
							        var myLatlng = new google.maps.LatLng('.$data['center'].');
							        var myOptions = {
							          zoom: 16,
							          mapTypeId: google.maps.MapTypeId.ROADMAP,
							          center: myLatlng,
							          scrollwheel: false
							        };
							        var map = new google.maps.Map(document.getElementById("map_canvas"),
							            myOptions);
							        map.setOptions({styles: mapStyles});
							        
							        directionsDisplay.setMap(map);
							        directionsDisplay.setPanel(document.getElementById("directionsPanel"));
							        
							        var marker = new google.maps.Marker({
							      		position: myLatlng, 
							      		map: map, 
							      		title:"Coopers Creek"
							  		});
							            
							        var control = document.getElementById("gform");
							        control.style.display = "block";
							        //map.controls[google.maps.ControlPosition.TOP].push(control);
							      }
							        
							        function calcRoute() {
								        var start = document.getElementById("start").value;
								        var end = "'.$data['center'].'";
								        var request = {
								          origin: start,
								          destination: end,
								          travelMode: google.maps.DirectionsTravelMode.DRIVING
								        };
								        directionsService.route(request, function(response, status) {
								          if (status == google.maps.DirectionsStatus.OK) {
								            directionsDisplay.setDirections(response);
								          }
							        });
							      }
						
						      google.maps.event.addDomListener(window, "load", initialize);
						   </script>
						  </div>
						 </div>
				   ';
				   
			return $data;
		}
		
		return FALSE;
	}
}