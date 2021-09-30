<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, findmoxie.com
 * @package \System\Application\
 * copyright Copyright (c) 2016, MOXIE.COM
 */

// ------------------------------------------------------------------------


class Widgets_m extends CI_Model {
	
	protected $_widgets = 'widgets';
	protected $_widget_meta = 'widget_meta';
	protected $_widget_positions = 'widget_positions';
	
	function __construct()
	{
		parent::__construct();
	}
	
	
	public function prepare_widgets($module_id)
	{
		$data = NULL;
		
		$widgets = $this->get_widgets($module_id);
		
		if(!empty($widgets))
		{
			foreach($widgets as $key => $w)
			{
				if(!empty($w))
				{
					$data[$key] = $w;
				}
			}
			
			return $data;
			
		}
		
		return FALSE;
		
	}

	
	public function get_widgets($module_id)
	{
		$this->db->select('position');
		$this->db->from($this->_widget_positions);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $row)
			{
				//print_r($row);
				$postion[$row->position] = $this->build_widget($module_id, $row->position);
			}
			return $postion;
			
		}
	}
	
	public function get_widget($id)
	{
		$this->db->select('*');
		$this->db->from($this->_widgets);
		$array = array('id' => $id);
		$this->db->where($array);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->row();
		}
		
		return FALSE;
	}
	
	
	
	public function default_widgets()
	{
		$this->db->select('position');
		$this->db->from($this->_widget_positions);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $row)
			{
				
				$postion[$row->position] = $this->build_default($row->position);
			}
			
			return $postion;			
		}
	}
	
	public function build_widget($module_id, $position)
	{
		$this->db->distinct();
		$this->db->select('w.uri,wm.sort_order');
		$this->db->from($this->_widgets.' w, '.$this->_widget_meta.' wm');
		$this->db->where("w.id = wm.widget_id and wm.module_id = '{$module_id}' and w.position = '{$position}' and w.is_active = 1");
		$this->db->order_by('wm.sort_order');
		
		//$data = $this->db->get()->result();
		//print_r($data);
		$q = $this->db->get();
		
		if($q->num_rows() > 0)
		{
			foreach($q->result() as $row)
			{
				$data[] = $row;
			}
			
			return $data;
		}
			else
		{
			$this->db->distinct();
			$this->db->select('uri, sort_order');
			$this->db->from($this->_widgets);
			$array = array(
				'position' => $position,
				'is_default' => 1,
				'is_active' => 1
			);
			$this->db->where($array);
			$this->db->order_by('sort_order');
			$q = $this->db->get();
			
			if($q->num_rows() > 0)
			{
				foreach($q->result() as $row){
					$data[] = $row;
				}
				return $data;
			}
			
		}
		
		return FALSE;
	}
	
	public function build_default($position)
	{
		$this->db->distinct();
		$this->db->select('uri');
		$this->db->from($this->_widgets);
		$array = array(
			'position' => $position,
			'is_default' => 1,
			'is_active' => 1
		);
		$this->db->where($array);
		$this->db->order_by('sort_order');
		$q = $this->db->get();
		
		if($q->num_rows() > 0)
		{
			foreach($q->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
		
		return FALSE;
	}

}	