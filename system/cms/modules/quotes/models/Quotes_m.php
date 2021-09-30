<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, findmoxie.com
 * @package \System\Application\
 * copyright Copyright (c) 2016, MOXIE.COM
 */

// ------------------------------------------------------------------------

class Quotes_m extends CI_Model
{
	
	protected $_quotes = 'quotes' ;
	
	function __construct()
	{
		parent::__construct();
		
	}
	
	
	public function get($query_array)
	{
		$this->db->select();
		$this->db->from($this->_quotes);
		$this->db->where($query_array);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->row();
		}
		
		return FALSE;
	}
	
	public function community_carousel()
	{
		$this->db->select();
		$this->db->from($this->_quotes);
		$this->db->where(array('is_active' => 1));
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			$data = NULL ;
			
			foreach($query->result() as $r)
			{
				$quotee_title = $r->title ? '<dd>'.$r->title.'</dd>' : '' ;
				$photo = $r->photo ? $r->photo : '';
				
				$data .= '
					<div class="bubble">
					  	<div class="row">
						  	<div class="col-xs-12 col-sm-8">
						  		<blockquote><i class="fa fa-quote-left fa-pull-left"></i>'.strip_tags($r->quote).'<i class="fa fa-quote-right"></i></blockquote>
						  		<dl>
							  		<dt>'.$r->cite.'</dt>
							  			'.$quotee_title.'
						  		</dl>
						  	</div>
						  	<div class="hidden-xs col-sm-4">
							  	<img class="img-responsive" src="/data/quotes/'.$photo.'" />
						  	</div>
					  	</div>
					</div>
				';
			}
			
			return $data;
		}
		
		return FALSE;
	}
	
	
	public function our_community_quote()
	{
		$this->db->select();
		$this->db->from($this->_quotes);
		$this->db->where(array('is_active' => 1));
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$r = $query->row();
			
			$html = '<blockquote>
					'.$r->quote.'
				<footer>'.$r->cite.'</footer>
			</blockquote>';
			
			return $html ;
		}
	}
	
}