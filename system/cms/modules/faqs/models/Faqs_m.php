<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, findmoxie.com
 * @package \System\Application\
 * copyright Copyright (c) 2016, MOXIE.COM
 */

// ------------------------------------------------------------------------

class Faqs_m extends CI_Model
{
	protected $_faqs = 'faqs';
	protected $_pages = 'pages';
	
	function __construct()
	{
		parent::__construct();
		
	}
	
	
	function add($data = array())
	{
		if($this->db->insert($this->_faqs, $data))
		{
			$page_data = array(
				'status' => 'pending'
			);
			
			$this->db->where('id', $data['page_id']);
			$this->db->update($this->_pages, $page_data);
		}
		
		
		
		return $this->db->insert_id();
	}
	
	//Update Content
	public function update($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->_faqs, $data);
		
		return $data;
	}
	
	public function update_page($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->_pages, $data);
		
		return $data;
	}
	
	//Remove team item
	public function remove($id)
	{
		$this->db->delete($this->_faqs, array('id' => $id));
		if($this->sync_m->sync_table_row($this->_faqs))
		{
			return $this->db->affected_rows();
		}
		
	}
	
	public function get($id)
	{
		$this->db->select();
		$this->db->from($this->_faqs);
		$this->db->where(array('id' => $id));
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			return $query->row();
		}
		
		return FALSE;
	}
	
	public function page_faqs($page_id)
	{
		if(!empty($page_id))
		{
			$this->db->select();
			$this->db->from($this->_faqs);
			$this->db->where(array('page_id' => $page_id, 'is_active' => 1));
			$this->db->order_by('sort_order');
			$query = $this->db->get();
			
			if($query->num_rows() > 0)
			{
				$data = '';
				foreach($query->result() as $r)
				{
					switch($page_id)
					{
						//IDH Mutations
						case 14:
						case 29:
						$data .='
							<section class="faqs">
								<div class="container">
									<div class="row">
										<div class="col-md-10 col-md-offset-1">
											<div class="q"></div>
											<h2>'.$r->question.'</h2>
											'.$r->answer.'
										</div>
									</div>
								</div>
							</section>' ;
						break;
					}
				}
				
				return $data;
			}
			
			return FALSE ;
		}
		
		return FALSE ;
	}
	
	
}