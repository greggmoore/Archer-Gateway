<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore BluMoo Creative
 * @package System\Cms\Modules\Changeme\Models
 * copyright Copyright (c) 2019, BluMoo Creative, LLC
 */
// ------------------------------------------------------------------------

class five9_m extends CI_Model
{
	
	protected $_posts = 'posts';
	protected $_post_meta = 'post_meta';
	protected $_post_categories = 'post_categories' ;
	protected $_users = 'users';
	protected $_comments = 'comments';
	protected $_five9_username = '';
	protected $_five9_password = '';
	
	function __construct()
	{
		parent::__construct();
		
	}
	
	public function get()
	{
		echo 'gregg';
	}
	
	
	public function add_record()
	{
		
	}
	
	
	
	public function article($query_array = array())
	{
		if(!empty($query_array))
		{
			$this->db->select();
			$this->db->from($this->_posts);
			$this->db->where($query_array);
			$query = $this->db->get();
			if($query->num_rows() > 0)
			{
				return $query->row();
			}
			
			return FALSE;
		}		
			
		return FALSE;
	}
}