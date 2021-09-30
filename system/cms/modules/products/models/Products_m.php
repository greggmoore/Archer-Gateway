<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore BluMoo Creative
 * @package System\Cms\Modules\Changeme\Models
 * copyright Copyright (c) 2019, BluMoo Creative, LLC
 */
// ------------------------------------------------------------------------

class Products_m extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		
	}
	
	public function breadcrumbs($breadcrumb_title)
	{
		$data = '
			<a href="/" title="WCI"> Home<i class="fa fa-angle-right pl-2" aria-hidden="true"></i></a>
			<a href="/products" title="Products">Products<i class="fa fa-angle-right pl-2" aria-hidden="true"></i></a>
			<a href="#" title="'.$breadcrumb_title.'"><span class="activeColor">'.$breadcrumb_title.'</span></a>
		';
		
		return $data;
	}
}