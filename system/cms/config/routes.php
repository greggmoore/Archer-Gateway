<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] 				= 'pages';
$route['(index|home|welcome)']          	= 'pages';
$route['404_override'] = 'pages';




/*
| -------------------------------------------------------------------------
| USERS 'LOGIN' ROUTING
| ------------------------------------------------------------------------
*/
$route['(forgot_password|help|login|logout|password_reset_sent|remove_installer_directory|support)']			    = 'users/$1';

/*
| -------------------------------------------------------------------------
| ADMIN 'DASHBOARD' ROUTING
| -------------------------------------------------------------------------
*/
$route['admin/reset_password/(:any)'] = 'admin/reset_password/$1' ;
$route['admin/help/([a-zA-Z0-9_-]+)']       = 'admin/help/$1';
$route['admin/([a-zA-Z0-9_-]+)/(:any)/(:num)/(:any)/(:any)']	  = '$1/admin/$2/$3/$4/$5';
$route['admin/([a-zA-Z0-9_-]+)/(:any)']	    = '$1/admin/$2';
$route['admin/([a-zA-Z0-9_-]+)/(:any)/(:num)']	  = '$1/admin/$2/$3';

$route['admin/(forgot_password|help|login|logout|password_reset_sent|remove_installer_directory|reset_password|support)']			    = 'admin/$1';

$route['admin/([a-zA-Z0-9_-]+)']            = '$1/admin/index';
$route['admin/index']            			= 'admin/index';
$route['posts/American_War']                     = 'posts';

$route['after-hours-support']                     = 'contact';
$route['(free-consultation|request-consultation|quote|get-a-quote)']                     = 'contact/request_consultation';
//$route['(quote|get-a-quote)']                     = 'contact/quote';
$route['website-analysis']                     = 'contact/website_analysis';

$route['(what-we-do|seo-services|fhv)']                     = 'digital-marketing-services';
$route['(agency)']                     = 'about';
$route['(seo-services)']                     = 'digital-marketing-services';

/*
| -------------------------------------------------------------------------
| BLOG ROUTING
| -------------------------------------------------------------------------
*/

$route['(blog|posts)/category/(:any)'] 			= 'posts/category/$1';
$route['(blog|posts)/author/(:any)'] 				= 'posts/author/$1';

$route['(blog|posts)/author/(:any)/(:num)'] 		= 'posts/author/$1/$2' ;
$route['(blog|posts)/(:num)'] 						= 'posts/index/$1';
$route['(blog|posts)/author/(:any)'] 						= 'posts/author/wci';
$route['(blog|posts)/((?!page).*)'] 				= 'posts/article/$1';
$route['(blog|posts)'] 							= 'posts/index';


/*
| -------------------------------------------------------------------------
| SERVICES
| -------------------------------------------------------------------------
*/

$route['(services)/(:any)'] 			= 'services/index/$1';

/*
| -------------------------------------------------------------------------
| PRODUCTS
| -------------------------------------------------------------------------
*/

$route['(products)/(:any)'] 			= 'products/index/$1';

/*
| -------------------------------------------------------------------------
| JOIN OUR TEAM
| -------------------------------------------------------------------------
*/

$route['join-our-team'] 			= 'contact/join_our_team';

/*
| -------------------------------------------------------------------------
| USER PORTAL
| -------------------------------------------------------------------------
*/

$route['agents']                          	= 'users';
$route['register']                          = 'users/register';
$route['login']                          	= 'users/login';
$route['my-profile']	                    = 'users/index';
$route['edit-profile']	                    = 'users/edit';

$route['rss.xml']                       	= 'sitemap/rss';
$route['sitemap.xml']                       = 'sitemap/xml';
$route['robots.txt']                       	= 'robots.txt';

$route['users/(forgot-password|forget-password|forgot_password|lost-password)']   = 'users/forgot_password';

$route['404']                          		= 'errors/index';
$route['505']                         		= 'errors/index';

$route['translate_uri_dashes'] = FALSE;