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
$route['admin'] = 'admin/administration/index';
$route['admin/(:any)s'] = 'admin/$1Manager/list$1s';
$route['admin/(:any)s/desc'] = 'admin/$1Manager/list$1s/DESC';
$route['admin/add(:any)'] = 'admin/$1Manager/add$1';
$route['admin/edit(:any)/(:num)'] = 'admin/$1Manager/edit$1/$2';
$route['admin/(:any)/deactivate/(:num)'] = 'admin/$1Manager/set$1Activity/$2/0';
$route['admin/(:any)/activate/(:num)'] = 'admin/$1Manager/set$1Activity/$2/1';
$route['admin/(:any)/delete/(:num)'] = 'admin/$1Manager/delete$1/$2';

$route['annuaire'] = 'client/annuaire';
$route['annuaire/reset'] = 'client/reset';
$route['annuaire/(:num)'] = 'client/annuaire/$1';

$route['orderBy/(company|lastname|firstname|telephone)/(ASC|DESC)'] = 'client/orderBy/$1/$2';
$route['filterBy/(firstname|lastname)'] = 'client/filterBy/$1';
$route['filterBy/initial/([A-Z])'] = 'client/filterBy/initial/$1';

$route['contact/(:num)'] = 'client/contact/$1';

$route['logout'] = 'connection/logout';
$route['(:any)'] = 'connection/login';
$route['default_controller'] = 'connection/login';
$route['404_override'] = 'mainController/error404';
