<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
http://codeigniter.com/user_guide/libraries/pagination.html
**/

$config['uri_segment'] = 3;
$config['page_query_string'] = FALSE;

//Basic Setup
$config['per_page'] = 4;
$config['num_links'] = 1;
$config['display_pages'] = FALSE;

//Enclosing Markup
$config['full_tag_open'] = '<div class="pagination"><div class="container"><ul>';
$config['full_tag_close'] = '</ul></div></div>';

//First Link
$config['first_link'] = 'First';
$config['first_tag_open'] = '<li>';
$config['first_tag_close'] = '</li>';

//Next
$config['next_link'] = 'Next';
$config['next_tag_open'] = '<li>';
$config['next_tag_close'] = '</li>';

//Previous
$config['prev_link'] = 'Previous';
$config['prev_tag_open'] = '<li>';
$config['prev_tag_cloase'] = '</li>';

//Current
$config['cur_tag_open'] = '<b>';
$config['cur_tag_close'] = '</b>';

//Digit Link
$config['num_tag_open'] = '';
$config['num_tag_close'] = '';

//Last Link
$config['last_link'] = 'Last';
$config['last_tag_open'] = '<li>';
$config['last_tag_close'] = '</li>';

$config['use_page_numbers'] = TRUE;