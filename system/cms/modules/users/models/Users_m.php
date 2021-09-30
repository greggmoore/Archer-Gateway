<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, findmoxie.com
 * @package \System\Application\
 * copyright Copyright (c) 2016, MOXIE.COM
 */

// ------------------------------------------------------------------------

class Users_m extends CI_Model
{
	protected $_groups = 'groups';
	protected $_micro_meta = 'micro_meta';
	protected $_menu_links = 'menu_links';
	protected $_users = 'users';
	protected $_users_groups = 'users_groups';
	
	protected $_user_call_meta = 'user_call_meta';
	protected $_user_email_meta = 'user_email_meta';
	protected $_user_inquiry_meta = 'user_inquiry_meta';
	protected $_user_notes_meta = 'user_notes_meta';
	protected $_assigned_zipcodes = 'assigned_zipcodes';
	
	function __construct()
	{
		parent::__construct();
		
	}

	public function get_all()
	{

		/**
		$this->db->distinct();
		$this->db->select('u.id, u.email, u.first_name, u.fullname, u.last_name, u.mobile, u.phone, u.created_on, u.modified_ts');
		$this->db->from($this->_users.' as u');
		$this->db->join('users_groups as ug', 'ug.user_id = u.id');
		$this->db->where_in('ug.group_id', 1);
		$this->db->order_by('u.last_name', 'desc'); 
		**/
		$this->db->select();
		$this->db->from($this->_users);
		$this->db->order_by('last_name', 'desc'); 
		$query = $this->db->get();

		//make sure results exist
	    if($query->num_rows() > 0) {
	        
	        $data = NULL ;
	        $modals = NULL ;
	        $inquiry_count = NULL ;
	        $call_count = NULL ;
	        $note_count = NULL;
	        $email_count = NULL;

	        foreach($query->result() as $r)
	        {
	        	$ugroups = NULL;
	        	$groups = $this->ion_auth->get_users_groups($r->id)->result();
	        	if(!empty($groups))
	        	{
		        	foreach($groups as $ug)
		        	{

			        	$ugroups .= '<span class="ug btn btn-xs '.$ug->color.'">'.$ug->alt_name.'</span>';
		        	}
	        	}
	        	
	        		$secondary_phone = $r->telephone ? $r->telephone : '' ;
						$primary_phone = $r->mobilephone ? $r->mobilephone : $secondary_phone ;	        	
	        	
	        	/**
		        	$inquiry_count = $this->user_meta_count($r->id, $this->_user_inquiry_meta);
	        	$call_count = $this->user_meta_count($r->id, $this->_user_call_meta);
	        	$email_count = $this->user_meta_count($r->id, $this->_user_email_meta);
	        	$note_count = $this->user_meta_count($r->id, $this->_user_notes_meta);
	        	**/
	        	
	        	$data .= '
	        	<tr id="row_'.$r->id.'">
					
					<td>
						<a href="/admin/users/edit/'.$r->id.'"><strong>'.$r->fullname.'</strong></a>
					</td>
					<td>'.$ugroups.'</td>
					<td>'.$r->email.'</td>
					<td>
						<ul class="table-options">
							<li><a class="remove text-center" href="#myModal" data-toggle="modal" data-id="'.$r->id.'" data-title="'.$r->fullname.'" data-target="#myModal"><i class="fa fa-trash confirm-delete"></i></a></li>
						</ul>
					</td>
				</tr>';
	        }
	        	        
	        return $data;
	        
	    }
	    
	    return FALSE ;
	}
	
	
	function check_username($username = NULL)
	{
		
		$this->db->select('username');
		$this->db->from($this->_users);
		$this->db->where('username', $username);
		
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return TRUE;
		}
		
		return FALSE;
	}
	
	function check_uri($uri = NULL)
	{
		
		$this->db->select('uri');
		$this->db->from($this->_users);
		$this->db->where('uri', $uri);
		
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return TRUE;
		}
		
		return FALSE;
	}
	
	
	public function groups()
	{
		$this->db->select('id, alt_name');
		$this->db->from('groups');
		$this->db->order_by('id');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$data = array();
			foreach($query->result_array() as $r)
			{
				
				$data[$r['id']] = $r['alt_name'];
			}
			
			return $data;
		}
	}
	
	public function users_groups($id)
	{
		$id || $id = $this->session->userdata('user_id');
		$this->db->select('group_id as id');
		$this->db->from('users_groups');
		$this->db->where(array('user_id' => $id));
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			$data = array();
			foreach($query->result_array() as $r)
			{
				$data[] = $r['id'];
			}
			
			return $data;
		}
		
		return FALSE;
		
	}
	
	
	public function menu($menu_id = 3, $current)
	{
		$active = '';
		
		$this->db->select();
		$this->db->from($this->_menu_links);
		$this->db->where('is_active', 1);
		$this->db->where('menu_id', $menu_id);
		$this->db->order_by('sort_order');
		
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$data = '<div class="list-group">';
			foreach($query->result() as $q)
			{
				$current = trim($current);
				
				$active = ($q->uri == $current) ? ' active' : '' ;
				
				$data .= '<a class="list-group-item'.$active.'" href="/users/'.$q->uri.'" title="'.$q->name.'">'.$q->name.'</a>';
			}
			$data .='</div>';
			
			return $data;
		}
		
		return FALSE;
		
	}
	
	
	public function toggle_zipcode($id, $zipcode)
	{
		//echo 'gregg';
		
		if($this->zipcode_delete($id, $zipcode))
		{
			if($this->zipcode_add($id, $zipcode))
			{
				return TRUE;
			}
		}
		
		return FALSE;
	}
	
	
	public function zipcode_add($id, $zipcode)
	{
		$array = array(
			'uid' => $id,
			'zipcode' => $zipcode
		);
		
		$this->db->insert($this->_assigned_zipcodes, $array);
		
		return $id; 
	}
	
	
	
	public function zipcode_delete($id, $zipcode)
	{
		
		$array = array(
			'uid' => $id,
			'zipcode' => $zipcode
		);

        if($this->db->delete($this->_assigned_zipcodes, $array))
		{
			return TRUE;
		}
        
        return FALSE;
        
	}
	
	
	public function user_zipcodes($id)
	{
		$this->db->select();
		$this->db->from($this->_assigned_zipcodes);
		$this->db->where('uid', $id);
			$this->db->order_by('zipcode', 'desc');
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			$data = array();
	        
	        $data['html'] = '';
	        $data['count'] = $query->num_rows();
	        
	        foreach($query->result() as $r)
	        {
		         $data['html'] .= '
			        <div class="checkbox">
						<label>
							<input type="checkbox" name="deletezip[]" value="'.$r->zipcode.'">
							<span>'.$r->zipcode.'</span>
						</label>
					</div>
			        ';
			        
	        }
	        
	        return $data ;
		}
		
		$data['html'] = '<div class="alert alert-info">You currently have <strong>no zip codes</strong> assigned to your account.</div>' ;
		$data['count'] = 0;
		
		return $data;
	}
	
	
	public function check_domain($domain)
	{
		$this->db->select();
		$this->db->from($this->_micro_meta);
		$this->db->where('domain', $domain);
		
		$query = $this->db->get();
	    if($query->num_rows() > 0) {
	        
	        return $query->row();
	        
	    }
	    
	    return FALSE;
	}
	
	public function check_subdomain($subdomain)
	{
		$this->db->select();
		$this->db->from($this->_micro_meta);
		$this->db->where('subdomain', $subdomain);
		
		$query = $this->db->get();
	    if($query->num_rows() > 0) {
	        
	        return $query->row();
	    }
	    
	    return FALSE;
	}

	
	
	public function micro_add($array)
	{
		$this->db->insert($this->_micro_meta, $array);
		return $this->db->insert_id();
	}
	
	
	public function micro_get($domain, $subdomain)
	{
		$this->db->select();
		$this->db->from($this->_micro_meta);
		$this->db->where('id', $domain);
		$this->db->or_where('domain', $domain);
		$this->db->or_where('subdomain', $subdomain);
		
		$query = $this->db->get();
	    if($query->num_rows() > 0) {
	        
	        return $query->row();
	        
	    }
	    
	    return FALSE;
	}
	
	
	public function micro_remove($id)
	{
		if($this->db->delete($this->_micro_meta, array('id' => $id)))
		{
			return $this->db->affected_rows();
		}
		
		return FALSE;
	}
	
	
	public function micro_update($id, $array)
	{
		if($this->db->update($this->_micro_meta, $array, array('id' => $id)))
		{
			return TRUE;
		}
		
		return FALSE ;
	}
	
	public function micro_get_all_for_admin($id)
	{
		$this->db->select();
		$this->db->from($this->_micro_meta);
		$this->db->where('user_id', $id);
		$this->db->order_by('title', 'desc');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$data = NULL ;
			
			foreach($query->result() as $r)
			{

				$data .= '
					<tr id="row_'.$r->id.'">
						<td>
							<a class="open-micro-edit" href="#editMicro" data-toggle="modal" data-id="'.$r->id.'" data-title="'.$r->title.'" data-target="#editMicro"><strong>'.$r->title.'</strong></a>
						</td>
						<td class="hidden-xs">'.$r->subdomain.'</td>
						<td class="hidden-xs">'.$r->domain.'</td>
						<td class="hidden-xs">
							<ul class="table-options">
								<li><a class="remove" href="#deleteMicro" data-toggle="modal" data-id="'.$r->id.'" data-title="'.$r->title.'" data-target="#deleteMicro"><i class="fa fa-trash confirm-delete"></i></a></li>
							</ul>
						</td>
					</tr>
				';
			}
			
			return $data ;
		}
		
		return FALSE ;
	}


	
	
	public function micro_get_all_for_user($id)
	{
		$this->db->select();
		$this->db->from($this->_micro_meta);
		$this->db->where('user_id', $id);		
		$query = $this->db->get();
	    if($query->num_rows() > 0) {
	        
	        return $query->result();
	        
	    }
	    
	    return FALSE;
	}
	
	
	public function micro_by_user($id)
	{
		$this->db->select();
		$this->db->from($this->_micro_meta);
		$this->db->where('user_id', $id);		
		$query = $this->db->get();
	    if($query->num_rows() > 0) {
	        
	        return $query->row();
	        
	    }
	    
	    return FALSE;
	}

		

}