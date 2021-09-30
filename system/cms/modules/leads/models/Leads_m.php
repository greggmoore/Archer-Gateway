<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, seorets.com
 * @package \System\Application\
 * copyright Copyright (c) 2017, SEORETS.COM
 */

// ————————————————————————————————————

class Leads_m extends CI_Model
{
	
	protected $_table = 'leads';
	protected $_lead_meta = 'lead_meta';
	protected $_assigned_zipcodes = 'assigned_zipcodes';
	protected $_users = 'users';
	protected $_smtp_user = 'api@myrocketlisting.com';
	protected $_smtp_password = 'Blueblue992!';
	protected $_to_email = 'leads@myrocketlisting.com' ; 
	
	function __construct()
	{
		parent::__construct();
		
	}
	
	public function get_all()
	{
		$this->db->select('lm.*, l.created_ts as lead_created, l.id as lead_id, l.city, l.email, l.first_name, l.last_name, l.full_name, l.state, l.street, l.state, u.first_name as u_first_name, u.fullname as u_fullname, u.last_name as u_last_name, u.email as u_email');
		$this->db->from('lead_meta as lm');
		$this->db->join('leads as l', 'l.id = lm.lid');
		$this->db->join('users as u', 'u.id = lm.uid');
		$this->db->order_by("lm.created_ts", "desc");
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$data = NULL ;
			
			foreach($query->result() as $r)
			{
			
				$data .= '
					<tr id="row_'.$r->id.'">
						<td>
							<a href="/admin/leads/details/'.$r->lid.'"><strong>'.$r->street.'</strong></a>
						</td>
						<td>'.$r->state.'</td>
						<td class="hidden-xs">'.$r->u_fullname.'</td>
						<td class="sr-only">'.$r->u_first_name.'</td>
						<td class="sr-only">'.$r->u_last_name.'</td>
						<td class="hidden-xs">
							<a href="/admin/leads/details/'.$r->lid.'"><strong>view</strong></a>
						</td>
					</tr>
				';
			}
			
			return $data ;
		}
		
		return FALSE ;
	}
	
	//Find out where we need to send the lead to
	public function assign_lead($lid)
	{
		$data = $this->get($lid);
		
		if(!empty($data->zipcode))
		{
			
			$uid = 0000 ;
			$to_email = 'api@myrocketlisting.com' ;
			
			$agent = $this->get_agent_by_zipcode($data->zipcode);
			
			if(!empty($agent->id))
			{
				$uid = $agent->id;
				$to_email = $agent->email ;
			}
			
			$array = array(
				'uid' => $uid,
				'lid' => $lid,
				'zpid' => $data->zpid,
				'created_ts' => date('Y-m-d H:i:s')
			);
			
			
			if($this->record_lead_meta($array))
			{
				//Notify Agent
				/**
				$config['protocol'] = "smtp";
				//$config['smtp_crypto'] = 'ssl';
				$config['smtp_host'] = "ssl://smtp.googlemail.com";
				$config['smtp_port'] = 465;
				$config['smtp_user'] = $this->_smtp_user; 
				$config['smtp_pass'] = $this->_smtp_password;
				$config['charset'] = "iso-8859-1";
				$config['mailtype'] = "html";
				$config['newline'] = "\r\n";
				$config['smtp_timeout'] = 5;
				$config['wordwrap'] = TRUE;
				//$config['smtp_auth']   = TRUE;
				**/
				
				$config['protocol']='smtp';
				$config['smtp_host']='mail.blumoocreative.com';
				$config['smtp_port']='26';
				$config['smtp_user']='gregg@blumoocreative.com';
				$config['smtp_pass']='1965Chevy!';
				$config['validate'] = 'false';
				$config['wordwrap'] = TRUE;
				$config['mailtype']="html";
				$config['charset']='utf-8';
				$config['newline']="\r\n";
				$config['crlf'] = "\r\n";
				$config['smtp_timeout']='30';

							
				$this->email->initialize($config);
				
				$this->email->from('gregg@blumoocreative.comm', 'MyRocketListing');
				$this->email->to($this->_to_email);
				$this->email->bcc('gregg.moore23@gmail.com');
				$this->email->subject('MyRocketListing Lead');
				
				if(empty($data->email))
				{
					$message = $this->load->view('email/no_name_lead', $data, true );
				}
					else
				{
					$message = $this->load->view('email/lead', $data, true );
				}
				
				
				$this->email->message($message);
				if($this->email->send())
				{
					return TRUE;
				}
				
				

			}
			
			return TRUE;
			
		}
		
		return FALSE;
	}
	
	
	//Find out where we need to send the lead to
	public function property_not_found_lead($lid)
	{
		$data = $this->get($lid);
		
		$uid = 0000 ;
			$to_email = 'api@myrocketlisting.com' ;
			
			$agent = $this->get_agent_by_zipcode($data->zipcode);
			
			if(!empty($agent->id))
			{
				$uid = $agent->id;
				$to_email = $agent->email ;
			}
			
			$array = array(
				'uid' => 999,
				'lid' => $lid,
				'created_ts' => date('Y-m-d H:i:s')
			);
			
			
			if($this->record_lead_meta($array))
			{
				//Notify Agent
				/**
				$config['protocol'] = "smtp";
				//$config['smtp_crypto'] = 'ssl';
				$config['smtp_host'] = "ssl://smtp.googlemail.com";
				$config['smtp_port'] = 465;
				$config['smtp_user'] = $this->_smtp_user; 
				$config['smtp_pass'] = $this->_smtp_password;
				$config['charset'] = "iso-8859-1";
				$config['mailtype'] = "html";
				$config['newline'] = "\r\n";
				$config['smtp_timeout'] = 5;
				$config['wordwrap'] = TRUE;
				//$config['smtp_auth']   = TRUE;
				**/
				
				$config['protocol']='smtp';
				$config['smtp_host']='mail.blumoocreative.com';
				$config['smtp_port']='26';
				$config['smtp_user']='gregg@blumoocreative.com';
				$config['smtp_pass']='1965Chevy!';
				$config['validate'] = 'false';
				$config['wordwrap'] = TRUE;
				$config['mailtype']="html";
				$config['charset']='utf-8';
				$config['newline']="\r\n";
				$config['crlf'] = "\r\n";
				$config['smtp_timeout']='30';

							
				$this->email->initialize($config);
				
				$this->email->from('gregg@blumoocreative.comm', 'MyRocketListing');
				$this->email->to($this->_to_email);
				$this->email->bcc('gregg.moore23@gmail.com');
				$this->email->subject('MyRocketListing Property Not Found Lead');
				
				$message = $this->load->view('email/property_not_found_lead', $data, true );
				$this->email->message($message);
				if($this->email->send())
				{
					return TRUE;
				}
			}
			
			return TRUE;
	}
	
	
	public function get($id)
	{
		$this->db->select();
		$this->db->from($this->_table);
		$this->db->where(array('id' => $id));
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->row();
		}
					
		return FALSE;
	}
	
	
	// ------------------------------------------------------------------------
	/**
     * Update lead
     *
     * @return <array>
     */
     
	public function update($id = NULL, $data = array())
	{
		$this->db->where('id', $id);
		$this->db->update($this->_table, $data);
		
		return $data;
	}
	
	
	// ------------------------------------------------------------------------
	/**
     * Create New Lead
     *
     * @return <array>
     */
     
	public function register($data = array())
	{
		$this->db->insert($this->_table, $data);
		
		return $this->db->insert_id();
	}
	
	
	
	public function get_agent_by_zipcode($zipcode)
	{
		$this->db->select('az.zipcode, u.fullname, u.email, u.id');
		$this->db->from($this->_assigned_zipcodes.' AS az');
		$this->db->join($this->_users.' AS u', 'u.id = az.uid');
		$this->db->where('az.zipcode', $zipcode);
		
		$query = $this->db->get();
		//make sure results exist
	    if($query->num_rows() > 0) {
	        return $query->row();
	    }
	    
	     return FALSE;	
	}
	
	
	public function record_lead_meta($data)
	{
		if($this->db->insert($this->_lead_meta, $data))
		{
			return TRUE;
		}
		
	return FALSE;
	}
	
	
	public function user_leads($id)
	{
		//$array = array('lm.auth_key' => $key);
		
		$this->db->select('lm.*, l.created_ts as lead_created, l.id as lead_id, l.city, l.email, l.first_name, l.last_name, l.full_name, l.state, l.street, l.state');
		$this->db->from('lead_meta as lm');
		$this->db->where('lm.uid', $id);
		$this->db->join('leads as l', 'l.id = lm.lid');
		$this->db->order_by("lm.created_ts", "desc");
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		
		return FALSE;
	
	}
	
	public function lead_details($id)
	{
		
		
		$this->db->select('lm.*, l.*, l.created_ts as lead_created');
		//$this->db->select('lm.ip_address, lm.user_agent');
		$this->db->from('leads as l') ;
		$this->db->where('l.id', $id);
		$this->db->join('lead_meta as lm', 'lm.lid = l.id');
		
		$q = $this->db->get();
		
		if($q->num_rows() > 0)
		{
			
			$this->load->helper('date');
			
			$data = $q->row();
						
			//$social = $this->format_social($data);
			
			$is_authenticated = $data->is_authenticated == 1 ? 'Yes' : 'No' ;
			$auth_date = $data->is_authenticated == 1 ? date('m/d/Y H:i:s', strtotime($data->auth_ts)) : 'n/a' ;
			
			$created_ts = strtotime($data->created_ts);
			$auth_ts = strtotime($data->auth_ts);
			
			$response_time = timespan($created_ts, $auth_ts);
			
			//Auth Info & Response Time
			$html = '<table class="table details">
						<thead>
							<tr>
								
								<th>Is Authenticated?</th>
								<th>Date Authenticated</th>
								<th>Date Entered</th>
								<th>Response Time</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								
								<td>'.$is_authenticated.'</td>
								<td>'.$auth_date.'</td>
								<td>'.date('m/d/Y H:i:s', strtotime($data->created_ts)).'</td>
								<td>'.$response_time.'</td>
							</tr>
						</tbody>
					</table>';
			
			// Client Contact info
			$html .= '<table class="table table-striped details">
						<thead>
							<tr>
								<th width="200px">Client Contact Info</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Name:</td>
								<td>'.$data->full_name.'</td>
							</tr>
							<tr>
								<td>Email:</td>
								<td>'.safe_mailto($data->email, $data->email).'</td>
							</tr>
							<tr>
								<td>Telephone:</td>
								<td>'.$data->phone.'</td>
							</tr>
						</tbody>
					</table>';	
					
			// Property Location
			$html .= '<table class="table table-striped details">
						<thead>
							<tr>
								<th width="200px">Property Location</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Address:</td>
								<td>'.$data->street.'</td>
							</tr>
							<tr>
								<td>City:</td>
								<td>'.$data->city.'</td>
							</tr>
							<tr>
								<td>State:</td>
								<td>'.$data->state.'</td>
							</tr>
							<tr>
								<td>Zipcode:</td>
								<td>'.$data->zipcode.'</td>
							</tr>

							<tr>
								<td>Lat/Lng:</td>
								<td>'.$data->latitude.'/'.$data->longitude.'</td>
							</tr>
						</tbody>
					</table>';
			
					// Property Value
			$html .= '<table class="table table-striped details">
						<thead>
							<tr>
								<th width="200px">Property Value</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Amount:</td>
								<td>$'.number_format($data->amount).'</td>
							</tr>
							<tr>
								<td>Low End:</td>
								<td>'.number_format($data->low).'</td>
							</tr>
							<tr>
								<td>High End:</td>
								<td>'.number_format($data->high).'</td>
							</tr>
							<tr>
								<td>Percentile:</td>
								<td>'.$data->percentile.'</td>
							</tr>
						</tbody>
					</table>';
			
			//Zillow Data
			
			$zillow_property_details = $data->homedetails ? '<a rel="external" href="'.$data->homedetails.'">view</a>' : 'n/a' ;
			$graphs_data = $data->graphsanddata ? '<a rel="external" href="'.$data->graphsanddata.'">view</a>' : 'n/a' ;
			$comparables = $data->comparables ? '<a rel="external" href="'.$data->comparables.'">view</a>' : 'n/a' ;
			
			$html .= '<table class="table table-striped details">
						<thead>
							<tr>
								<th width="200px">Zillow Info</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Property Details:</td>
								<td>'.$zillow_property_details.'</td>
							</tr>
							<tr>
								<td>Graphs &amp; Data:</td>
								<td>'.$graphs_data.'</td>
							</tr>
							<tr>
								<td>Comparables:</td>
								<td>'.$comparables.'</td>
							</tr>
							
						</tbody>
					</table>';

			
			return $html;
			
		}
	
		return FALSE;
	}

}