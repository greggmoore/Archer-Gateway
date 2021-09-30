<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, findmoxie.com
 * @package \System\Application\
 * copyright Copyright (c) 2016, MOXIE.COM
 */

// ------------------------------------------------------------------------

class Posts_m extends CI_Model
{
	protected $_posts = 'posts';
	protected $_post_meta = 'post_meta';
	protected $_post_categories = 'post_categories' ;
	protected $_users = 'users';
	protected $_comments = 'comments';
	
	function __construct()
	{
		parent::__construct();
		
	}
	
	
	public function get($query_array = array())
	{
		if(!empty($query_array))
		{
			$this->db->select();
			$this->db->from($this->_posts);
			$this->db->where($query_array);
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
		$this->db->select('id, title, uri, created_ts, modified_ts, publication_date');
		$this->db->from($this->_posts);
		$this->db->order_by('title', 'desc');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$data = NULL ;
			
			foreach($query->result() as $r)
			{				
				$categories = $this->post_categories($r->id);
				//echo $r->id;
				
				$data .= '
					<tr id="row_'.$r->id.'">
						<td>
							<a href="/admin/posts/edit/'.$r->id.'"><strong>'.$r->title.'</strong></a>
						</td>
						<td class="hidden-xs">'.$categories.'</td>
						<td class="hidden-xs">'.date('m/d/Y', strtotime($r->publication_date)).'</td>
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
	
	
	
	public function post_categories($id)
	{
		
		$this->db->select('category_id as id');
		$this->db->from('post_meta');
		$this->db->where(array('post_id' => $id));
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
			$data = array();
			foreach($query->result() as $r)
			{
				
				$categories = $this->get_category($r->id);
				$data[] = $categories->title;
			}
			
			//print_r($data);
			
			return implode(', ', $data);
		
		}
		
		return FALSE;
		
	}
	
	
	/**
     * Get all available posts, including comments if any
     *
     * @return <array>
     */
	 
	function get_posts($num = NULL, $offset = NULL, $array = NULL) 
	{
	    // execute query
	    $this->db->select('p.id, p.thumb, p.lead_image, p.thumb_sm, p.uri, p.title, p.content, p.author_id, p.created_ts, u.first_name, u.last_name, u.fullname, u.uri as u_uri');
		$this->db->from($this->_posts.' AS p');
		$this->db->join($this->_users.' AS u', 'u.id = p.author_id');
		
		//$this->db->join('comments', 'comments.id = blogs.id');
		//$this->db->limit(10, 20);
		
		if(!empty($array)) {
			$this->db->where($array);
			$this->db->order_by('p.created_ts', 'desc'); 
		}
		
		$this->db->limit($num, $offset);
		
	    $query = $this->db->get();
	
	    //make sure results exist
	    if($query->num_rows() > 0) {
	        $posts = $query->result();
	    } else {
	        
	        return FALSE;
	    }
	
	    //create array for appended (with comments) posts
	    $appended_posts_array = array();
	
	    foreach ($posts as $post) {
	    	//$post->thumb = $this->first_image($post->content);
	    	/**
		    	if(!empty($post->thumb))
	    	{
	    		$post->thumb = '<img src="'.$post->thumb.'" alt="'.$post->thumb.'" title="'.$post->thumb.'"/>';
	    	}
	    	**/
	        $this->db->where('post_id', $post->id);
	        $query = $this->db->get('comments');
	        
	        if($query->num_rows() > 0) {
	        	$comments = $query->result();
	            $post->comments = $comments;
	        }
	        else {
	            $post->comments = array();
	        }
	
	        $appended_posts_array[] = $post;
	    }
	
	    return $appended_posts_array;
	}


	
	
	
	public function article($uri = NULL)
	{
		
		
		$this->db->select('p.*, u.fullname, u.email, u.bio, u.uri as u_uri');
		$this->db->from($this->_posts.' AS p');
		$this->db->join($this->_users.' AS u', 'p.author_id = u.id');
		$this->db->where(array('p.uri' => $uri));
		$this->db->or_where('p.id', $uri);
		
		$query = $this->db->get();
		
		//print_r(); exit();

		if($query->num_rows() > 0)
		{
			return $query->row();
		}
		
		return FALSE;
		
	}
	
	
	public function get_author_posts($uri, $num = NULL, $offset = NULL)
	{
		
		$this->db->select();
		$this->db->from($this->_users);
		$this->db->where('uri', $uri);
		$this->db->or_where('id', $uri);
		
		$query = $this->db->get();
				
		if ($query->num_rows() > 0)
		{
			$author = new stdClass();
			
			$author->user = $query->row();
			
			$image = $author->user->image ? '<img class="img-responsive avatar" src="/data/users/'.$author->user->image.'" alt="Author, '.$author->user->fullname.'" />' : '' ;
			
			$author->intro = '
			<div class="row">
				<div class="col-md-12">
					<div class="author_content">
						<h3>About '.$author->user->fullname.'</h3>
						<div id="author_text">
							'.$image.'
							<p>'.$author->user->bio.'</p>
							<!--<p>'.anchor('', 'Author Feed', 'title="Author Feed"').'</p>-->
						</div>
					</div>
				</div>
			</div>';			

			
			
			$this->db->select('p.id, p.uri, p.thumb, p.lead_image, p.thumb_sm, p.title, p.content, p.author_id, p.created_ts, u.first_name, u.last_name, u.fullname, u.uri as u_uri');
			$this->db->from($this->_posts.' AS p');
			$this->db->join($this->_users.' AS u', 'u.id = p.author_id');
			$this->db->where(array('p.author_id' => $author->user->id , 'p.is_active' => 1));			
			$this->db->order_by('p.created_ts', 'desc'); 
			
			$this->db->limit($num, $offset);
			
			$query = $this->db->get();
			if ($query->num_rows() > 0)
			{
				$author->posts = $query->result();
			}
		} 
		
		return $author;
	}
	
	
	public function get_author_count($aid = NULL)
	{
		
		$this->db->select('p.id');
		$this->db->from($this->_posts.' AS p');
		$this->db->join($this->_users.' AS u', 'u.id = p.author_id');
		$this->db->where(array('p.is_active' => 1, 'u.uri' => $aid));
		
		$query = $this->db->get();
		
		return $query->num_rows();
		
	}
	
	
	public function get_category($id)
	{
		$this->db->select();
		$this->db->from($this->_post_categories);
		$this->db->where(array('id' => $id));
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->row();
		}
		
		return FALSE ;
	}
	
	
	public function get_categories($id)
	{
		$this->db->select();
		$this->db->from($this->_post_categories);
		$this->db->where(array('id' => $id));
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		
		return FALSE ;
	}
	
	
	public function get_all_categories()
	{
		$this->db->select();
		$this->db->from($this->_post_categories);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		
		return FALSE ;
	}
	
	
	
	public function get_category_posts($cat, $num = NULL, $offset = NULL) 
	{
		$cat = $this->get_category($cat);
		
		$this->db->select('p.id, p.uri, p.title, p.content, p.author_id, p.created_ts, u.first_name, u.last_name, u.fullname, u.uri as u_uri');
		$this->db->from($this->_posts.' AS p');
		$this->db->join($this->_users.' AS u', 'u.id = p.author_id');
		$this->db->join($this->_post_meta.' AS pm', 'pm.post_id = p.id');
		$this->db->where(array('p.is_active' => 1, 'pm.category_id' => $cat->id ));			
		$this->db->order_by('p.created_ts', 'desc');
		
		$this->db->limit($num, $offset);
		
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$category = new stdClass();
			$category->posts = $query->result();
			$category->info = $cat;
			
			return $category;
		}
		
		return FALSE ;
	}
	
	
	public function get_category_count($cat = NULL)
	{
		
		$category = $this->get_category($cat);
		
		$this->db->select('p.id');
		$this->db->from($this->_posts.' AS p');
		$this->db->join($this->_post_meta.' AS pm', 'pm.post_id = p.id');
		$this->db->where(array('p.is_active' => 1, 'pm.category_id' => $category->id ));
	    $query = $this->db->get();
		
		return $query->num_rows() > 0 ? $query->num_rows() : 0 ;
		
	}
	
	
	
	public function get_latest_post($cat_id) 
	{
		
		$this->db->select('p.id, p.uri, p.title, p.content, p.author_id, p.created_ts, u.first_name, u.last_name, u.fullname, u.uri as u_uri');
		$this->db->from($this->_posts.' AS p');
		$this->db->join($this->_users.' AS u', 'u.id = p.author_id');
		$this->db->join($this->_post_meta.' AS pm', 'pm.post_id = p.id');
		$this->db->where(array('p.is_active' => 1, 'pm.category_id' => $cat_id ));			
		$this->db->order_by('p.created_ts', 'desc');

		
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->row();
		}
		
		return FALSE ;
	}
	
	
	
	
	
	/**
     * Grab first image in content
     *
     * @return <array>
     */
     
	public function first_image($content)
	{
		$image = '';
		
		preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);
		
		return ( $matches[0] )? $matches[1][0]:NULL;

	}
	
	
	public function prepare_post($post, $key)
	{
		$noborder = ($key == 0)?' noborder':'';
		$author = ($post->fullname) ? $post->fullname : 'WCI';
		$date = date('M jS Y', strtotime($post->created_ts));
		
		$thumb = $post->thumb ? '
			<div class="single-blog-thumb">
              		<a href="/posts/'.$post->uri.'">
                		<img class="card-img-top rounded-0 img-fluid" src="/data/uploads/'.$post->lead_image.'" alt="'.$post->title.'" title="'.$post->title.'">
						<span class="icon"><i class="fa fa-link"></i></span>
						</a>
			  	</div>
		' : '' ;
		
		$html = '
			<div class="col-md-4 col-lg-4">
	          <div class="single-blog">
					<div class="single-blog-thumb">
						<a href="/posts/'.$post->uri.'">
						<img class="card-img-top rounded-0 img-fluid" src="/data/uploads/'.$post->lead_image.'" alt="'.$post->title.'" title="'.$post->title.'">
						<span class="icon"><i class="fa fa-link"></i></span>
						</a>
					</div>
	            <div class="content">
	              <div class="entry-meta">
	                <div class="author">By <a href="/posts/author/'.$post->u_uri.'" title="view all posts related to '.$author.'">'.$author.'</a></div>
	                <div class="month">
	                  <a href="#">'.$date.'</a>
	                </div>
	              </div>
	              <a href="/posts/'.$post->uri.'" class="entry-title" title="'.$post->title.'">'.character_limiter(strip_tags($post->title), 32).'</a>
	              <p class="entry-content">'.character_limiter(strip_tags($post->content), 200).'</p>
	            </div>
	            <div class="entry-meta-footer">
	              <a href="/posts/'.$post->uri.'" class="read-more" title="'.$post->title.'">Read More <i class="fa fa-angle-right" aria-hidden="true"></i></a>
	            </div>
	          </div>
	        </div>
		';
			
		return $html;
	}
	
	
	
	
	
	public function recent_posts_home($num, $title_limiter = 120, $content_limiter = 200)
	{
		
		$this->db->select();
		$this->db->from($this->_posts);
		$this->db->where(array('is_active' => 1));
		$this->db->order_by('created_ts', 'desc');
		
		$this->db->limit(4);
		
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			
			$data = '';
			
			
			foreach($query->result() as $r)
			{
				$author = 'WCI';
				$date = date('M jS Y', strtotime($r->created_ts));
				
				$data .='
					<div class="single-blog">
	                  <div class="content">
	                    <div class="entry-meta">
	                      <div class="author">
	                        By <a href="/posts/author/wci">'.$author.'</a>
	                      </div>
	                      <div class="month">
	                        <a href="#">'.$date.'</a>
	                      </div>
	                    </div>
	                    <a href="/posts/'.$r->uri.'" class="entry-title">'.character_limiter($r->title, $title_limiter, '...').'</a>
	                    <p class="entry-content">'.character_limiter(strip_tags($r->content), $content_limiter, '...').'</p>
	                  </div>
	                  <div class="entry-meta-footer">
	                    <a href="/posts/'.$r->uri.'" class="read-more">Read More <i class="fa fa-angle-right" aria-hidden="true"></i></a>
	                  </div>
	                </div>
				' ;
			}
			
			return $data;
		}
		
		return FALSE ;
	}
	
	
	public function recent_posts($num, $character_limiter = 120)
	{
		
		$this->db->select();
		$this->db->from($this->_posts);
		$this->db->where(array('is_active' => 1));
		$this->db->order_by('created_ts', 'desc');
		
		$this->db->limit(4);
		
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$data = '';
			
			foreach($query->result() as $r)
			{
				$author = 'WCI';
				$date = date('M jS Y', strtotime($r->created_ts));
				
				$data .='
					
					<div class="recent-block d-flex align-items-center">
		               <a href="/posts/'.$r->uri.'"><img class="mr-3 recent-block-img" src="/data/uploads/'.$r->lead_image.'" alt="'.$r->title.'" title="'.$r->title.'" /></a>
		                <div class="media-body">
		                  <a href="/posts/'.$r->uri.'">
		                    <h6 class="m-0 activeColor recent-blog-date">'.$date.'</h6>
		                    <p class="m-0 recent-blog-title">'.character_limiter(strip_tags($r->title), $character_limiter).'</p>
		                  </a>
		                </div>
		              </div> 
				' ;
			}
			
			return $data;
		}
		
		return FALSE ;
	}
              
              
	
	// ------------------------------------------------------------------------
	/**
     * Update blog post
     *
     * @return <array>
     */
     
	public function update($id = NULL, $data = array())
	{
		$this->db->where('id', $id);
		$this->db->update('posts', $data);
		
		return $data;
	}
	
	
	// ------------------------------------------------------------------------
	/**
     * Create New post
     *
     * @return <array>
     */
     
	public function add($data = array())
	{
		$this->db->insert('posts', $data);
		
		return $this->db->insert_id();
	}
	
	
	
	
	//Remove post
	function remove($id)
	{
		$this->db->delete($this->_posts, array('id' => $id));
		return $this->db->affected_rows();
	}
	
	//Check to see if title exists
	function check_title($uri = NULL)
	{
		$this->db->select('uri');
		$this->db->from($this->_posts);
		$this->db->where('uri', $uri);
		
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return TRUE;
		}
		
		return FALSE;
	}
	
	//Check to see if uri exists
	function check_uri($uri = NULL)
	{
		$this->db->select('uri');
		$this->db->from($this->_posts);
		$this->db->where('uri', $uri);
		
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return TRUE;
		}
		
		return FALSE;
	}
	
	public function prepare_keywords($keywords, $uri)
	{
		if(!empty($keywords))
		{
			
			$keywords = explode(',', $keywords);
			
			$data = '<ul>';
			foreach($keywords as $k)
			{
				$data .= '<li><a href="https://www.'.SITE_DOMAIN.'/posts/'.$uri.'">'.$k.'</a></li>';
			}
			
			$data .= '</ul>';
			
			return $data;
		}
		
		return FALSE;
	}
	
	
	
	public function get_timeago( $ptime )
	{
		$etime = time() - $ptime;
		
		if( $etime < 1 )
		{
		    return 'less than '.$etime.' second ago';
		}
		
		$a = array( 12 * 30 * 24 * 60 * 60  =>  'y',
		            30 * 24 * 60 * 60       =>  'm',
		            24 * 60 * 60            =>  'd',
		            60 * 60             =>  'm',
		            60                  =>  'm',
		            1                   =>  's'
		);
		
		foreach( $a as $secs => $str )
		{
		    $d = $etime / $secs;
		
		    if( $d >= 1 )
		    {
		        $r = round( $d );
		        return $r . ' ' . $str ;
		    }
		}
	}
	
	
	public function admin_side_menu($seg2, $seg3, $seg4)
	{
		
		$this->db->select('id, title, uri, created_ts, modified_ts');
		$this->db->from($this->_posts);
		$this->db->order_by('title', 'asc');
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			$data = '<ul class="sidebar-menu">
						<li'.admin_active_child('posts', $seg2, 'index', $seg3).'><a href="/admin/posts">Manager</a> </li>
	                    <li'.admin_active_child('posts', $seg2, 'add', $seg3).'><a href="/admin/posts/add">Add Post</a> </li>
	                    <hr />
	                    <h3 class="menu-title">Quick Jump</h3>
	                    ' ;
			
			foreach($query->result() as $r)
			{
				$is_active = $r->id == $seg4 ? ' class="active"' : '' ; 
				
				$data .= '<li'.$is_active.'><a href="/admin/posts/edit/'.$r->id.'">'.character_limiter($r->title, 40).'</a></li>';
			}
			$data .= '</ul>';
			
			return $data;
		}
		
		return FALSE;
	}
	
	
	public function categories_array()
	{
		$this->db->select('id, uri, title');
		$this->db->order_by('title');
		$query = $this->db->get('post_categories');
		
		
		if($query->num_rows() > 0){
			
			$data = array();
			foreach($query->result_array() as $r)
			{
				
				$data[$r['id']] = $r['title'];
			}
			
			return $data;
		
		}
		
		return FALSE;
		
	}
	
	
	
	public function selected_categories($id)
	{
		
		$this->db->select('category_id as id');
		$this->db->from('post_meta');
		$this->db->where(array('post_id' => $id));
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
			$data = array();
			foreach($query->result_array() as $r)
			{
				$data[] = $r['id'];
			}
			
			return $data;
		
		}
		
		return FALSE;
		
	}
	
	
	
	
	
	public function set_categories($id, $categories)
	{
		if(!empty($categories))
		{
			$this->db->delete($this->_post_meta, array('post_id' => $id));
			
			foreach($categories as $cat)
			{
				if(!empty($cat))
				{
					$name = $this->get_category($cat);
					
					$data = array(
						'post_id' => $id,
						'category_id' => $cat,
						'uri' => $name->uri
					);
					$this->db->insert($this->_post_meta, $data); 
				}
				
			}
			
			return TRUE;
		}
	}
	
	
	public function get_count()
	{
		$this->db->select();
		$this->db->from($this->_posts);
		$this->db->where(array('is_active' => 1));
		$query = $this->db->get();
		
		return $query->num_rows();
	}
	
	
	public function category_checkbox($id)
	{
		
		$categories = array();
		$categories = $this->posts_m->get_all_categories();
			//print_r($categories); exit();	
		$id = $id ? $id : 0 ;
		
		if(!empty($categories))
		{
			$checkbox = NULL;
			$checked = FALSE;
			foreach($categories as $r)
			{
				$cat_id = $r->id;				
				$checked = $cat_id == $id ? ' checked' : '';
																
				$data = array(
				    'name'        => 'categories[]',
				    'id'          => $r->uri,
				    'value'       => $r->id,
				    'checked'     => $checked
				    );
				
				$checkbox .= form_checkbox($data).'<div class="checkbox"><label for="'.$r->uri.'">'.$r->title.'</label></div>';
			}
			
			return $checkbox;
		}
		
		return FALSE;
		
	}
}