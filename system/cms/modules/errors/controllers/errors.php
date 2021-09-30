<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Errors extends Public_Controller {

	/**
	 * The public controller for the Blog module.
	 *
	 * @author		Gregg Moore
	 * @package		Rhino\Core\Modules\Error\Controllers
	 */
	
	public function __construct()
	{
		parent::__construct();
		
		/**
		if (!$this->ion_auth->logged_in())
		{
			//redirect them to the login page
			//redirect('account/login', 'refresh');
		}
		**/		
	}
	
	public function show_404()
	{
		echo '404';
	}
	
	public function show_505()
	{
		echo '505';
	}

}