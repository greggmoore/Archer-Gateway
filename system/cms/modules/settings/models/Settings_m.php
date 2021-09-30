<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, findmoxie.com
 * @package \System\Application\
 * copyright Copyright (c) 2016, MOXIE.COM
 */

// ------------------------------------------------------------------------

class Settings_m extends CI_Model {
	
	protected $_table = 'settings';
	protected $_auth_settings = 'auth_settings';
	
	function __construct()
	{
		parent::__construct();
		
	}
	
	public function site_settings() 
	{
		$this->db->select('key, value');
		$query = $this->db->get($this->_table);
		
		if ($query->num_rows() > 0)
		{
			foreach($query->result() as $row)
			{
				$data[$row->key] = $row->value;
			}
		}
		return $data;
	}
	
	
	public function auth_settings() 
	{
		$this->db->select('key, value');
		$query = $this->db->get($this->_auth_settings);
		
		if ($query->num_rows() > 0)
		{
			foreach($query->result() as $row)
			{
				$data[$row->key] = $row->value;
			}
		}
		return $data;
	}
	
	
	//Environment Dropdown
	public function environment($current)
	{
		$options = array(
			'development' => 'Development',
			'production' => 'Production',
			'testing' => 'Testing'
		);
		
		return form_dropdown('environment', $options, $current);
	}

	
	//Update Settings
	public function update($data = array(), $valid_keys = array())
	{
		
		if(!empty($valid_keys) && !empty($data))
		{
			foreach ($valid_keys as $key)
			{
				if (!$key) { continue; }
				$value = preg_replace('/"/', "'", $data[$key]);
				$array = array(
					'value' => $value
				);
				
				$this->db->where('key', $key);
				$this->db->update($this->_table, $array);
				
			}
			
			return TRUE;
		}
		
		return FALSE;
	}
	
	
	public function site_verifications()
	{
		$settings = $this->site_settings();
		$verifications = ( $settings['google_verification'] ) ? $settings['google_verification']."\n" : NULL ;
    	$verifications .= ( $settings['bing_verification_code'] ) ? $settings['bing_verification_code'] : NULL ;
    	
    	if(!empty($verifications))
    	{
	    	return $verifications;
    	}
    	
    	return $verifications;
		
	}
	
	
	
	public function greeting()
	{
		$name = '!';		
		
		if($this->ion_auth->logged_in())
		{
			$user = $this->ion_auth->user()->row();
			$name = ', '.$user->first_name.'!' ;
		}
		
		$time = date("H");
	    /* Set the $timezone variable to become the current timezone */
	    $timezone = date("e");
	    /* If the time is less than 1200 hours, show good morning */
	    if ($time < "12") {
	        return 'Good morning, '.$name;
	    } else
	    /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
	    if ($time >= "12" && $time < "17") {
	        return 'Good afternoon'.$name;
	    } else
	    /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
	    if ($time >= "17" && $time < "19") {
	        return 'Good evening'.$name;
	    } else
	    /* Finally, show good night if the time is greater than or equal to 1900 hours */
	    if ($time >= "19") {
	        return 'Good night'.$name;
	    }
	}
	
	
	public function ping($type)
	{
		if (defined('ENVIRONMENT') == 'production')
		{
			if(empty($type))
			{
				$type = 'sitemap';
			}
			
			$sitemap = SITE_URL.'/'.$type.'.xml';
			$pingurls = array(
				"http://www.google.com/webmasters/tools/ping?sitemap=",
				"http://www.bing.com/webmaster/ping.aspx?siteMap=",
				"http://webmaster.live.com/ping.aspx?siteMap="
			);
			
			foreach ($pingurls as $pingurl)
			{
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $pingurl.$sitemap);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$output = curl_exec($ch);
				curl_close($ch);
			}
			
			return TRUE;
		}
		
		return FALSE;
	}

}