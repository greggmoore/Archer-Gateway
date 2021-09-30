<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Blog Model
 * @comments	If you do not know what a blog is, you better learn fast!
 *
 * @package		MojoCMS - Get your mojo workin'!
 * @author		Gregg Moore, MSI, WDC, mojoCMS
 * @copyright	Copyright (c) 2013, mojocms.com
 * @license		http://www.mojocms.com/user_guide/license.html
 * @link		http://www.mojocms.com
 * @since		Version 1.0
 * @filesource
 */
// ------------------------------------------------------------------------

class Api_m extends CI_Model
{
	protected $_api_keys = 'api_keys';
	protected $_api_logs = 'api_logs';
	
	function __construct()
	{
		parent::__construct();
		
	}
	
	public function get_all()
	{
		$this->db->select();
		$this->db->from($this->_api_keys);
		$this->db->order_by('client', 'desc'); 
		$query = $this->db->get();
		//make sure results exist
	    if($query->num_rows() > 0) {
	        
	        $data = NULL;
	        
	        $data = '
	        		<section class="panel">
						
						<div class="panel-body">
							<table class="table table-bordered table-striped mb-none" id="datatable-pages">
								<thead>
									<tr>
										<th>#</th>
										<th>Client</th>
										<th class="hidden-xs">Key</th>
										<th class="hidden-xs">Url</th>
										<th class="hidden-xs">IP\'s</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
	        	';
	        foreach($query->result() as $r)
	        {
	        				$data .= '
						        	<tr id="row_'.$r->id.'">
										<td>'.$r->id.'</td>
										<td>'.$r->client.'</td>
										<td class="hidden-xs">'.$r->key.'</td>
										<td class="hidden-xs">'.$r->url.'</td>
										<td class="hidden-xs">'.$r->ip_addresses.'</td>
										<td class="center">
											<a href="/admin/api/edit/'.$r->id.'" class="btn btn-primary btn-sm on-default edit-row"><i class="fa fa-edit"></i> Edit</a>
											<a href="#modalPrimary_'.$r->id.'" class="btn btn-danger btn-sm on-default confirm-delete"><i class="fa fa-trash-o"></i> Delete</a>
										
										</td>
									</tr>
									<div id="modalPrimary_'.$r->id.'" class="modal-block modal-block-primary mfp-hide">
										<section class="panel">
											<header class="panel-heading">
												<h2 class="panel-title">'.$r->client.'</h2>
											</header>
											<div class="panel-body">
												<div class="modal-wrapper">
													<div class="modal-icon">
														<i class="fa fa-question-circle"></i>
													</div>
													<div class="modal-text">
														<h4>Are you sure?</h4>
														<p>Deleting this key will effect all remote services offered..</p>
													</div>
												</div>
											</div>
											<footer class="panel-footer">
												<div class="row">
													<div class="col-md-12 text-right">
														<button class="btn btn-primary modal-confirm" id="'.$r->id.'">Confirm</button>
														<button class="btn btn-default modal-dismiss">Cancel</button>
													</div>
												</div>
											</footer>
										</section>
									</div>
									';
									
	        }
	        
	        $data .='</tbody></table></div></section>';
	        
	        return $data;
	        
	    } else {
	        return '<p>There no api keys in the database to display. <a href="/admin/api/add">Click here to create a new api cleint</a>.</p>';
	    }
	}
	
	
	public function get($data)
	{
		$this->db->select('*');
		$this->db->from($this->_api_keys);
		$this->db->where($data);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->row();
		}
		
		return FALSE;
	}
	
	public function add()
	{
		
	}
	
	
	//Update Content
	function update($id, $data)
	{
		$this->db->where('id', $id);
		if($this->db->update($this->_api_keys, $data))
		{
			return TRUE ;
		}
		
		return FALSE;
	}
	
	
	public function keygen($length=25)
	{
		$key = NULL;
		list($usec, $sec) = explode(' ', microtime());
		mt_srand((float) $sec + ((float) $usec * 100000));
		
	   	$inputs = array_merge(range('z','a'),range(0,9),range('A','Z'));
	
	   	for($i=0; $i<$length; $i++)
		{
	   	    $key .= $inputs{mt_rand(0,61)};
		}
		return strtolower($key);
	}
	
	
	
	public function get_whitelist()
	{
		$this->db->select('ip_address');
		$this->db->where(array('is_active' => 1));
		$query = $this->db->get($this->_api_keys);
		if($query->num_rows() > 0)
		{			
			foreach($query->result() as $r)
			{
				$ips[] = $r->ip_addresses;
			}
			
			
			return implode (", ", $ips);
		}
		
		return FALSE;
	}
	
	
	public function get_client($params)
	{
		$results = array();
		
		$this->db->select();
		$this->db->from($this->_api_keys);
		$this->db->where(array('key' => $params['X-API-KEY']));
		$query = $this->db->get();

		if($query->num_rows() > 0)
		{
			unset($params['X-API-KEY']);
			
			$results = $query->row_array();
			return array_merge($results, $params);			
		}
		
		return FALSE;
	}
	
}