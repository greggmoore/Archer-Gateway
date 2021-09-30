<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, findmoxie.com
 * @package \System\Application\<?php defined('BASEPATH') OR exit('No direct script access allowed');


 * copyright Copyright (c) 2016, MOXIE.COM
 */

// ------------------------------------------------------------------------


class Modules_m extends CI_Model
{
	protected $_modules = 'modules';
	private $_module_exists = array();
	
	/**
	 * Exists
	 *
	 * Checks if a module exists
	 *
	 * @param	string	$module	The module slug
	 * @return	bool
	 */
	public function exists($module)
	{
		if ( ! $module)
		{
			return FALSE;
		}

		// We already know about this module
		if (isset($this->_module_exists[$module]))
		{
			return $this->_module_exists[$module];
		}
		
		$array = array('uri' => $module, 'is_active' => 1);
		
		return $this->_module_exists[$module] = $this->db
			->where($array)
			->count_all_results($this->_modules) > 0;
	}

	public function get($uri)
	{
		$this->db->select();
		$this->db->from($this->_modules);
		$this->db->where('uri', $uri);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->row();
		}
		
		return FALSE;	
			
	}
	
	public function admin_navigation($position = NULL)
	{
		
		$this->db->select('uri, title, nav_attr');
		$this->db->from('modules');
		$array = array('enabled' =>1, 'in_nav' => 1);
		$this->db->where($array);
		$this->db->order_by('sort_order', 'desc');
		$query = $this->db->get();

		if($query->num_rows > 0) 
		{
			$results = $query->result();
		}	
			else 
		{
			return FALSE;
		}
		
		
		
		$navigation = array();
		
		foreach($results as $link)
		{
			$navigation['leftside'] = '<li></li>';
		}
		
		return $links;
		
	}

}