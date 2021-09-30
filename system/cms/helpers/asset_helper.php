<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, findmoxie.com
 * @package \System\Application\
 * copyright Copyright (c) 2016, MOXIE.COM
 */

// ------------------------------------------------------------------------

function css($asset_name, $module_name = NULL, $attributes = array())
{
	$CI =& get_instance();
	$CI->load->library('asset');
	return $CI->asset->css($asset_name, $module_name, $attributes);
}

function css_global($asset_name, $theme = NULL, $attributes = array())
{
	$CI =& get_instance();
	$CI->load->library('asset');
	return $CI->asset->css_global($asset_name, $theme, $attributes);
}


// ------------------------------------------------------------------------


function js($asset_name, $module_name = NULL)
{
	$CI =& get_instance();
	$CI->load->library('asset');
	return $CI->asset->js($asset_name, $module_name);
}

function js_global($asset_name, $theme = NULL)
{
	$CI =& get_instance();
	$CI->load->library('asset');
	return $CI->asset->js_global($asset_name, $theme);
}
