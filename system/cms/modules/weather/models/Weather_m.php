<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, findmoxie.com
 * @package \System\Application\
 * copyright Copyright (c) 2016, MOXIE.COM
 */

// ------------------------------------------------------------------------

use Cmfcmf\OpenWeatherMap;
use Cmfcmf\OpenWeatherMap\Exception as OWMException;


class Weather_m extends CI_Model
{
	protected $_weather_api = 'b22bede198def4f64ea189b7ddbf64fa';
	protected $_weather = 'weather' ;
	
	var $zip_code = '28451';
	var $recorded_at;
	var $timestamp;
	var $temp;
	var $conditions;
	
	
	function __construct()
	{
		parent::__construct();
		if ($this->ion_auth->logged_in())
		{
			$this->getLatest();
		}
	}
	
	public function getLatest(){
		
		$this->loadFromDatabase();
		
		
		
	}
	
	public function loadFromDatabase()
	{
		$this->db->select();
		$this->db->from($this->_weather);
		$this->db->where(array('uid' => 1));
		//$this->db->where(array('uid' => UID));
		$this->db->order_by('timestamp','desc');
		$query = $this->db->get();
	
		if($query->num_rows() > 0)
		{			
			$myWeather = $query->row();
			
			ci()->humidity = $this->humidity = $myWeather->humidity ? $myWeather->humidity : '' ;			
			ci()->temp_current = $this->temp_current = $myWeather->temp_current ? $myWeather->temp_current : 0 ;
			$this->conditions = $myWeather->conditions ? $myWeather->conditions : '' ;
			$this->recorded_at = $myWeather->recorded_at ? $myWeather->recorded_at : '';
			$this->timestamp = $myWeather->timestamp ? $myWeather->timestamp : '' ;
			ci()->wind_speed = $this->wind_speed = $myWeather->wind_speed ? $myWeather->wind_speed : '' ;
			ci()->wind_direction = $this->wind_direction = $myWeather->wind_direction ? $myWeather->wind_direction : '' ;
		}
			else
		{
			$this->fetchAndStoreWeather();
		} 
	}
	
	public function fetchAndStoreWeather()
	{
		$lang = 'en';
		$units = 'imperial';
		$owm = new OpenWeatherMap($this->_weather_api);

		try {
			$weather = $owm->getWeather('Wilmington NC', $units, $lang);
		} catch(OWMException $e) {
		    echo 'OpenWeatherMap exception: ' . $e->getMessage() . ' (Code ' . $e->getCode() . ').';
		} catch(\Exception $e) {
		    echo 'General exception: ' . $e->getMessage() . ' (Code ' . $e->getCode() . ').';
		}
		//echo $weather->temperature->getValue();
		
		$array = array(
			'uid' => 1 ,
			'city' => $weather->city->name ,
			'clouds' => $weather->clouds->getDescription() ,
			'conditions' => '' ,
			'humidity' => $weather->humidity ,
			'precipation' => $weather->precipitation->getDescription() ,
			'pressure' => $weather->pressure ,
			'recorded_at' => '' ,
			'sunrise' => $weather->sun->rise->format('r') ,
			'sunset' => $weather->sun->set->format('r') ,
			'temp_current' => $weather->temperature->getValue() ,
			'temp_max' => $weather->temperature->max->getValue() ,
			'temp_min' => $weather->temperature->min->getValue() ,
			'wind_direction' => $weather->wind->direction ,
			'wind_speed' => $weather->wind->speed
			
		);
		$this->db->insert('weather', $array);
		
		$this->loadFromDatabase();		
	}
	
	

}