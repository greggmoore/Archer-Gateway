<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, blumoocreative.com
 * @package System\Cms\Modules\Changeme\Models
 * copyright Copyright (c) 2015, BluMoo Creative, LLC
 */

// ------------------------------------------------------------------------

class MY_Composer 
{
    function __construct() 
    {
        include("vendor/autoload.php");
    }
}