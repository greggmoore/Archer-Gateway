<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Whma_m extends CI_Model {
	
	protected $_host_ip = '132.148.17.24';
	protected $_user_name = 'myrocketlisting';
	protected $_auth_user = 'root';
	protected $_auth_password = 'Blueblue992!';
	
	protected $_micro_meta = 'micro_meta';	
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('Cpanel_Api');	
		
	}

	public function park($url)
	{

		if($input = $this->get_domain($url))
		{
			$input = trim($url, '/');
					// If scheme not included, prepend it
			if (!preg_match('#^http(s)?://#', $input)) {
			    $input = 'http://' . $input;
			}
			
			$urlParts = parse_url($input);
			
			$domain = preg_replace('/^www\./', '', $urlParts['host']);
									
			$xmlapi = new xmlapi($this->_host_ip);
			$xmlapi->password_auth($this->_auth_user, $this->_auth_password);
			$xmlapi->set_output('array');
			return $xmlapi->park($this->_user_name, $domain, NULL);
			
		}
			
		return FALSE ;	
	
	}
	
	public function unpark($domain)
	{
		$xmlapi = new xmlapi($this->_host_ip);
		$xmlapi->password_auth($this->_auth_user, $this->_auth_password);
		$xmlapi->set_output('array');
		return $xmlapi->unpark($this->_user_name, $domain);
	}
	
	
	public function get_domain($domain)
	{
	  $url = preg_replace('/https?:\/\/|www./', '', $domain);
	   if ( strpos($url, '/') !== false) {
	      $ex = explode('/', $url);
	      $url = $ex['0'];
	   }
	      return $url;
	}
}