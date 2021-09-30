<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, findmoxie.com
 * @package \System\Application\
 * copyright Copyright (c) 2016, MOXIE.COM
 */

// ------------------------------------------------------------------------

class Posts extends Public_Controller {

	public function __construct()
	{
		parent::__construct();
	
	}
	
	
	/**
	 * @package Posts
	 * @function Index/Catch All
	 * @description: Display all articles
	 * @uri
	 */
	
	// ------------------------------------------------------------------------
	
	public function index()
	{
		//echo 'hello'; exit();
		$config['base_url'] = base_url().'/blog/';
		$config['total_rows'] = $this->db->count_all('posts');
		$config['uri_segment'] = 2;
		$this->pagination->initialize($config);
		
		$array = array(
			'id' => 7,
			'is_active' => 1
		);
		
		$data = $this->pages_m->get($array);

		$this->meta_title = $this->module->meta_title ? $this->module->meta_title : 'News &amp; Insights';
				
			$this->meta_info = array(
		        array('name' => 'description', 'content' => $this->module->meta_description ? $this->module->meta_description : NULL ),
		        array('name' => 'author', 'content' => DEFAULT_AUTHOR ? DEFAULT_AUTHOR : NULL )
		    );
		
		$header_img = $data->header_img ? $data->header_img : '' ;
		
		$title = $data->title ? $data->title : '';
		$canonical = '<link rel="canonical" href="https://www.precip.com/blog" />';
		$breadcrumbs = $this->pages_m->breadcrumbs($data->title);
		   
		$data = array(
			'title' => $this->module->title ? $this->module->title : 'Our Posts' ,
			'pretitle' => $this->module->pretitle ? $this->module->pretitle : $data->pretitle ,
			'subtitle' => $this->module->subtitle ? $this->module->subtitle : $data->subtitle ,
			'content' => $this->module->content ? $this->module->content : NULL,
			'css' => css(array('posts.css'), $this->module->uri) ,
			'js' => js(array('posts.js'),  $this->module->uri) ,
			'header_img' => $header_img ,
			'breadcrumbs' => $breadcrumbs ,
			'data' => $data ,
			'canonical' => $canonical
		);
		
		
		$offset = $this->uri->segment($config['uri_segment'], 0) > 0 ? ($this->uri->segment($config['uri_segment'], 0) - 1) * $this->config->item('per_page') : 0 ;
		$array = array(
			'p.is_active' => 1 ,
			//'start_date >= ' => date('Y-m-d')
		);
		
		$data['posts'] = $this->posts_m->get_posts(12, $offset, $array);
		
		$data['partial']  = $this->load->view('public/posts', $data, true);
			$this->load->view($this->public_theme.'/templates/default', $data);
	}

	
	
	/**
	 * @package Posts
	 * @function Article/Post
	 * @description: Author Posts
	 * @uri Segement 3
	 */
	
	// ------------------------------------------------------------------------
 	
	public function post()
	{
		$article = NULL ;
		
		$uri = $this->uri->segment(2);
		
		$article = $this->posts_m->article($uri);
		
		$array = array(
			'id' => 7,
			'is_active' => 1
		);
		
		$data = $this->pages_m->get($array);
		$header_img = $data->header_img ? $data->header_img : 'DSC_5010.jpg' ;
				
		
		if(empty($article))
		{
			//redirect('posts', 'refresh');
		}
		
		$seo = new phpSEO($article->content);
				
		$meta_description = $article->meta_description ? $article->meta_description : $seo->getMetaDescription(160);
		$this->meta_title = $article->title ? $article->title : $this->module->meta_title ;
		
		echo $this->meta_title; die();
		
		$this->meta_info = array(
	        array('name' => 'description', 'content' => $meta_description ? $meta_description : $this->meta_description ),
	        array('name' => 'author', 'content' => $article->fullname ? $article->fullname : DEFAULT_AUTHOR )
	    );
	    
	    $this->meta_title = $article->meta_title ? $article->meta_title : $this->meta_title ;
	    $title = $data->title ? $data->title : '';
		$canonical = '<link rel="canonical" href="https://www.precip.com/posts/'.$uri.'" />';
		$breadcrumbs = $this->pages_m->breadcrumbs($data->title);
		
	    $data = array(
			'css' => css(array('posts.css'), $this->module->uri) ,
			'js' => js(array('posts.js'), $this->module->uri) ,
			'article' => $article ,
			'header_img' => $header_img ,
			'breadcrumbs' => $breadcrumbs ,
			'data' => $data ,
			'canonical' => $canonical
		);
		
		$data['partial']  = $this->load->view('public/post', $data, true);
			$this->load->view($this->public_theme.'/templates/default', $data);
		
		
	}
	
	
	/**
	 * @package Posts
	 * @function Article/Post
	 * @description: Author Posts
	 * @uri Segement 3
	 */
	
	// ------------------------------------------------------------------------
 	
	public function article()
	{
		
		$article = NULL ;
		
		$uri = $this->uri->segment(2);
		//echo $uri; exit();
		
		$article = $this->posts_m->article($uri);
		if(empty($article))
		{
			redirect('posts', 'refresh');
		}
		
		$array = array(
			'id' => 7,
			'is_active' => 1
		);
		
		$data = $this->pages_m->get($array);
		
		
		
		$header_img = $data->header_img ? $data->header_img : 'DSC_5010.jpg' ;
		
		$seo = new phpSEO($article->content);
		$kw = $seo->getKeywords(20);
		$keywords = $this->posts_m->prepare_keywords($kw, $uri);
		$this->ogimage = '';
						
		$meta_description = $article->meta_description ? $article->meta_description : $seo->getMetaDescription(160);
		//$meta_keywords = $article->meta_keywords ? $article->meta_keywords : $seo->getKeyWords(10);
				
		$this->meta_info = array(
	        array('name' => 'description', 'content' => $meta_description ? $meta_description : $this->meta_description ),
	        array('name' => 'author', 'content' => $article->fullname ? $article->fullname : 'Team Agios' )
	    );
	    
	    $this->meta_title = $article->title ? ucwords($article->title) : $this->meta_title ;
	   
	   $title = $article->title ? $article->title : $data->title;
		$canonical = '<link rel="canonical" href="https://www.precip.com/posts/'.$uri.'" />';
		$breadcrumbs = $this->pages_m->breadcrumbs($data->title);
		
		$this->page_url = base_url().'posts/'.$uri ;
			$this->ogimage = $article->lead_image ? $article->lead_image : 'https://www.precip.com/data/screenshots/wci-precip-screenshot.jpg' ;		    
		    
		    $this->open_graph = array(
		        array('property' => 'og:url', 'content' => $this->page_url ) ,
		        array('property' => 'og:title', 'content' => $title ) ,
		        array('property' => 'og:description', 'content' => $meta_description ) ,
		        array('property' => 'og:image', 'content' => 'https://www.precip.com/data/uploads/'.$this->ogimage ) 
		    );
   
	    $data = array(
			'css' => css(array('posts.css'), $this->module->uri) ,
			'js' => js(array('posts.js'), $this->module->uri) ,
			'article' => $article ,
			'header_img' => $header_img ,
			'breadcrumbs' => $breadcrumbs ,
			'data' => $data ,
			'keywords' => $keywords ,
			'canonical' => $canonical
		);
		
		$data['partial']  = $this->load->view('public/post', $data, true);
			$this->load->view($this->public_theme.'/templates/default', $data);
		
		
	}
	
	
	
	/**
	 * @package Posts
	 * @function Author
	 * @description: Author Posts
	 * @uri Segement 3
	 */
	
	// ------------------------------------------------------------------------
 
	public function author()
	{
		
		$data = NULL;		
		
		$uri = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		
		$array = array(
			'id' => 7,
			'is_active' => 1
		);
		
		$data = $this->pages_m->get($array);
			
		
		$config['base_url'] = base_url().'/posts/author/'.$uri.'/';
		$config['total_rows'] = $this->posts_m->get_author_count($uri);
		$config['uri_segment'] = 4;
		
		$this->pagination->initialize($config);
		
		$offset = $this->uri->segment($config['uri_segment'], 0) > 0 ? ($this->uri->segment($config['uri_segment'], 0) - 1) * $this->config->item('per_page') : 0 ;
		
		$author = $this->posts_m->get_author_posts($uri, 4, $offset);
				
		$seo = new phpSEO($data->content);	
		
		$header_img = $data->header_img ? $data->header_img : 'DSC_5010.jpg' ;
		
		$this->meta_title = $author->user->fullname ? 'Posts by '.$author->user->fullname : 'Our Posts';
				
			$this->meta_info = array(
		        array('name' => 'description', 'content' => $data->meta_description ? 'Posts by '.$author->user->fullname.': '.$data->meta_description : NULL ),
		        array('name' => 'author', 'content' => DEFAULT_AUTHOR ? DEFAULT_AUTHOR : NULL )
		    );
		    
		    
		$title = 'Posts by '.$author->user->fullname;    	
		$canonical = '<link rel="canonical" href="https://www.precip.com/posts/author/'.$uri.'" />';
		
		$data = array(
			'title' => $title ? $title : NULL ,
			'content' => NULL,
			'css' => css(array('posts.css'), $this->module->uri),
			'intro' => $author->intro,
			'posts' => $author->posts ,
			'header_img' => $header_img ,
			'data' => $data ,
			'canonical' => $canonical
		);
			
		$data['partial']  = $this->load->view('public/author', $data, true);
			
			$this->load->view($this->public_theme.'/templates/default', $data);
	}
	
	
	
	/**
	 * @package Posts
	 * @function Category
	 * @uri Segement 3
	 */
	
	// ------------------------------------------------------------------------
	
	public function category()
	{
		$data = NULL;		
		
		$uri = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		
		$config['base_url'] = base_url().'/posts/category/'.$uri.'/';
		$config['total_rows'] = $this->posts_m->get_category_count($uri);
		$config['uri_segment'] = 4;
		
		$this->pagination->initialize($config);
		
		$offset = $this->uri->segment($config['uri_segment'], 0) > 0 ? ($this->uri->segment($config['uri_segment'], 0) - 1) * $this->config->item('per_page') : 0 ;
		
		$category = $this->posts_m->get_category_posts($uri, 4, $offset);
		$seo = new phpSEO($category->info->description);
				
		$this->meta_title = $category->info->title ? 'View Posts by Category: '.$category->info->title : 'WCI Company News';
				
		$this->meta_info = array(
	        array('name' => 'description', 'content' => $seo->getMetaDescription(160) ? $seo->getMetaDescription(160) : NULL ) ,
	         array('name' => 'author', 'content' => 'WCI')
	    );
	    
	    $meta_description = $data->meta_description ? $data->meta_description : $seo->getMetaDescription(160);		
		
		$title = $category->info->title ? 'Posts: '.$category->info->title : '' ;    	
		$canonical = '<link rel="canonical" href="https://www.precip.com/posts/category/'.$uri.'" />';
		$data = array(
			'title' => $title ,
			'content' => NULL,
			'css' => css(array('posts.css'), $this->module->uri),
			'description' => $category->info->description,
			'posts' => $category->posts ,
			'canonical' => $canonical
		);

		$data['partial']  = $this->load->view('public/category', $data, true);
			
			$this->load->view($this->public_theme.'/templates/default', $data);
		
	}	
	
	/**
	 * @package Posts
	 * @function Publications
	 */
	
	// ------------------------------------------------------------------------
	
	public function publications()
	{
		
		$config['base_url'] = base_url().'/research/publications/';
		$config['total_rows'] = $this->db->count_all('posts');
		$config['uri_segment'] = 2;
		$this->pagination->initialize($config);
		
		
		$this->meta_title = $this->module->meta_title ? $this->module->meta_title : 'Publications | Research | Agios';
				
			$this->meta_info = array(
		        array('name' => 'description', 'content' => $this->module->meta_description ? $this->module->meta_description : NULL ),
		        array('name' => 'author', 'content' => DEFAULT_AUTHOR ? DEFAULT_AUTHOR : NULL )
		    );
		    
		$data = array(
			'header_title' => '<h1>Research</h1>' ,
			'title' => 'Publications' ,
			'content' => $this->module->content ? $this->module->content : NULL,
			'css' => css(array('news.css'), $this->module->uri) ,
			'js' => js(array('news.js'),  $this->module->uri)
		);
		
		
		$offset = $this->uri->segment($config['uri_segment'], 0) > 0 ? ($this->uri->segment($config['uri_segment'], 0) - 1) * $this->config->item('per_page') : 0 ;
		$array = array(
			'p.is_active' => 1 ,
			//'start_date >= ' => date('Y-m-d')
		);
		
		$data['posts'] = $this->posts_m->get_posts(4, $offset, $array);
		
		$data['partial']  = $this->load->view('public/publications', $data, true);
			$this->load->view($this->public_theme.'/templates/default', $data);
	}
	
	
	/**
	 * @package Posts
	 * @function Press Releases
	 */
	
	// ------------------------------------------------------------------------
	
	public function press_releases()
	{
		
		$config['base_url'] = base_url().'/news/press-releases/';
		$config['total_rows'] = $this->db->count_all('posts');
		$config['uri_segment'] = 2;
		$this->pagination->initialize($config);
		
		
		$this->meta_title = $this->module->meta_title ? $this->module->meta_title : 'Publications | Research | Agios';
				
			$this->meta_info = array(
		        array('name' => 'description', 'content' => $this->module->meta_description ? $this->module->meta_description : NULL ),
		        array('name' => 'author', 'content' => DEFAULT_AUTHOR ? DEFAULT_AUTHOR : NULL )
		    );
		    
		$data = array(
			'header_title' => '<h1>News &amp; Insights</h1>' ,
			'title' => 'Press Releases' ,
			'content' => $this->module->content ? $this->module->content : NULL,
			'css' => css(array('news.css'), $this->module->uri) ,
			'js' => js(array('news.js'),  $this->module->uri)
		);
		
		
		$offset = $this->uri->segment($config['uri_segment'], 0) > 0 ? ($this->uri->segment($config['uri_segment'], 0) - 1) * $this->config->item('per_page') : 0 ;
		$array = array(
			'p.is_active' => 1 ,
			//'start_date >= ' => date('Y-m-d')
		);
		
		$data['posts'] = $this->posts_m->get_posts(4, $offset, $array);
		
		$data['partial']  = $this->load->view('public/press_releases', $data, true);
			$this->load->view($this->public_theme.'/templates/default', $data);
	}
	
	
	public function publication_date()
	{

		$this->db->select('id, created_ts');
		$this->db->from('posts');
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $r)
			{
				
				$data = array(
					'publication_date' => $r->created_ts
				);
				
				$this->db->where('id', $r->id);
				$this->db->update('posts', $data);
				
			
			}
			
			echo 'Done!';
		}
	}
}