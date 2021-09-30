<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, findmoxie.com
 * @package \System\Application\Menus
 * copyright Copyright (c) 2016, MOXIE.COM
 */

//   ------------------------------------------------------------------------
class Menus_m extends CI_Model {
	
	protected $_menus = 'menus';
	protected $_menu_links = 'menu_links';
	
	function __construct()
	{
		parent::__construct();
		
	}
	
	public function menu($id)
	{
		
		$this->db->select();
		$this->db->from($this->_menus);
		$this->db->where(array('uri' => $id));
		$this->db->or_where('menu_id', $id);
		
		$query = $this->db->get();

		if($query->num_rows() > 0)
		{
			return $query->row();
		}
		
		return FALSE;
		
	}
	
	
	function prepare_menu($menu_id = 1, $current, $seg2 = NULL)
	{
		
		$this->db->select('m.menu_id, m.title as menu_title, m.show_title, m.show_sub_title, m.menu_css, m.navbar_align');
		$this->db->select('ml.link_id, ml.uri, ml.name, ml.title, ml.link_css, ml.hide_me, ml.external, ml.is_phone');
		$this->db->from($this->_menus.' as m');
		$this->db->join($this->_menu_links.' as ml', 'm.menu_id = ml.menu_id');
		$this->db->where('m.is_active', 1);
		$this->db->where('ml.is_active', 1);
		$this->db->where('m.menu_id', $menu_id);
		$this->db->order_by('ml.sort_order');
		
		$query = $this->db->get();
		if($query->num_rows() > 0)
			{
				
				$data = '<ul>';
				foreach($query->result() as $q)
				{					
					$uri = $q->uri ? $q->uri : 'index' ;
					
					//echo $uri ; exit();
					
					$active = ($uri == $current) ? ' active' : '';
					
					$link = ($q->external == 1) ? $uri : '/'.$q->uri ;
					if($q->is_phone == 1)
					{
						$link = 'tel:'.$uri;
					}
					
					//$rel = ($q->external == 1)?'':'';
					$rel = ($q->external == 1)?' rel="external"':'';
					
					
					$class = $q->link_css  ? ' class="'.$active.'" ':'';
					
					$tel = ($q->is_phone == 1)?'tel:':'';
					
					$dd_menu = NULL ;
					$dd_class = NULL ;
					$dd_toggle = NULL ;
					$open = NULL ;
										
					$current2 = !empty($seg2) ? $current.'/'.$seg2 : '' ;
					
					$dd_menu = $this->prepare_submenu($menu_id, $q->link_id, $current2);
					
					$open = ($uri == $current2) ? ' open' : '';
					
				
						
					$dd_class = $dd_menu ? ' drop-right'.$open : '' ;
					$dd_toggle = $dd_menu ? '' : '' ;
					
					$class = (!empty($dd_class) || !empty($active)) ? ' class=" '.$q->link_css.$active.$dd_class.'" ':' '.$q->link_css.'"';
				
					$data .='<li'.$class.'>
							<a '.$dd_toggle.' href="'.$link.'" '.$rel.' title="'.$q->title.'">'.$q->name.'</a>
							'.$dd_menu.'
						</li>';
				}
				
				$data .='</ul>';
				
			return $data;
			}
	}
	
	
	public function prepare_submenu($parent, $link, $current2)
	{
		$this->db->select('m.menu_id, m.title as menu_title, m.menu_css');
		$this->db->select('ml.uri, ml.name, ml.title, ml.external, ml.link_css');
		$this->db->from($this->_menus.' as m');
		$this->db->join($this->_menu_links.' as ml', 'm.menu_id = ml.menu_id');
			$array = array('m.parent_id' => $parent, 'm.link_id' => $link, 'm.is_active' => 1);
			$this->db->where($array);
		
		$this->db->where('ml.is_active', 1);
		$this->db->order_by('ml.sort_order');
		
		$query = $this->db->get();
	
			if($query->num_rows() > 0)
			{
				$link = '';
				$rel = '';
				$uri = '';
				
				$data = '<ul>';
				
				$fa = $parent == 2 ? '' : '' ;
	
				foreach($query->result() as $q)
				{					
					$uri = $q->uri ? $uri : 'index' ;
					$link = ($q->external == 1) ? $q->uri : '/'.$q->uri ;
					$rel = ($q->external == 1)?' rel="external"':'';
					$active = ($q->uri == $current2) ? ' class="active"' : '';
					$data .='<li><a href="'.$link.'" title="'.$q->title.'"'.$rel.'>'.$q->name.'</a></li>';
				}
				$data .='</ul>';
				
				return $data;
			}
		
		return FALSE;
	}
	
	public function footer_menu_old($menu_id, $seg1)
	{
		$this->db->select('m.menu_id, m.title as menu_title, m.show_title, m.show_sub_title, m.menu_css');
		$this->db->select('ml.uri, ml.name, ml.title, ml.link_css, ml.hide_me, ml.external, ml.is_phone');
		$this->db->from($this->_menus.' as m');
		$this->db->join($this->_menu_links.' as ml', 'm.menu_id = ml.menu_id');
		$this->db->where(array('m.is_active' => 1, 'm.menu_id' => $menu_id));
		$this->db->where('ml.is_active', 1);
		$this->db->order_by('ml.sort_order');
		
		$query = $this->db->get();
		if($query->num_rows() > 0)
			{
				
				$meta = $this->menu($menu_id);
				
				$data = '<h5>'.$meta->title.'</h5><ul>';
				foreach($query->result() as $q)
				{
					
					$active = ($q->uri == $seg1)?' active':'';
					
					if(!empty($seg2))
					{
						$active = ($q->uri == $seg2)?' active':'';
					}
					
					$link = ($q->external == 1)?$q->uri:'/'.$q->uri;
					if($q->is_phone == 1)
					{
						$link = 'tel:'.$q->uri;
					}
					
					//$rel = ($q->external == 1) ? '' : '';
					$rel = ($q->external == 1)?' rel="external"':'';
					
					$class = (!empty($q->link_css) || !empty($active))?' class="'.$q->link_css.$active.'" ':'';
					
					$tel = ($q->is_phone == 1)?'tel:':'';
					
					$data .= '<li'.$class.'><a href="'.$link.'" title="'.$q->title.'"'.$rel.'>'.$q->name.'</a></li>';
				}
				
				$data .='</ul>';
				
			return $data;
			}
	}
	
	
	function sidenav($menu_id = 2, $current)
	{
		$this->db->select('m.menu_id, m.title as menu_title, m.show_title, m.show_sub_title, m.menu_css, m.navbar_align');
		$this->db->select('ml.link_id, ml.uri, ml.name, ml.title, ml.link_css, ml.hide_me, ml.external, ml.is_phone');
		$this->db->from($this->_menus.' as m');
		$this->db->join($this->_menu_links.' as ml', 'm.menu_id = ml.menu_id');
		$this->db->where('m.is_active', 1);
		$this->db->where('ml.is_active', 1);
		$this->db->where('m.menu_id', $menu_id);
		$this->db->order_by('ml.name');
		
		$query = $this->db->get();
		if($query->num_rows() > 0)
			{
	
			switch($menu_id)
			{
				case 5:
					$overview_title = 'Services Overview';
					$overview_link = '/services';
					break;
				case 6:
					$overview_title = 'Products Overview';
					$overview_link = '/products';
					break;
			}
				
			$data = $current == 'index' || $current == '' || $current == 'services/services' || $current == 'products/products' ? '<ul><li><a href="'.$overview_link.'" class="active" title="'.$overview_title.'">'.$overview_title.'</a></li>' : '<ul><li><a href="'.$overview_link.'" title="Overview">'.$overview_title.'</li>';
				foreach($query->result() as $q)
				{
					
					$active = ($q->uri == $current || $q->link_id == 1)?'active':'';
					$link = ($q->external == 1)?$q->uri:'/'.$q->uri;
					if($q->is_phone == 1)
					{
						$link = 'tel:'.$q->uri;
					}
					
					$rel = ($q->external == 1)?'':'';
					//$rel = ($q->external == 1)?' rel="external"':'';
					
					$class = !empty($active) ? ' class="'.$active.'" ':'';
					
					
					
					$tel = ($q->is_phone == 1)?'tel:':'';
					
					if($q->hide_me == 1)
					{
						$data .= '<li><a '.$class.' href="'.$link.'" title="'.$q->title.'"'.$rel.'><span class="ym-hideme">'.$q->name.'</span></a></li>';
					}
						else
					{
						$data .= '<li><a '.$class.' href="'.$link.'" title="'.$q->title.'"'.$rel.'>'.$q->name.'</a></li>';
					}
				}
				
				$data .='</ul>';
				
			return $data;
			}
		
	}
	
	
	function footer_menu($menu_id, $current)
	{
		
		$mi = $this->menu($menu_id);
		
		$this->db->select('m.menu_id, m.title as menu_title, m.show_title, m.show_sub_title, m.menu_css, m.navbar_align');
		$this->db->select('ml.link_id, ml.uri, ml.name, ml.title, ml.link_css, ml.hide_me, ml.external, ml.is_phone');
		$this->db->from($this->_menus.' as m');
		$this->db->join($this->_menu_links.' as ml', 'm.menu_id = ml.menu_id');
		$this->db->where('m.is_active', 1);
		$this->db->where('ml.is_active', 1);
		$this->db->where('m.menu_id', $menu_id);
		$this->db->order_by('ml.sort_order');
		
		$query = $this->db->get();
		if($query->num_rows() > 0)
			{
			$data = $mi->title ? '<h5 class="footer-nav-title text-light">'.$mi->title.'</h5>' : '';	
			$data .= $mi->menu_css ? '<ul class="'.$mi->menu_css.'">': '<ul>' ;
				foreach($query->result() as $q)
				{
					
					$active = ($q->uri == $current || $q->link_id == 1)?' active':'';
					$link = ($q->external == 1)?$q->uri:'/'.$q->uri;
					if($q->is_phone == 1)
					{
						$link = 'tel:'.$q->uri;
					}
					
					$rel = ($q->external == 1)?' rel="external"':'';
					
					$class = (!empty($q->link_css) || !empty($active))?' class="'.$q->link_css.$active.'" ':'';
					
					$tel = ($q->is_phone == 1)?'tel:':'';
					
					$data .= '<li'.$class.'><a href="'.$link.'" title="'.$q->title.'"'.$rel.'>'.$q->name.'</a></li>';
				}
				
				$data .='</ul>';
				
			return $data;
			}
		
	}
	
	
	function social_links($menu_id, $current)
	{
		
		$mi = $this->menu($menu_id);
		
		$this->db->select('m.menu_id, m.title as menu_title, m.show_title, m.show_sub_title, m.menu_css, m.navbar_align');
		$this->db->select('ml.link_id, ml.uri, ml.name, ml.title, ml.fa_class, ml.link_css, ml.hide_me, ml.external, ml.is_phone');
		$this->db->from($this->_menus.' as m');
		$this->db->join($this->_menu_links.' as ml', 'm.menu_id = ml.menu_id');
		$this->db->where('m.is_active', 1);
		$this->db->where('ml.is_active', 1);
		$this->db->where('m.menu_id', $menu_id);
		$this->db->order_by('ml.sort_order');
		
		$query = $this->db->get();
		if($query->num_rows() > 0)
			{
				
			$data = $mi->show_title == 1 ? '<h3>'.$mi->title.'</h3>' : '' ;
			
				foreach($query->result() as $q)
				{
					
					$active = ($q->uri == $current || $q->link_id == 1)?' active':'';
					$link = ($q->external == 1)?$q->uri:'/'.$q->uri;
					if($q->is_phone == 1)
					{
						$link = 'tel:'.$q->uri;
					}
					
					$rel = ($q->external == 1)?' rel="external"':'';
					
					$class = (!empty($q->link_css) || !empty($active))?' class="'.$q->link_css.$active.'" ':'';
					
					$tel = ($q->is_phone == 1)?'tel:':'';
					
					$data .= '<a '.$class.' href="'.$link.'" title="'.$q->title.'"'.$rel.'><i class="fa '.$q->fa_class.'"></i></a>';
				}
								
			return $data;
			}
		
	}
	
	
	
	public function copyright_menu($menu_id, $seg1, $seg2)
	{
		$this->db->select('m.menu_id, m.title as menu_title, m.show_title, m.show_sub_title, m.menu_css, m.navbar_align');
		$this->db->select('ml.link_id, ml.uri, ml.name, ml.title, ml.link_css, ml.hide_me, ml.external, ml.is_phone');
		$this->db->from($this->_menus.' as m');
		$this->db->join($this->_menu_links.' as ml', 'm.menu_id = ml.menu_id');
		$this->db->where('m.is_active', 1);
		$this->db->where('ml.is_active', 1);
		$this->db->where('m.menu_id', $menu_id);
		$this->db->order_by('ml.sort_order');
		
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$uri = $active = $link = $class = $current2 = '';
			
			$data = '<ul class="copyright list-inline">
						<li>&copy; '.date('Y').' RasaLove.com. All rights reserved.</li>
			';
			
			foreach($query->result() as $q)
			{
				$uri = $q->uri ? $q->uri : 'index' ;
				$active = ($q->uri == $seg1)?' active':'';
					
					if(!empty($seg2))
					{
						$active = ($q->uri == $seg2)?' active':'';
					}
					
				$link = ($q->external == 1) ? $q->uri : '/'.$q->uri;
				$rel = ($q->external == 1) ? ' rel="external"' : '';
				$class = $q->link_css ? ' class="'.$q->link_css.$active.'" ':'';
				
				$current2 = $seg2 ? $seg1.'/'.$seg2 : '' ;
				
				$data .='<li'.$active.'><a href="'.$link.'" title="'.$q->title.'"'.$rel.'>'.$q->name.'</a></li>';
			}
			
			$data .= '</ul>';
			
			
			return $data;
		}
		
		return FALSE;
	}
}	