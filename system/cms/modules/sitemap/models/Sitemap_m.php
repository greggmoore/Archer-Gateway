<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, findmoxie.com
 * @package \System\Application\
 * copyright Copyright (c) 2016, MOXIE.COM
 */

// ------------------------------------------------------------------------



class Sitemap_m extends CI_Model 
{
	
	protected $_pages = 'pages';
	protected $_posts = 'posts';
	protected $_modules = 'modules';
	protected $_page_categories = 'page_categories';
	
	function __construct()
	{
		parent::__construct();
		
		
	}
	
	
	public function prepare()
	{
		$pages = $this->pages();
		$posts = $this->posts();
		//$programs = $this->programs();
		//team = $pages = $this->team();
				
		$obj_merged = (object) array_merge((array) $pages, (array) $posts);
		return $obj_merged ;
		
	}
	
	
	public function pages()
	{
		
		$html = NULL;
		
		$this->db->select('uri, created_ts, modified_ts');
		$this->db->from($this->_pages);
		$array = array('is_active' => 1, 'uri !=' => 'index');
		$this->db->where($array);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			//return $query->result();
			
			foreach($query->result() as $r)
			{
				
				$uri = $r->uri ;
	
				$link = base_url().$uri ;
				$date = date('Y-m-d', strtotime($r->modified_ts)); 
				
				$html .= '
					<url>
					    <loc>'.$link.'</loc>
					    <lastmod>'.$date.'</lastmod>
					    <priority>0.5</priority>
					</url>
				';
			}
			
			return $html;
		}
		
		return FALSE ;
	}
	
	public function posts()
	{
		$html = NULL;
		
		$this->db->select('uri, created_ts, modified_ts');
		$this->db->from($this->_posts);
		$array = array('is_active' => 1, 'is_external' => 0);
		$this->db->where($array);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			//return $query->result();
			
			foreach($query->result() as $r)
			{

				if(!empty($r->uri))
				{
					$link = base_url().'perspectives/'.$r->uri;
					$date = date('Y-m-d', strtotime($r->modified_ts));
					$html .= '
						<url>
						    <loc>'.$link.'</loc>
						    <lastmod>'.$date.'</lastmod>
						    <priority>0.5</priority>
						</url>
					';
				}
				
			}
			
			return $html;
		}
		
		return FALSE ;
	}
	
	
	public function modules()
	{
		$this->db->select('uri, created_ts, modified_ts');
		$this->db->from($this->_property);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		
		return FALSE ;
	}
	
	
	public function publications()
	{
		$this->db->select('uri, created_ts, modified_ts');
		$this->db->from($this->_property);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		
		return FALSE ;
	}
	
	
	public function rss($character_limiter = 120)
	{
		$rss = NULL;
		
		$this->db->select('content, title, uri, created_ts, modified_ts');
		$this->db->from($this->_posts);
		$array = array('is_active' => 1, 'is_external' => 0);
		$this->db->where($array);
		$this->db->order_by('created_ts', 'DESC');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			//return $query->result();
			
			foreach($query->result() as $r)
			{

				if(!empty($r->uri))
				{
					$link = base_url().'blog/'.$r->uri;
					$pubDate = date('D, d M Y H:i:s T', strtotime($r->created_ts));
					$rss .= '
						<item>
							<title>'.$r->title.'</title>
							<link>'.$link.'</link>
							<description>'.character_limiter(strip_tags($r->content), $character_limiter).'</description>
							<pubDate>'.$pubDate.'</pubDate>
							<guid>'.$link.'</guid>

						</item>
					';
				}
				
			}
			
			return $rss;
		}
		
		return FALSE ;
	}
	
}