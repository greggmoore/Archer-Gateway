<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, findmoxie.com
 * @package \System\Application\
 * copyright Copyright (c) 2016, MOXIE.COM
 */

// ------------------------------------------------------------------------

class Projects_m extends CI_Model
{
	
	protected $_projects = 'projects' ;
	protected $_project_images = 'project_images';
	
	function __construct()
	{
		parent::__construct();
		
	}
	
	public function get_all()
	{
		$this->db->select();
		$this->db->from($this->_projects);
		$this->db->order_by('title', 'desc');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$data = NULL ;
			
			foreach($query->result() as $r)
			{
				$is_home = $r->is_home == 1 ? '<i class="fa fa-home"></i>' : ''; 
				$is_active = $r->is_active == 1 ? 'Active' : 'Not Active' ;
				$data .= '
					<tr id="row_'.$r->id.'">
						<td>
							<a href="/admin/pages/edit/'.$r->id.'"><strong>'.$r->title.'</strong> '.$is_home.'</a>
						</td>
						<td class="status '.$is_active.'"><span>'.$is_active.'</span></td>
						<td class="hidden-xs">'.$r->description.'</td>
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
		
		return FALSE ;
	}
	
	public function get($id)
	{

		$this->db->select();
		$this->db->from($this->_projects);
		$this->db->where(array('id' => $id));
		$this->db->or_where(array('uri' => $id));
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->row();
		}		
			
		return FALSE;
	}

	
	public function projects()
	{
		$this->db->select();
		$this->db->from($this->_projects);
		$this->db->where(array('is_active' => 1));
		$this->db->order_by('title');
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			$data = '<div class="row text-center">';
			foreach($query->result() as $r)
			{
				$img = $this->get_lead_image($r->id);
					$img = $img->filename ? $img->filename : '' ;
				
				$data .= '
				<div class="col-lg-4 col-md-4 col-xs-12">
					<div class="project">
						<a class="d-block mb-4 h-100" href="/projects/'.$r->uri.'" title="'.$r->title.'">
							<img class="img-fluid img-thumbnail" src="/data/projects/'.$img.'" title="" alt="" />
						</a>
						<h4>'.$r->title.'</h4>
					</div>
				</div>';
			}
			
			$data .='</div>';
			
			return $data;
		}
	}
	
	
	
	public function get_lead_image($id)
	{
		$this->db->select();
		$this->db->from($this->_project_images);
		$this->db->where(array('project_id' => $id, 'is_lead' => 1));
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			return $query->row();
		}
		
		return FALSE;
	}
	
	public function get_gallery($id)
	{		
		$this->db->select();
		$this->db->from($this->_project_images);
		$this->db->where(array('project_id' => $id));
		$this->db->order_by('sort_order');
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			$project = $this->get($id);
			
			$data = '<div class="row text-center">';
			
			foreach($query->result() as $r)
			{
				$data .= '
				<div class="col-lg-3 col-md-4 col-xs-6">
					<a data-fancybox="gallery" href="/data/projects/'.$r->filename.'" class="d-block mb-4 h-100" title="Project: '.$project->title.'">
						<img class="img-fluid img-thumbnail" src="/data/projects/'.$r->filename.'" alt="'.$r->description.'">
					</a>
				</div>
				';
			}
			
			$data .= '</div>';
			
			return $data;
		}	
		
	}
	
	
	public function widget()
	{
		$this->db->select();
		$this->db->from($this->_projects);
		$this->db->where(array('is_active' => 1));
		$this->db->order_by('title');
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			$data = '<div class="row text-center">';
			foreach($query->result() as $r)
			{
				$img = $this->get_lead_image($r->id);
					$img = $img->filename ? $img->filename : '' ;
				
				$data .= '
				<div class="col-lg-4 col-md-4 col-xs-12">
					<div class="callout-cards href" data-href="/projects" title="View Project">
						<img src="/data/projects/thumbs/'.$img.'" />
						<div class="content">
							<p>'.$r->title.'</p>
						</div>
					</div>
					<a class="btn btn-primary callout-cards-btn" href="/projects/'.$r->uri.'" title="View Project: '.$r->title.'">view project</a>
				</div>';
			}
			
			$data .='</div>';
			
			return $data;
		}
	}
	
	public function delete_img($filename)
	{
		if($this->db->delete($this->_project_images, array('filename' => $filename)))
		{
			return true;
		}
	}
	
}