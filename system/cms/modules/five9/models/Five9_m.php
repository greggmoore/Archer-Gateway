<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore BluMoo Creative
 * @package System\Cms\Modules\Changeme\Models
 * copyright Copyright (c) 2019, BluMoo Creative, LLC
 */
// ------------------------------------------------------------------------

class Five9_m extends CI_Model
{
	
	protected $_posts = 'posts';
	protected $_post_meta = 'post_meta';
	protected $_post_categories = 'post_categories' ;
	protected $_users = 'users';
	protected $_comments = 'comments';
	
	protected $_five9_server = 'https://api.five9.com/wsadmin/v11/AdminWebService?wsdl&user=';
	protected $_five9_username = 'gmoore@archerhealthcare.com';
	protected $_five9_password = 'Archer99!';
	protected $_five9_list = 'MTPA Radicava';
	
	protected $_submission_meta = 'submission_meta' ;
	
	protected $_fields = array(
            
            'number1'    =>  array( 'type' => 'phone'   , 'min' =>  10, 'max' =>  14, 'is_key' => TRUE  ),
            //'number2'    =>  array( 'type' => 'phone'   , 'min' =>  10, 'max' =>  14, 'is_key' => false ),
            //'number3'    =>  array( 'type' => 'phone'   , 'min' =>  10, 'max' =>  14, 'is_key' => false ),
            'first_name' =>  array( 'type' => 'string'  , 'min' =>   3, 'max' => 100, 'is_key' => false ),
            'last_name'  =>  array( 'type' => 'string'  , 'min' =>   3, 'max' => 100, 'is_key' => false ),
            'company'    =>  array( 'type' => 'string'  , 'min' =>   2, 'max' =>  50, 'is_key' => false ),
            'street'     =>  array( 'type' => 'string'  , 'min' =>   2, 'max' => 100, 'is_key' => false ),
            'city'    	 =>  array( 'type' => 'string'  , 'min' =>   2, 'max' =>  50, 'is_key' => false ),
            'state'      =>  array( 'type' => 'string'  , 'min' =>   2, 'max' =>   2, 'is_key' => false ),
            'zip'        =>  array( 'type' => 'int'     , 'min' =>   5, 'max' =>   5, 'is_key' => false ),
            'email'      =>  array( 'type' => 'string'  , 'min' =>   2, 'max' => 100, 'is_key' => false ),
            'Call Date and Time'      =>  array( 'type' => 'string'  , 'min' =>   2, 'max' => 100, 'is_key' => false )
            //'F9CallASAP'      =>  array( 'type' => 'boolean'  , 'min' =>   1, 'max' => 10, 'is_key' => false ) ,
            //'F9TimeToCall'      =>  array( 'type' => 'string'  , 'min' =>   2, 'max' => 100, 'is_key' => false ),
            //'F9TimeFormat'      =>  array( 'type' => 'string'  , 'min' =>   2, 'max' => 100, 'is_key' => false )
	);
  
	
	function __construct()
	{
		parent::__construct();
		
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
		$wsdl_five9 = $this->_five9_server . $username;
				
		try {
			$soap_options = array( 	'login'    =>  $username,
                               		'password' =>  $password,
							   		'trace' => TRUE );
				   		
			$client_five9 = new SoapClient( $wsdl_five9 , $soap_options );
			$response['success'] = $client_five9;
			
		}
		catch (Exception $e) 
		{
			$error_message = $e->getMessage();
			$response['error'] = $error_message;
			
			
		}
		return $response;
	}
	
	//public function addRecordToList($lead, $list)
	public function addRecordToList($params)
	{
		//print_r($params); exit();
		$response = array();
		
			$phone = $params['phone'];
			
			$lead = array(
			    'number1' => $test = str_replace("-", " ", $params['phone']) ,
			    //'number2' => $params[''] ,
			    //'number3' => $params[''] ,
			    //'first_name' => $params[''],
			    //'last_name' => $params[''] ,
			    //'company' => $params[''] ,
			    //'street' => $params[''] ,
			    //'city' => $params[''] ,
			    //'state' => $params[''] ,
			    //'zip' => $params[''] ,
			   // 'email' => $params['']
		    );	
		    
		
		$data = $this->scrub_array( $this->_fields, $lead );
		
		if(sizeof($lead) === sizeof($data) )
		{
			$client_five9 = $this->authenticate($params['five9_username'], $params['five9_password']);
			
			if( array_key_exists('success', $client_five9) )
			{
				 $client = $client_five9['success'];
				 
				 $mappedFields = $this->map_fields($data, $this->_fields, 1);
				 
				 if (array_key_exists('member_id' , $data)){
		           $list = $params['five9_list'];
		         }
		         
		         $data = array_values($data);
		         
				//Settings required by five9
				$listUpdateSettings['fieldsMapping'] = $mappedFields;
				$listUpdateSettings['skipHeaderLine'] = false;
				$listUpdateSettings['cleanListBeforeUpdate'] = false;
				$listUpdateSettings['crmAddMode'] = 'ADD_NEW';
				$listUpdateSettings['crmUpdateMode'] = 'UPDATE_SOLE_MATCHES';
				$listUpdateSettings['listAddMode'] = 'ADD_IF_SOLE_CRM_MATCH';
				
				//prepare the query used to add the record to five9
				$query = array ( 'listName' => $params['five9_list'],
                           		'listUpdateSettings' => $listUpdateSettings,
						   		'record' => $data ,
						   		'F9CallASAP' => 1 ,
						   		'F9TimeToCall' => date('Y-m-d H:i:s'),
						   		'F9TimeFormat' => 'yyyy-MM-dd%20HH:mm:ss.SSS'
						   		);
						   	
				try
				{
					$result = $client->addRecordToList($query);
					$resp = get_object_vars($result->return);
					
					if($resp['failureMessage'] != '')
					{
						$response['errors'] = $resp['failureMessage'];
            		}
            		
            		if($resp['crmRecordsUpdated'] == 1 || $resp['crmRecordsInserted'] == 1)
            		{
		              $response['success'] = TRUE;
		            }
		            
		            //$this->add_record($params);
				}
				
				catch (Exception $e)
				{
					//get the error message
					$error_message = $e->getMessage();
					//add the error message to the response array
					//$response['error'] = $error_message;
					//$response['success'] = FALSE;
					
					$response = array(
						'listName' => $params['five9_list'] ,
						'error' => $error_message ,
						'success' => FALSE
					);
					
					$this->send_error($response);
		        }
		          
			}
		}
			else
		{
			//return the differences in the arrays usually caused due to improper names
			//$response['errors'] = array_diff($lead, $data);
			
				$response = array(
					'listName' => $params['five9_list'] ,
					'errors' => array_diff($lead, $data) ,
					'success' => FALSE
				);
			
				$this->send_error($response);
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
			'phone' => $data['number1'] ,
			//'first_name' => $data['first_name'] ,
			//'last_name' => $data['last_name'] ,
			//'company' => $data['company'] ,
			//'street' => $data['street'] ,
			//'city' => $data['city'] ,
			//'zipcode' => $data['zip'] ,
			//'email' => $data['email'],
			'list_name' => $params['five9_list']
		);
		
		$this->db->insert($this->_submission_meta, $meta);
		
		return TRUE;
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
    
    public function send_error($message)
    {

		
		
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
		
		$this->email->from('info@archergateway.com', 'Archer Gateway');
		$this->email->to('gregg@blumoocreative.com'); 
		//$this->email->bcc('gregg@blumoocreative.com'); 
		$this->email->subject('Archer Gateway Error Notice');
		$message = $this->load->view('email/error_message', $message, true );
		
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
    
	
	
}