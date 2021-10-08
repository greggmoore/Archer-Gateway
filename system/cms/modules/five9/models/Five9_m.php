<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore BluMoo Creative
 * @package System\Cms\Modules\Changeme\Models
 * copyright Copyright (c) 2019, BluMoo Creative, LLC
 */
// ------------------------------------------------------------------------

class Five9_m extends CI_Model
{
	
	protected $_api_keys = 'api_keys';
	protected $_five9_meta = 'five9_meta';
	protected $_clients = 'clients' ;
	protected $_client_lists = 'client_lists';
	protected $_comments = 'comments';
	protected $_submission_meta = 'submission_meta' ;
	protected $_five9_server = 'https://api.five9.com/web2campaign/AddToList';

	function __construct()
	{
		parent::__construct();
		
	}

	
	//public function addRecordToList($lead, $list)
	public function addRecordToList($params)
	{
		//print_r($params); exit();
		$response = array();
			
			//Format phone number
			$phone = str_replace("-", "", $params['phone']);
			
			//Format Time, Date & F9 Time To Call
			$date = $this->format_date_time($params['datetime']);
			/**
			$phone = '9105127527';
			
				$date = array(
				'F9TimeToCall' => '2021-05-11 22:16:00 -0400',
				'date_to_record' => '05/11/2021',
				'time_to_record' => '22:16:00'
			);
			
			**/
			$F9key = $this->generateRandomString();
			
			$array = array(
				'F9domain' => $params['five9_domain'] , 
				'F9key' => 'RadicavaID' ,
				'RadicavaID' => $F9key , 
				'F9list' => $params['five9_list'] ,
				'number1' => $phone ,
				'F9updateCRM' => true ,
				'MTPA-Campaign' => $params['campaign'] ,
				'MTPA-Website' => $params['website'] ,
				'Call Date' => $date['date_to_record'],
				'Call Time' => $date['time_to_record'] ,
				'F9TimeToCall' => $date['F9TimeToCall'] ,
				'F9TimeFormat' => $params['five9_time_format']
			);
			
			$data_array = array_merge($array, $params);
			
			//print_r($data_array); exit();
		
			//Build query for record
			$endpoint = $params['five9_server'];
			$query = http_build_query($array);
			
			//Build authorization header
			$auth_details = base64_encode($params['five9_password'].':'.$params['five9_username']);
			$options = array(
			    'http' => array(
			        'header' => "Content-Type: application/x-www-form-urlencoded\r\n".
			                    "Content-Length: ".strlen($query)."\r\n".
			                    "Authorization:Basic ".$auth_details."\r\n",
			        'method'  => "POST",
			        'content' => $query
			    ),
			);
			
			$context  = stream_context_create($options);
			$result = file_get_contents($endpoint, false, $context);
			
			//print_r($result); exit();
		
		if(FALSE !== ($result = @file_get_contents($endpoint, false, $context)))
		{			
			//record record in local database for good measure
			
			$data_array = array_merge($array, $params);
			
				
			if($this->add_record($data_array))
			{
				$response['success'] = TRUE;
			}
			
		}
			else
		{
			$response['success'] = FALSE;
		}
		
		
		return $response;
		
	}
	
	
	// ------------------------------------------------------------------------
	/**
     * Enter New Record
     *
     * @return <array>
     */
	public function add_record($data = array())
	{

		$meta = array(
			'phone' => isset($data['phone']) ? $data['phone'] : '' ,
			'datetime' => isset($data['datetime']) ? $data['datetime'] : '' ,
			'F9domain' => isset($data['five9_domain']) ? $data['five9_domain'] : '' ,
			'F9list' => isset($data['five9_list']) ? $data['five9_list'] : '' ,
			'F9key' => isset($data['F9key']) ? $data['F9key'] : '' ,
			'F9TimeToCall' => isset($data['F9TimeToCall']) ? $data['F9TimeToCall'] : '' ,
			'RadicavaID' => isset($data['RadicavaID']) ? $data['RadicavaID'] : '' ,
			'mtpa_website' => isset($data['website']) ? $data['website'] : '' ,
			'mtpa_campaign' => isset($data['campaign']) ? $data['campaign'] : '' ,
			'call_date' => isset($data['Call Date']) ? $data['Call Date'] : '',
			'call_time' => isset($data['Call Time']) ? $data['Call Time'] : ''
		);
		
		if($this->db->insert($this->_submission_meta, $meta))
		{
			return TRUE;
		}
		
		return FALSE;
	}
	
	
	public function getListsInfo()
    {
        $client_five9 = $this->authenticate($this->_five9_username, $this->_five9_password);
        
        if( array_key_exists('success', $client_five9) )
        {
	        
	        $client = $client_five9['success'];
	        
	        $data = array(
            	'listNamePattern' => $this->_five9_list
			);
			
			$result = $client->getListsInfo($data);
			return $result;
        
        }
			
    }
    
    
    public function getContactFields()
    {
        $client_five9 = $this->authenticate($this->_five9_username, $this->_five9_password);
        
        if( array_key_exists('success', $client_five9) )
        {
	        
	        $client = $client_five9['success'];
	        
	        $data = array(
            	'listNamePattern' => $this->_five9_list
			);
			
			$result = $client->getContactFields($data);
			return $result;
        
        }
			
    }
    
    
    private function map_fields($record, $fields, $i)
	{
		foreach ($record as $key => $value) {

	      //map the field to the five9 system
	      $mappedFields[] =  array( 'columnNumber' => $i, 'fieldName' => $key, 'key' => $fields[$key]['is_key'] );
		  $i++;
	    }
	
	    return $mappedFields;
	}
	
	
	
	private function scrub_array($fields, $lead)
	{
		foreach($lead as $key => $value){
	      //if the keys match and the field is the correct size
	      if( array_key_exists($key, $fields) && ( strlen($value) >= $fields[$key]['min'] && strlen($value) <= $fields[$key]['max'] ) ):
	        if($fields[$key]['type'] == 'string' && is_string($value)){
	          $data[$key] = $value;
	        }
	        if($fields[$key]['type'] == 'phone' ){
	          $data[$key] = preg_replace('/[^0-9]/', '', $value);
	        }
	        if($fields[$key]['type'] == 'int' && is_numeric($value)){
	          $data[$key] = $value;
	        }
	      endif; //end keys match if
	    }
	    return $data;
	}
	
	
	private function authenticate($username, $password)
	{
		$wsdl_five9 = $this->_five9_server;
				
		try {
			
			$soap_options = array( 	'F9domain'    =>  'Archer%20Healthcare',
                               		'F9key' =>  'number1',
							   		'F9list' => 'MTPA Radicava' );
			$auth_details   = base64_encode($username.":".$password);
				   		
			$client = new SoapClient( $wsdl_five9 , $soap_options );
			$header = new SoapHeader($wsdl_five9, "Authorization", 'Basic' . $auth_details ); 
			$response['success'] = $client_five9;
			
		}
		catch (Exception $e) 
		{
			$error_message = $e->getMessage();
			$response['error'] = $error_message;			
		}
		return $response;
	}
	
	
    
    public function format_date_time($posted_date)
	{       
		//Please read Five9's Web2Campaign API documnetation for correct time/date format		
		if(!empty($posted_date))
		{
			$dt = str_replace(' ET','',$posted_date);			
			
			$date = array(
				'F9TimeToCall' => date("Y-m-d H:i:s", strtotime($dt)). ' -0400',
				'date_to_record' => date("m/d/Y", strtotime($dt)),
				'time_to_record' => date("H:i:s", strtotime($dt))
			);
		}
			else
		{
			$currentdate = date('m/d/Y H:i:s');
			
			$dt   = new DateTime($currentdate);
			$timestamp =  $dt->getTimestamp();
			
			$date = array(
				'F9TimeToCall' => date("Y-m-d H:i:s", strtotime($timestamp)). ' -0400',
				'date_to_record' => date('m/d/Y'),
				'time_to_record' => date('G:i:s')
			);
		}
	
	    return $date;
	}
	
	
	private function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
	
	
	public function get_five9_meta($id)
	{
		$this->db->select('key');
		$this->db->from($this->_five9_meta);
		$this->db->where(array('api_id' => $id, 'is_active' => 1));
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		
		return FALSE ;
	}

}