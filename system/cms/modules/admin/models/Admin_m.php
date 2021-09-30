<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, findmoxie.com
 * @package \System\Application\
 * copyright Copyright (c) 2016, MOXIE.COM
 */

// ------------------------------------------------------------------------


class Dashboard_m extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		
	}
	
	
	public function last_30_days()
	{
		
		$this->db->select('*');
		$this->db->from($this->_analytics);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0)
		{
			return $query->last_row();
		}
			else
		{
			FALSE;
		}
	}
	
	
	public function moxienews()
	{
		$api_config = array('server' => 'http://www.blumoocreative.com/api/');
		$this->rest->initialize($api_config);
        $this->rest->format('application/json');
        
        $params = array(
			'X-API-KEY'  => 'sr6ymhkotqmv997x2casit40e' ,
			'limit' => 5
		);
		
		$moonews = $this->rest->get('posts', $params, 'json');
		
		if($moonews)
		{
			return $moonews ;
		}
		
		return FALSE ;
	}
	
	
	public function moonews_dashboard($news)
	{
		$html = NULL ;
		
		if(!empty($news))
		{
			
			foreach($news as $n)
			{
				
				$html .= '
					<tr>
						<td><a href="http://www.blumoocreative.com/news/'.$n->uri.'" title="'.$n->title.'" rel="external">'.$n->title.'</a> - <em>'.$this->time_elapsed_string($n->created_ts).'</em></td>
					</tr>';
			}
			
			return $html ;
		}
		
		return '
			<tr>
				<td>No recent <strong>MooNews<strong> to report at this time. Please check back later. Moooo!</td>
			</tr>';
	}

	
	public function moonews_left_column($news)
	{
		
		$html = NULL ;
		
		if(!empty($news))
		{
			$html = '<ul class="list-unstyled m-none">' ;
			
			foreach($news as $n)
			{
				$html .= '<li><a href="http://www.blumoocreative.com/news/'.$n->uri.'" title="'.$n->title.'" rel="external">'.$n->title.'</a></li>';
			}
			
			$html .= '<li class="moonews"><a href="http://www.blumoocreative.com/news" title="BluMoo News!" rel="external">More MooNews!</a></li></ul>' ;
			
			return $html ;
		}
		
		return FALSE;
	}
	
	
	function time_elapsed_string($datetime, $full = false) {
		$today = time();    
         $createdday= strtotime($datetime); 
         $datediff = abs($today - $createdday);  
         $difftext="";  
         $years = floor($datediff / (365*60*60*24));  
         $months = floor(($datediff - $years * 365*60*60*24) / (30*60*60*24));  
         $days = floor(($datediff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));  
         $hours= floor($datediff/3600);  
         $minutes= floor($datediff/60);  
         $seconds= floor($datediff);  
         //year checker  
         if($difftext=="")  
         {  
           if($years>1)  
            $difftext=$years." years ago";  
           elseif($years==1)  
            $difftext=$years." year ago";  
         }  
         //month checker  
         if($difftext=="")  
         {  
            if($months>1)  
            $difftext=$months." months ago";  
            elseif($months==1)  
            $difftext=$months." month ago";  
         }  
         //month checker  
         if($difftext=="")  
         {  
            if($days>1)  
            $difftext=$days." days ago";  
            elseif($days==1)  
            $difftext=$days." day ago";  
         }  
         //hour checker  
         if($difftext=="")  
         {  
            if($hours>1)  
            $difftext=$hours." hours ago";  
            elseif($hours==1)  
            $difftext=$hours." hour ago";  
         }  
         //minutes checker  
         if($difftext=="")  
         {  
            if($minutes>1)  
            $difftext=$minutes." minutes ago";  
            elseif($minutes==1)  
            $difftext=$minutes." minute ago";  
         }  
         //seconds checker  
         if($difftext=="")  
         {  
            if($seconds>1)  
            $difftext=$seconds." seconds ago";  
            elseif($seconds==1)  
            $difftext=$seconds." second ago";  
         }  
         return $difftext;  
	}
	
	
	public function pending_records()
	{
		
		$modules = array(
			'careers'
		);
		
	}
	
}