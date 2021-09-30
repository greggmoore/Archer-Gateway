<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, findmoxie.com
 * @package \System\Application\
 * copyright Copyright (c) 2016, MOXIE.COM
 */

// ------------------------------------------------------------------------

class Settings extends Public_Controller {

	public function __construct()
	{
		parent::__construct();
	
	}
	
	public function index()
	{
		echo 'settings';
	}
}