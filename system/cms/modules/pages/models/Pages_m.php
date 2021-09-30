<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, findmoxie.com
 * @package \System\Application\
 * copyright Copyright (c) 2016, MOXIE.COM
 */

// ------------------------------------------------------------------------

class Pages_m extends CI_Model
{
	
	protected $_pages = 'pages';
	protected $_page_categories = 'page_categories' ;
	
	function __construct()
	{
		parent::__construct();
		
	}
	
	
	public function get_home_page()
	{
		$this->db->select();
		$this->db->from($this->_pages);
		$this->db->where(array('is_home' => 1, 'is_active' => 1));
		$this->db->or_where(array('uri' => 'index'));
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->row();
		}
		
		return FALSE ;
		
	}
	
	
	
	public function get($array = array())
	{
		
		
		if(!empty($array))
		{
			//print_r($query_array);
			$this->db->select();
			$this->db->from($this->_pages);
			$this->db->where($array);
			$query = $this->db->get();
			if($query->num_rows() > 0)
			{
				return $query->row();
			}
			
			return FALSE;
		}		
			
		return FALSE;
	}

	public function get_all()
	{
		$this->db->select('id, description, is_home, title, uri, is_active, created_ts, modified_ts');
		$this->db->from($this->_pages);
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
	
	public function get_active()
	{
		$this->db->select('title, uri');
		$this->db->from($this->_pages);
		$this->db->where(array('is_active' => 1));
		$this->db->order_by('title', 'asc');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$data = NULL ;
			
			$data = '<ul class="list-inline mx-auto justify-content-center">';
			foreach($query->result() as $r)
			{
				
				$data .= '<li><a href="/'.$r->uri.'" title="'.$r->uri.'">'.$r->title.'</a></li>';
			}
			
			$data .='</ul>';
			
			return $data ;
		}
		
		return FALSE ;
	}
	
	
	public function admin_side_menu($seg2, $seg3, $seg4)
	{
		
		$this->db->select('id, description, is_home, title, uri, created_ts, modified_ts');
		$this->db->from($this->_pages);
		$this->db->order_by('title', 'asc');
		$query = $this->db->get();
		//<?php echo admin_active_child('blog', $this->uri->segment(2), 'index', $this->uri->segment(3));
		
		if($query->num_rows() > 0)
		{
			$data = '<ul class="sidebar-menu">
						<li'.admin_active_child('pages', $seg2, 'index', $seg3).'><a href="/admin/pages">Manager</a> </li>
	                    <li'.admin_active_child('pages', $seg2, 'add', $seg3).'><a href="/admin/pages/add">Add Page</a> </li>
	                    <hr />
	                    <h3 class="menu-title">Quick Jump</h3>
	                    ' ;
			
			foreach($query->result() as $r)
			{
				$is_home = $r->is_home == 1 ? '<i class="fa fa-home"></i>' : '';
				$is_active = $r->id == $seg4 ? ' class="active"' : '' ; 
				
				$data .= '<li'.$is_active.'><a href="/admin/pages/edit/'.$r->id.'">'.character_limiter($r->title, 40).' '.$is_home.'</a></li>';
			}
			$data .= '</ul>';
			
			return $data;
		}
		
		return FALSE;
	}
	
	function check_uri($uri = NULL)
	{
		
		$this->db->select('uri');
		$this->db->from($this->_pages);
		$this->db->where('uri', $uri);
		
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return TRUE;
		}
		
		return FALSE;
	}

	
	function add($data = array())
	{
		$this->db->insert($this->_pages, $data);
		
		return $this->db->insert_id();
	}
	
	//Update Content
	public function update($id, $data)
	{
		$this->db->where('id', $id);
		if($this->db->update($this->_pages, $data))
		{
			return TRUE;
		}
		
		return FALSE;
	}
	
	//Remove page
	public function remove($id)
	{
		$this->db->delete($this->_pages, array('id' => $id));
		//return $this->db->affected_rows();
		if($this->sync_m->sync_table_row($this->_pages))
		{
			return TRUE ;
		}
	}
	
	
	public function create_production_static($uri)
	{
		if(!empty($uri))
		{
			$static = "
				<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
				
				/**
				 * @author  Gregg Moore, findmoxie.com
				 * @package \System\Application\
				 * copyright Copyright (c) 2016, MOXIE.COM
				 */
				
				// ------------------------------------------------------------------------
				
				?>
				<section id=\"header\">
					<div class=\"header\">
						<?php if(isset(\$title)) echo '<h1>'.\$title.'</h1>'; ?>
						<div class=\"content\">
						<?php if(isset(\$header_content)) echo \$header_content; ?>
						</div>
					</div>
				</section>
			";
			
			/*** PRODUCTION ***/
			
			$path = 'system/cms/modules/pages/views/public/'.$uri.'.php';
			$handle = fopen($path, 'a+') or die("can't open file");
			chmod($path, 0777);
			fwrite($handle, $static);
			fclose($handle);
			
			//CSS
			$csspath = 'system/cms/modules/pages/assets/css/'.$uri.'.css';
			$csshandle = fopen($csspath, 'a+') or die("can't open file");
			chmod($csspath, 0777);
			$cssfile = '';
			fwrite($csshandle, $cssfile);
			fclose($csshandle);
			
			//JS
			$jspath = 'system/cms/modules/pages/assets/js/'.$uri.'.js';
			$jshandle = fopen($jspath, 'a+') or die("can't open file");
			chmod($jspath, 0777);
			$jsfile = '';
			fwrite($jshandle, $jsfile);
			fclose($jshandle);
			
			//END
		}
		
		return TRUE;
	}
	
	
	public function check_and_rewrite_production($o_uri, $n_uri)
	{
		
		if($o_uri != $n_uri)
		{
			
			if(file_exists('system/cms/modules/pages/views/public/'.$o_uri.'.php'))
			{
				rename('system/cms/modules/pages/views/public/'.$o_uri.'.php', 'system/cms/modules/pages/views/public/'.$n_uri.'.php');
			}
			
			
				if(file_exists('system/cms/modules/pages/assets/css/'.$o_uri.'.css'))
			{
				rename('system/cms/modules/pages/assets/css/'.$o_uri.'.css', 'system/cms/modules/pages/assets/css/'.$n_uri.'.css');
			}
			
			if(file_exists('system/cms/modules/pages/assets/js/'.$o_uri.'.js'))
			{
				rename('system/cms/modules/pages/assets/js/'.$o_uri.'.js', 'system/cms/modules/pages/assets/js/'.$n_uri.'.js');
			}
			
		}
	}
	
	public function breadcrumbs($breadcrumb_title)
	{
		$data = '
			<a href="/" title="WCI"> Home<i class="fa fa-angle-right pl-2" aria-hidden="true"></i></a>
			<a href="#" title="'.$breadcrumb_title.'"><span class="activeColor">'.$breadcrumb_title.'</span></a>
		';
		
		return $data;
	}



	
}