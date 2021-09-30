<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, seorets.com
 * @package \System\Application\
 * copyright Copyright (c) 2017, SEORETS.COM
 */

// ————————————————————————————————————

class Report_m extends CI_Model
{
	//Zillow API
	protected $_zws_id = 'X1-ZWz1fy1kpoiu4r_73nhl';
	//Google Maps Javascript API: AIzaSyBtNB4BID17_G8DxQrBrG66vX6KEsZdQMU
	//Google Static Maps API: AIzaSyBDO3vsR3BMjNtXYTV8VSnrxeHQD8W98Ow
	//Google Embed Maps API: AIzaSyAqWdPWd4rgybFRtWt775h_gd-OgRTdBYM

	
	function __construct()
	{
		parent::__construct();
		$this->load->file('system/cms/modules/report/libraries/Geocoder.php', true);
		
	}
	
	
	/**
	 * Data for report manipulation
	 *
	 * @var string
	*/
	public function get_report($post)
	{
		$address = $this->process_geolocation($post['q']);
		//$user_email = array('email' => $post['email']);
		
		if(!empty($address))
		{
			$results = $this->get_search_results_call($address);
			
			if(!empty($results))
			{
				//$array = array_merge($results, $user_email);
				if($lid = $this->leads_m->register($results))
				{					
					return array('results' => $results, 'lid' => $lid);
				}
			}
		}
		
		return FALSE;
	}
	
	
	
	/**
	 * Parse address via Google Geolocation Services
	 *
	 * @var string
	*/
	public function process_geolocation($address = NULL)
	{
		$latitude = NULL;
		$longitude = NULL;
		
		$geo = geocoder_json($address);
		
		/**
		echo '<pre>';
		print_r($geo);
		echo '</pre>';
		exit();
		**/
				
		$street_number = 	$geo->find_address_components('street_number');
		$route = 	$geo->find_address_components('route');
		$city = 	$geo->find_address_components('locality');
		$state = 	$geo->find_address_components('administrative_area_level_1');
		$zipcode =  $geo->find_address_components('postal_code');
		$county =  $geo->find_address_components('administrative_area_level_2');
			
		//Set varibles
		$data['latitude'] = ($geo->results['latitude'])?$geo->results['latitude']:'';
		$data['longitude'] = ($geo->results['longitude'])?$geo->results['longitude']:'';
		$data['formatted_address'] = ($geo->results['formatted_address'])?$geo->results['formatted_address']:'';
		$data['street_number'] = ($street_number)?$street_number->long_name:'';
		$data['route'] = ($route)?$route->long_name:'';
		$data['city'] = ($city)?$city->long_name:'';
		$data['state_long_name'] = ($state)?$state->long_name:'';
		$data['state_short_name'] = ($state)?$state->short_name:'';
		$data['citystate'] = $data['city'].', '.$data['state_short_name'];
		$data['address'] = $data['street_number'].' '.$data['route'];
		$data['zipcode'] = ($zipcode)?$zipcode->long_name:'';
		$data['county'] = ($county)?$county->long_name:'';
		
		
		if($geo->results['status'] == 'OK')
		{
			return $data;
		}
		
		return FALSE;
	}
	
	/**
	 * Collect Zillow Research Result
	 *
	 * @var string
	*/
	
	public function get_search_results_call($address)
	{
		
		//Must use Google API to parse address.
		
		//Example: http://www.zillow.com/webservice/GetSearchResults.htm?zws-id=<ZWSID>&address=2114+Bigelow+Ave&citystatezip=Seattle%2C+WA
		
		$address_urlencode = rawurlencode($address['address']);
		$citystate_urlencode = rawurlencode($address['citystate']);
		
		
		$target = 'http://www.zillow.com/webservice/GetSearchResults.htm?zws-id='.$this->_zws_id.'&address='.$address_urlencode.'&citystatezip='.$citystate_urlencode;

		
		if($result = file_get_contents($target))
		{
			$data = simplexml_load_string($result);
			
			if($data->message->code == 0)
			{
				//Assign the ZPID
				$zpid = $data->response->results->result->zpid;
				//GetZestimate
				
				$ztarget = 'http://www.zillow.com/webservice/GetZestimate.htm?zws-id='.$this->_zws_id.'&zpid='.$zpid;
				if($zresult = file_get_contents($ztarget))
				{
					$zdata = simplexml_load_string($zresult);
					
					if($zdata->message->code == 0)
					{
						$fulladdress = $zdata->response->address->street->__toString().', '.$zdata->response->address->city->__toString().', ' .$zdata->response->address->state->__toString().' '.$zdata->response->address->zipcode->__toString();
						
						//Assign high, Low						
						$response = array(
							'amount' => $zdata->response->zestimate->amount->__toString(),
							'city' => $zdata->response->address->city->__toString() ,
							'comparables' => $zdata->response->links->comparables->__toString() ,
							'fulladdress' => $fulladdress ,
							'graphsanddata' => $zdata->response->links->graphsanddata->__toString() ,
							'high' => $zdata->response->zestimate->valuationRange->high->__toString(),
							'homedetails' => $zdata->response->links->homedetails->__toString() ,
							'latitude' => $zdata->response->address->latitude->__toString() ,
							'longitude' => $zdata->response->address->longitude->__toString() ,
							'low' => $zdata->response->zestimate->valuationRange->low->__toString() ,
							'mapthishome' => $zdata->response->links->mapthishome->__toString() ,
							'percentile' => $zdata->response->zestimate->percentile->__toString(),
							'street' => $zdata->response->address->street->__toString() ,
							'state' => $zdata->response->address->state->__toString() ,
							//'last_updated' => $zdata->response->zestimate->last-updated->__toString(),
							'valueChange' => $zdata->response->zestimate->valueChange->__toString() ,
							'zipcode' => $zdata->response->address->zipcode->__toString() ,
							'zpid' => $zpid ,
							'created_ts' => date('Y-m-d H:i:s') ,
							
						);
						
						return $response;
					}
				}
			}
			
		}
		
		return FALSE;
	}
	
	
	//The following table summarizes possible return codes from the Zillow API:
	public function error_code_messages($code)
	{
		if(!empty($code))
		{
			switch($code)
			{
				case 1:
					$message = array(
						'description' => 'Service error-there was a server-side error while processing the request' ,
						'resolution' => 'Check to see if your url is properly formed: delimiters, character cases, etc.'
					);
					break;
				
				case 2:
					$message = array(
						'description' => 'The specified ZWSID parameter was invalid or not specified in the request' ,
						'resolution' => 'Check if you have provided a ZWSID in your API call. If yes, check if the ZWSID is keyed in correctly. If it still doesn\'t work, contact Zillow to get help on fixing your ZWSID.'
					);
					break;
				
				case 3:
					$message = array(
						'description' => 'Web services are currently unavailable' ,
						'resolution' => 'The Zillow Web Service is currently not available. Please come back later and try again.'
					);
					break;
				
				case 4:
					$message = array(
						'description' => 'The API call is currently unavailable' ,
						'resolution' => 'The Zillow Web Service is currently not available. Please come back later and try again.'
					);
					break;
				
				case 500:
					$message = array(
						'description' => 'Invalid or missing address parameter' ,
						'resolution' => 'Check if the input address matches the format specified in the input parameters table. When inputting a city name, include the state too. A city name alone will not result in a valid address.'
					);
					break;
				
				case 501:
					$message = array(
						'description' => 'Invalid or missing citystatezip parameter	' ,
						'resolution' => 'Same as error 500.'
					);
					break;
				
				case 502:
					$message = array(
						'description' => 'No results found' ,
						'resolution' => 'Sorry, the address you provided is not found in Zillow\'s property database.'
					);
					break;
				
				case 503:
					$message = array(
						'description' => 'Failed to resolve city, state or ZIP code' ,
						'resolution' => 'Please check to see if the city/state you entered is valid. If you provided a ZIP code, check to see if it is valid.'
					);
					break;
				
				case 504:
					$message = array(
						'description' => 'No coverage for specified area' ,
						'resolution' => 'The specified area is not covered by the Zillow property database.'
					);
					break;
				
				case 505:
					$message = array(
						'description' => 'Timeout' ,
						'resolution' => 'Your request timed out. The server could be busy or unavailable. Try again later.'
					);
					break;
				
				case 506:
					$message = array(
						'description' => 'Address string too long' ,
						'resolution' => 'If address is valid, try using abbreviations.'
					);
					break;
				
				case 507:
					$message = array(
						'description' => 'No exact match found.' ,
						'resolution' => 'Verify that the given address is correct.'
					);
					break;
					
			}
			
			return $message;
		}
		
		return FALSE;
	}
	
	
	
	
}