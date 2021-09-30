<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, findmoxie.com
 * @package \System\Application\
 * copyright Copyright (c) 2016, MOXIE.COM
 */

// ------------------------------------------------------------------------

class Team_m extends CI_Model
{
	protected $_team = 'team';
	protected $_team_categories = 'team_categories';
	protected $_team_meta = 'team_meta';
	
	function __construct()
	{
		parent::__construct();
		
	}
	
	
	public function get($query_array = array())
	{
		if(!empty($query_array))
		{
			$this->db->select();
			$this->db->from($this->_team);
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
	
	
	public function get_all()
	{
		$this->db->distinct();
		$this->db->select('t.id, t.first_name, t.fullname, t.last_name, t.title, t.uri, c.title as cat_title');
		$this->db->from($this->_team.' as t');
		$this->db->join('team_categories as c', 'c.id = t.cid');
		$this->db->order_by('t.last_name', 'desc');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$data = NULL ;
			
			foreach($query->result() as $r)
			{
				
				$data .= '
					<tr id="row_'.$r->id.'">
						<td>
							<a href="/admin/team/edit/'.$r->id.'"><strong>'.$r->first_name.'</strong></a>
						</td>
						<td>
							<a href="/admin/team/edit/'.$r->id.'"><strong>'.$r->last_name.'</strong></a>
						</td>
						<td>'.$r->uri.'</td>
						<td class="hidden-xs">'.$r->cat_title.'</td>
						<td class="hidden-xs">
							<ul class="table-options">
								<li><a class="remove" href="#myModal" data-toggle="modal" data-id="'.$r->id.'" data-fullname="'.$r->fullname.'" data-target="#myModal"><i class="fa fa-trash confirm-delete"></i></a></li>
							</ul>
						</td>
					</tr>
				';
			}
			
			return $data ;
		}
		
		return FALSE;
	}
	
	
	public function get_by_type($type)
	{
		$this->db->select();
		$this->db->from($this->_team);
		$this->db->where(array('type' => $type, 'is_active' => 1));
		$this->db->order_by('sort_order');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$data = NULL ;
			
			foreach($query->result() as $r)
			{
				
				$data .= '
						<div class="team-item col-12 col-md-6 col-lg-3">
						    <div class="card rounded-0 border-0">
								<div class="team-thumb position-relative">
									<img class="card-img-top" src="/data/uploads/team/'.$r->photo.'" alt="'.$r->fullname.', '.$r->title.'">
									<div class="team-social d-flex">
										<a href="#" class="ct-facebook d-flex justify-content-center align-items-center"> <i class="fa fa-facebook" aria-hidden="true"></i> </a>
										<a href="#" class="ct-twitter d-flex justify-content-center align-items-center"> <i class="fa fa-twitter" aria-hidden="true"></i> </a>
										<a href="#" class="ct-linkedin d-flex justify-content-center align-items-center"> <i class="fa fa-linkedin" aria-hidden="true"></i> </a>
									</div>
								</div>
								<div class="card-body">
									<h5 class="card-title mb-0">'.$r->fullname.'</h5>
									<p class="card-text">'.$r->title.'</p>
								</div>
							</div>
						</div>
				';
			}
			
			return $data ;
		}
		
		return FALSE;
	}
	
	public function get_by_type_full($type)
	{
		$this->db->select();
		$this->db->from($this->_team);
		$this->db->where(array('type' => $type, 'is_active' => 1));
		$this->db->order_by('sort_order');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$data = NULL ;
			
			foreach($query->result() as $r)
			{
				
				$data .= '
						<div class="row">
							<div class="team-item col-md-4">
							    <div class="card rounded-0 border-0">
									<div class="team-thumb position-relative">
										<img class="card-img-top" src="/data/uploads/team/'.$r->photo.'" alt="'.$r->fullname.', '.$r->title.'">
										<div class="team-social d-flex">
											<a href="#" class="ct-facebook d-flex justify-content-center align-items-center"> <i class="fa fa-facebook" aria-hidden="true"></i> </a>
											<a href="#" class="ct-twitter d-flex justify-content-center align-items-center"> <i class="fa fa-twitter" aria-hidden="true"></i> </a>
											<a href="#" class="ct-linkedin d-flex justify-content-center align-items-center"> <i class="fa fa-linkedin" aria-hidden="true"></i> </a>
										</div>
									</div>
									<div class="card-body">
										<h5 class="card-title mb-0">'.$r->fullname.'</h5>
										<p class="card-text">'.$r->title.'</p>
									</div>
								</div>
							</div>
							<div class="team-item col-md-6">
							'.$r->bio.'
							</div>
						</div>
				';
			}
			
			return $data ;
		}
		
		return FALSE;
	}


	
	public function get_member($id)
	{
		$this->db->select();
		$this->db->from($this->_team);
		$this->db->where(array('uri' => $id, 'is_active' => 1));
		$this->db->or_where(array('id' => $id, 'is_active' => 1));
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			return $query->row();
		}
		
		return FALSE;
	}
	
	
	function add($data = array())
	{
		$this->db->insert($this->_team, $data);
		
		return $this->db->insert_id();
	}
	
	//Update Content
	public function update($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->_team, $data);
		
		return $data;
	}
	
	//Remove page
	public function remove($id)
	{
		$this->db->delete($this->_team, array('id' => $id));
		return $this->db->affected_rows();
	}
	
	function check_uri($uri = NULL)
	{
		
		$this->db->select('uri');
		$this->db->from($this->_team);
		$this->db->where('uri', $uri);
		
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return TRUE;
		}
		
		return FALSE;
	}
	
	
	
	public function categories()
	{
		$this->db->select();
		$this->db->from($this->_team_categories);
		$this->db->order_by('title');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$data = array();
			foreach($query->result_array() as $r)
			{
				
				$data[$r['id']] = $r['title'];
			}
			
			return $data;
		}
	}
	
	
	public function get_category($id)
	{
		$this->db->select();
		$this->db->from($this->_team_categories);
		$this->db->where(array('id' => $id));
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			return $query->row();
		}
		
		return FALSE;
	}
	
	
	public function get_all_categories()
	{
		$this->db->select();
		$this->db->from($this->_team_categories);
		$this->db->order_by('title');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$data = NULL ;
			
			foreach($query->result() as $r)
			{
				
				$data .= '
					<tr id="row_'.$r->id.'">
						<td>
							<a href="/admin/team/edit_category/'.$r->id.'"><strong>'.$r->title.'</strong></a>
						</td>
						<td>'.$r->uri.'</td>
						<td class="hidden-xs">
							<ul class="table-options">
								<li><a class="remove" href="#myModal" data-toggle="modal" data-id="'.$r->id.'" data-title="'.$r->title.'" data-target="#myModal"><i class="fa fa-trash confirm-delete"></i></a></li>
							</ul>
						</td>
					</tr>
				';
			}
			
			return $data ;
		}
		
		return FALSE;
	}
	
	
	
	function add_category($data = array())
	{
		$this->db->insert($this->_team_categories, $data);
		
		return $this->db->insert_id();
	}
	
	//Update Content
	public function update_category($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->_team_categories, $data);
		
		return $data;
	}
	
	//Remove page
	public function remove_category($id)
	{
		$this->db->delete($this->_team_categories, array('id' => $id));
		return $this->db->affected_rows();
	}
	
	
	function check_category_uri($uri = NULL)
	{
		
		$this->db->select('uri');
		$this->db->from($this->_team_categories);
		$this->db->where('uri', $uri);
		
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return TRUE;
		}
		
		return FALSE;
	}
	
	
	public function admin_side_menu_categories($current)
	{
		$data = '';
		$is_active = '' ;
		
		$this->db->select();
		$this->db->from($this->_team_categories);
		$this->db->order_by('title');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$data = '<hr /><ul class="sidebar-menu team_categories">' ;
			
			
					foreach($query->result() as $r)
					{
		
						$is_active = $r->id == $current ? ' class="active"' : '' ;
						$data .= '<li'.$is_active.'> <a href="/admin/team/category/'.$r->id.'">'.$r->title.'</a></li>';
					}
					
					$data .= '</ul>';
					
			return $data ;
		}
		
		return FALSE;
	}
	
	
	public function category_select_menu($current = NULL)
	{
			
		$data = '';
		
		$this->db->select();
		$this->db->from($this->_team_categories);
		$this->db->order_by('title');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$selected = empty($current) ? ' selected' : '' ;
			
			$data = '<select class="form-control " id="category_select">
				<option value="/admin/team"'.$selected.'>View All Team</value>
			';
			
			foreach($query->result() as $r)
			{
				$is_active = $r->id == $current ? ' selected' : '' ;
				
				$data .= '<option value="/admin/team/category/'.$r->id.'"'.$is_active.'>'.$r->title.'</option>';
			}
			
			$data .= '</select>';
			
			return $data;
		}	
	}
	

}