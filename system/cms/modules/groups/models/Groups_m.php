<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, findmoxie.com
 * @package \System\Application\
 * copyright Copyright (c) 2016, MOXIE.COM
 */

// ------------------------------------------------------------------------

class Groups_m extends CI_Model
{
	protected $_users_groups = 'users_groups';
	protected $_groups = 'groups';
	
	function __construct()
	{
		parent::__construct();
		
	}
	
	public function get_group($id)
	{
		$this->db->select();
			$this->db->from($this->_groups);
			$this->db->where('id', $id);
			$query = $this->db->get();
			if($query->num_rows() > 0)
			{
				return $query->row();
			}
			
			return FALSE;	
			
	}
	
	public function get_all()
	{
		$this->db->select();
		$this->db->from($this->_groups);
		$this->db->order_by('name', 'desc'); 
		$query = $this->db->get();

		//make sure results exist
	    if($query->num_rows() > 0) {
		    $data = NULL ;
			
			foreach($query->result() as $r)
			{
				
				$data .= '
					<tr id="row_'.$r->id.'">
						<td>
							<a href="/admin/groups/edit/'.$r->id.'"><strong>'.$r->description.'</strong></a>
						</td>
						<td class="hidden-xs">'.$r->alt_name.'</td>
						<td class="hidden-xs">'.$r->uri.'</td>
						<td class="hidden-xs">
							<ul class="table-options">
								<li><a class="remove" href="#myModal" data-toggle="modal" data-id="'.$r->id.'" data-title="'.$r->alt_name.'" data-target="#myModal"><i class="fa fa-trash confirm-delete"></i></a></li>
							</ul>
						</td>
					</tr>
				';
			}
			
			return $data;
	    }
	    
	    return FALSE;
	}
	
	
	//Add Group
	function add($data = array())
	{
		$this->db->insert($this->_groups, $data);
		
		return $this->db->insert_id();
	}
	
	//Update Group
	public function update($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->_groups, $data);
		
		return $data;
	}
	
	//Remove Group
	public function remove($id)
	{
		$this->db->delete($this->_groups, array('id' => $id));
		return $this->db->affected_rows();
	}
	
	function check_uri($uri = NULL)
	{
		
		$this->db->select('uri');
		$this->db->from($this->_groups);
		$this->db->where('uri', $uri);
		
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return TRUE;
		}
		
		return FALSE;
	}
}