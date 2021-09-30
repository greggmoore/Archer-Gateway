<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, findmoxie.com
 * @package \System\Application\
 * copyright Copyright (c) 2016, MOXIE.COM
 */

// ------------------------------------------------------------------------

class Asset 
{
	private $_theme;
	private $_ci;
	
	function __construct()
	{
		$this->_ci =& get_instance();

		$this->_ci->load->config('asset');
	}
	
	// ------------------------------------------------------------------------
	/**
	  * CSS
	  *
	  * Helps generate CSS asset HTML for individial modules.
	  *
	  * @access		public
	  * @param		string    the name of the file or asset
	  * @param		string    optional, module name
	  * @param		string    optional, extra attributes
	  * @return		string    HTML code for JavaScript asset
	  */
	
	function css($asset_name, $module_name = NULL, $attributes = array())
	{
		$attribute_str = $this->_parse_asset_html($attributes);
		
		$an = NULL;
		$css = NULL;
		
		if(!empty($asset_name))
		{
			if(is_array($asset_name))
			{
				foreach($asset_name as $an)
				{
					if(!empty($an))
					{
					$css .= '<link href="'.$this->css_path($an, $module_name).'" rel="stylesheet" type="text/css"'.$attribute_str.' hreflang="en-us" />'."\n";
					}
				}
			}
				else
			{
					$css .= '<link href="'.$this->css_path($asset_name, $module_name).'" rel="stylesheet" type="text/css"'.$attribute_str.' hreflang="en-us" />'."\n";
			}
		}
		return $css;
	}
	
	// ------------------------------------------------------------------------
	/**
	  * CSS
	  *
	  * Helps generate CSS asset HTML for global css.
	  *
	  * @access		public
	  * @param		string    the name of the file or asset
	  * @param		string    optional, module name
	  * @param		string    optional, extra attributes
	  * @return		string    HTML code for JavaScript asset
	  */
	
	function css_global($asset_name, $theme, $attributes = array())
	{
		
		
		$attribute_str = $this->_parse_asset_html($attributes);
		
		$an = NULL;
		$css = NULL;
		
		if(!empty($asset_name))
		{
			if(is_array($asset_name))
			{
				foreach($asset_name as $an)
				{
					
					
					if(!empty($an))
					{
						
						$css .='<link href="'.$this->assets_path($an, $theme).'" rel="stylesheet" type="text/css" hreflang="en-us" />' ;
					}
				}
			}
				else
			{
					$css .= '<link href="'.$this->assets_path($asset_name, $theme).'" rel="stylesheet" type="text/css" hreflang="en-us" />'."\n";
			}
		}
		return $css;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	  * CSS Path
	  *
	  * Generate CSS asset path locations for individual modules.
	  *
	  * @access		public
	  * @param		string    the name of the file or asset
	  * @param		string    optional, module name
	  * @return		string    full url to css asset
	  */
	
	function css_path($asset_name, $module_name = NULL)
	{	
		return '/system/cms/modules/'.$module_name.'/'.config_item('asset_css_dir').$asset_name;
	}
	
	
	// ------------------------------------------------------------------------
	
	/**
	  * Assets Global Path (THEME)
	  *
	  * Generate global CSS asset path locations.
	  *
	  * @access		public
	  * @param		string    the name of the file or asset
	  * @param		string    optional, module name
	  * @return		string    full url to css asset
	  */
	
	function assets_path($asset_name, $theme = NULL)
	{	
		return config_item('asset_dir').$theme.'/assets/'.$asset_name;
	}
	
	
	
	// JAVASCRIPT ------------------------------------------------------------------------
	
	/**
	* JS
	*
	* Helps generate JavaScript asset HTML for individual modules.
	*
	* @access		public
	* @param		string    the name of the file or asset
	* @param		string    optional, module name
	* @return		string    HTML code for JavaScript asset
	*/
	
	function js($asset_name, $module_name = NULL)
	{
		$js = NULL;
		
		if(!empty($asset_name))
		{
			if(is_array($asset_name))
			{
				foreach($asset_name as $an)
				{
					if(!empty($an))
					{
						$js .= '<script type="text/javascript" src="'.$this->js_path($an, $module_name).'"></script>'."\n";
					}
				}
			}
				else
			{
					$js = '<script type="text/javascript" src="'.$this->js_path($asset_name, $module_name).'"></script>'."\n";
			}
			
		}
		
		return $js;
	}
	
	
	/**
	* JS Global
	*
	* Helps generate JavaScript asset HTML for individual modules.
	*
	* @access		public
	* @param		string    the name of the file or asset
	* @param		string    optional, module name
	* @return		string    HTML code for JavaScript asset
	*/

	
	function js_global($asset_name, $theme)
	{
		$js = NULL;
		
		if(!empty($asset_name))
		{
			if(is_array($asset_name))
			{
				foreach($asset_name as $an)
				{
					if(!empty($an))
					{
						$js .= '<script type="text/javascript" src="'.$this->assets_path($an, $theme).'"></script>'."\n";
					}
				}
			}
				else
			{
					$js = '<script type="text/javascript" src="'.$this->assets_path($an, $theme).'"></script>'."\n";
			}
			
		}
		
		return $js;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	  * JS Path
	  *
	  * Helps generate JavaScript asset paths for individul modules.
	  *
	  * @access		public
	  * @param		string    the name of the file or asset
	  * @param		string    optional, module name
	  * @return		string    web root path to JavaScript asset
	  */
	
	function js_path($asset_name, $module_name = NULL)
	{
		return '/system/cms/modules/'.$module_name.'/'.config_item('asset_js_dir').$asset_name;
	}
	
	
	// ------------------------------------------------------------------------
	
	/**
	  * Parse HTML Attributes
	  *
	  * Turns an array of attributes into a string
	  *
	  * @access		public
	  * @param		array		attributes to be parsed
	  * @return		string 		string of html attributes
	  */
	
	function _parse_asset_html($attributes = NULL)
	{
		$attribute_str = '';
			
		if(is_array($attributes))
		{
			foreach($attributes as $key => $value)
			{
				$attribute_str .= ' '.$key.'="'.$value.'"';
			}
			
			return $attribute_str;
		}
	
		return $attributes;
	}

	// ------------------------------------------------------------------------
	
	/**
	  * Set theme
	  *
	  * If you use some sort of theme system, this method stores the theme name
	  *
	  * @access		public
	  * @param		string		theme name
	  */
		
	function set_theme($theme)
	{
		$this->_theme = $theme;
	}
}

// END Asset Class

/* End of file Asset.php */
/* Location: ./application/libraries/Asset.php */