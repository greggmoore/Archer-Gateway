<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, findmoxie.com
 * @package \System\Application\
 * copyright Copyright (c) 2016, MOXIE.COM
 */

// ------------------------------------------------------------------------

class Team extends Public_Controller {

	
	public function __construct()
	{
		parent::__construct();
			
	}
	
	public function index()
	{
		
		$array = array(
			'id' => 10,
			'is_active' => 1
		);
		
		
		$data = $this->pages_m->get($array);
				
		$this->column_layout = $data->column_layout ? $data->column_layout : $this->column_layout ;
		
		$this->meta_info = array(
	        array('name' => 'description', 'content' => $data->meta_description ? $data->meta_description : $this->meta_description ),
	        array('name' => 'author', 'content' => 'Editas Medicine')
	    );
	    
	    $this->meta_title = $data->meta_title ? $data->meta_title : $this->meta_title ;
		
		$title = $data->title ? $data->title : '';
				
		$data = array(
			'title' => $data->display_title == 1 ? $data->title : $data->title ,
			'content' => $data->content,
			'section2' => $data->section_2,
			'section3' => $data->section_3,
			'section4' => $data->section_4,
			'header_content' => $data->header_content,
			'css' => css(array('team.css'), $this->module->uri),
			'js' => js(array('team.js'), $this->module->uri) ,
			'display_subheader' => $data->display_subheader
		);
		
		$data['partial']  = $this->load->view('public/team', $data, true);
			$this->load->view($this->public_theme.'/templates/default', $data);
	}
	
	public function member()
	{
		$array = array(
			'id' => 10,
			'is_active' => 1
		);
		
		$member_uri = $this->uri->segment(2);
		
		$data = $this->pages_m->get($array);
		$member = $this->team_m->get_member($member_uri);
				
		$this->column_layout = $data->column_layout ? $data->column_layout : $this->column_layout ;
		
		$this->meta_info = array(
	        array('name' => 'description', 'content' => $data->meta_description ? $data->meta_description : $this->meta_description ),
	        array('name' => 'author', 'content' => 'Editas Medicine')
	    );
	    
	    $this->meta_title = $data->meta_title ? $data->meta_title : $this->meta_title ;
		
		$title = $data->title ? $data->title : '';
		
		
		$data = array(
			'title' => $data->display_title == 1 ? $data->title : $data->title ,
			'content' => $data->content,
			'header_content' => $data->header_content,
			'css' => css(array('team.css', 'member.css'), $this->module->uri),
			'js' => js(array('team.js'), $this->module->uri) ,
			'display_subheader' => $data->display_subheader ,
			'member' => $member
		);
		
		$data['partial']  = $this->load->view('public/member', $data, true);
			$this->load->view($this->public_theme.'/templates/default', $data);
	}
	
	public function members()
	{
		echo 'team member categories';
	}
	
	
	public function get_modal()
	{
		$response = 0;
		$html = '';
		
		if($this->input->is_ajax_request())
		{
			$id = $this->input->post('id');
			$cid = $this->input->post('cid');
			
			$html = $this->team_m->get_modal($id, $cid);
						
			$response = 1;
			
			echo json_encode(array('response' => $response, 'html' => $html));
		}
		
		exit();
	}
}