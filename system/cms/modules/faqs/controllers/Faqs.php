<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore BluMoo Creative
 * @package System\Cms\Modules\Changeme\Controllers
 * copyright Copyright (c) 2017, BluMoo Creative, LLC
 */

class Faqs extends Public_Controller {

	public function __construct()
	{
		parent::__construct();
	
	}
	
	public function index()
	{
		$array = array(
			'ARTHRITIS-ALL JOINTS' ,
			'RHEUMATOID ARTHRITIS' ,
			'BURSITIS' ,
			'BACK PAIN-NECK TO SPINE' ,
			'BROWN RECLUSE SPIDER BITES' ,
			'CARPAL TUNNEL' ,
			'CRPS' ,
			'EPICONDYLITIS-TENNIS ELBOW' ,
			'FIBROMYALGIA' ,
			'HERNIATED-BULGING DISCS' ,
			'HIP JOINT PAIN' ,
			'KNEE PAIN' ,
			'LYME DISEASE' ,
			'MIGRAINES' ,
			'MYOFASCIAL PAIN' ,
			'NECK PAIN' ,
			'PERIPHERAL NEUROPATHY' ,
			'PLANTAR FASCIITIS' ,
			'SCIATICA' ,
			'SHOULDER PAIN-ROTATOR CUFF' ,
			'SPORTS INJURIES-OLD AND NEW' ,
			'TMJ SYNDROME' ,
			'WOUND HEALING' ,
		);
		
		
		foreach($array as $r)
		{
			$title = ucwords(strtolower($r));
			$uri = strtolower(url_title($r));
			
			$data = array(
				'title' => $title ,
				'uri' => $uri 
			);
						
			$this->db->insert('areas_of_service', $data);
			
		}
		
		echo 'Done!';
	}
}