<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, findmoxie.com
 * @package \System\Application\
 * copyright Copyright (c) 2016, MOXIE.COM
 */

// ------------------------------------------------------------------------

class Testimonials_m extends CI_Model
{
	
	protected $_testimonials = 'testimonials' ;
	
	function __construct()
	{
		parent::__construct();
		
	}
	
	public function testimonials()
	{
		$this->db->select();
		$this->db->from($this->_testimonials);
		$this->db->where(array('is_active' => 1));
		$this->db->order_by('sort_order');
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			$data = '<div id="our-stories" class="owl-carousel">';
			
			foreach($query->result() as $r)
			{
				$cite = $r->cite ? strip_tags($r->cite) : '' ;
				$photo = $r->photo ? '<img class="img-circle" src="/data/testimonials/'.$r->photo .'" alt="'.$r->cite.'" />' : '' ;
				$data .= '
					<div class="item">
						'.$photo.'
						<h4>'.$r->subject.'</h4>
						'.$r->quote.'
						<footer>'.$r->cite.'</footer>
					</div>
				';
			}
			
			$data .= '</div>';
			
			return $data;
		}
		
		return FALSE;
	}
	
	
	
	public function featured_home_page($limit, $word_limiter = 200, $end_chracter = '...')
	{
		$this->db->select();
		$this->db->from($this->_testimonials);
		$this->db->where(array('is_active' => 1, 'is_featured' => 1));
		$this->db->order_by('id', 'RANDOM');
		$this->db->limit($limit);
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{

			$data = '';
			$items = '';
			$indicators = '';
			
			foreach($query->result() as $key => $r)
			{
				$active = $key == 0 ? ' active' : '' ;
				
				$indicators .= '<li data-target="#testimonialCarousel" data-slide-to="'.$key.'" class="'.$active.'"></li>';
				
				$items .= '<div class="carousel-item'.$active.'">
					<blockquote>
						'.word_limiter($r->quote, $word_limiter, $end_chracter).'
						<hr />
						<footer>
							<cite><span>~</span> '.$r->cite.' <span>~</span></cite>
						</footer>
					</blockquote>
				</div>';
				
			}
			
			$data = '<div id="testimonialCarousel" class="carousel slide carousel-fade" data-ride="carousel"><ol class="carousel-indicators">'.$indicators.'</ol><div class="carousel-inner">'.$items.'</div></div>';

			return $data;
		}
		
		return FALSE;
	}
	
	public function aside($limit, $word_limiter = 200, $end_chracter = '...')
	{
		$this->db->select();
		$this->db->from($this->_testimonials);
		$this->db->where(array('is_active' => 1, 'is_featured' => 1));
		$this->db->order_by('id', 'RANDOM');
		$this->db->limit($limit);
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{

			$data = '';
			$items = '';
			$indicators = '';
			
			foreach($query->result() as $key => $r)
			{
				$active = $key == 0 ? ' active' : '' ;
				
				$indicators .= '<li data-target="#testimonialCarousel" data-slide-to="'.$key.'" class="'.$active.'"></li>';
				
				$items .= '<div class="carousel-item'.$active.'">
					<div class="testimonial-callout-bubble">
						'.word_limiter($r->quote, $word_limiter, $end_chracter).'
						<cite class="testimonial-callout-customer"><span>~</span> '.$r->cite.'</cite>
						
					</div>
				</div>';
				
			}
			
			$data = '<div class="widget"><div id="testimonialCarousel" class="carousel slide carousel-fade" data-ride="carousel"><ol class="carousel-indicators">'.$indicators.'</ol><div class="carousel-inner">'.$items.'</div></div></div>';

			return $data;
		}
		
		return FALSE;
	}
	
}