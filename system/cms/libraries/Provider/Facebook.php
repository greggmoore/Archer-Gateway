<?php
/**
 * Facebook OAuth2 Provider
 *
 * @package    CodeIgniter/OAuth2
 * @category   Provider
 * @author     Phil Sturgeon
 * @copyright  (c) 2012 HappyNinjas Ltd
 * @license    http://philsturgeon.co.uk/code/dbad-license
 */

class OAuth2_Provider_Facebook extends OAuth2_Provider
{
	protected $scope = array('offline_access', 'email', 'read_stream');

	public function url_authorize()
	{
		return 'https://www.facebook.com/dialog/oauth';
	}

	public function url_access_token()
	{
		return 'https://graph.facebook.com/oauth/access_token';
	}

	public function get_user_info(OAuth2_Token_Access $token)
	{
		$url = 'https://graph.facebook.com/me?'.http_build_query(array(
			'access_token' => $token->access_token,
		));

		$user = json_decode(file_get_contents($url));
		//print_r($user);
		
		//echo $user->work[0]->employer->name;
		// Create a response from the request
		return array(
			'uid' => $user->id,
			'nickname' => isset($user->username) ? $user->username : null,
			'name' => $user->name,
			'first_name' => $user->first_name,
			'last_name' => $user->last_name,
			'gender' => $user->gender,
			'email' => isset($user->email) ? $user->email : null,
			'location' => isset($user->hometown->name) ? $user->hometown->name : null,
			'description' => isset($user->bio) ? $user->bio : null,
			'image' => 'https://graph.facebook.com/me/picture?type=normal&access_token='.$token->access_token,
			'urls' => array(
			  'Facebook' => $user->link,
			),
			'work' => array(
				'employer' => isset($user->work[0]->employer->name) ? $user->work[0]->employer->name: null,
				'location' => isset($user->work[0]->location->name) ? $user->work[0]->location->name : null,
				'position' => isset($user->work[0]->position->name) ? $user->work[0]->position->name : null,
				'description' => isset($user->work[0]->description) ? $user->work[0]->description : null,
				'start_date' => isset($user->work[0]->start_date) ? $user->work[0]->start_date: null, 
				'end_date' => isset($user->work[0]->end_date) ? $user->work[0]->end_date : null
			),
			'work2' => array(
				'employer' => isset($user->work[1]->employer->name) ? $user->work[1]->employer->name: null,
				'location' => isset($user->work[1]->location->name) ? $user->work[1]->location->name : null,
				'position' => isset($user->work[1]->position->name) ? $user->work[1]->position->name : null,
				'description' => isset($user->work[1]->description) ? $user->work[1]->description : null,
				'start_date' => isset($user->work[1]->start_date) ? $user->work[1]->start_date: null, 
				'end_date' => isset($user->work[1]->end_date) ? $user->work[1]->end_date : null
			),
			'education' => array(
				'school' => isset($user->education[0]->school->name) ? $user->education[0]->school->name: null,
				'type' => isset($user->education[0]->type) ? $user->education[0]->type: null
			),
			'education2' => array(
				'school' => isset($user->education[1]->school->name) ? $user->education[1]->school->name: null,
				'type' => isset($user->education[1]->type) ? $user->education[1]->type: null
			),
			
						
		);
	}
}
