<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore BluMoo Creative
 * @package System\Cms\Modules\Changeme\Controllers
 * copyright Copyright (c) 2021, BluMoo Creative, LLC
 */

class Five9 extends Public_Controller {

	public function __construct()
	{
		parent::__construct();
	
	}
	
	public function index()
	{
		//https://www.archergateway.com/api?X-API-KEY=IXFR-SUDO-SWTU-LXAY&phone=555-555-5555&datetime=10/6/2021%201%3A00%20PM%20ET&website=exseevan.com&campaign=direct
		
		$five9 = array(
				'F9domain' => 'somedomain.com' , 
				'F9key' => 'RadicavaID' ,
				'RadicavaID' => '4HwW18gnLp' , 
				'F9list' => 'MTPA Radicava' ,
				'F9updateCRM' => true ,
				'F9TimeFormat' => 'yyyy-MM-dd HH:mm:ss Z'
			);
		/**
		$possible = array(
				'number1' => '(910) 555-1234' ,
				'Call Date' => '10/04/2021',
				'Call Time' => '09:00:00' ,
				'F9TimeToCall' => '2021-10-03 09:00:00 -0400' ,
		);
		**/
		
		$possible = $this->five9_m->get_five9_meta(1);
		
		$post = array(
				'number1' => 'number1' ,
				'Call Date' => 'Call Date',
				'Call Date' => 'Call Date' ,
				'F9TimeToCall' => 'F9TimeToCall' ,
		);
		
		foreach ($possible as $key => $value)
		{
			
		}
		
		//$array = array_merge($five9, $possible);
			
		echo '<pre>';
		//print_r($possible);
	}
}