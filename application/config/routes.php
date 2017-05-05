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
$route['admin'] = 'administration/index';

$route['admin/users'] = 'administration/listUsers';
$route['admin/addUser'] = 'administration/addUser';
$route['admin/editUser/(:any)'] = 'administration/editUser/$1';
$route['admin/user/deactivate/(:num)'] = 'administration/setUserActivity/$1/0';
$route['admin/user/activate/(:num)'] = 'administration/setUserActivity/$1/1';
$route['admin/user/delete/(:num)'] = 'administration/deleteUser/$1';

$route['admin/functions'] = 'administration/listFunctions';
$route['admin/addFunction'] = 'administration/addFunction';
$route['admin/editFunction/(:any)'] = 'administration/editFunction/$1';
$route['admin/function/deactivate/(:num)'] = 'administration/setFunctionActivity/$1/0';
$route['admin/function/activate/(:num)'] = 'administration/setFunctionActivity/$1/1';

$route['admin/addContact'] = 'administration/addContact';
$route['admin/editContact/(:any)'] = 'administration/editContact/$1';
$route['admin/contact/deactivate/(:num)'] = 'administration/setContactActivity/$1/0';
$route['admin/contact/activate/(:num)'] = 'administration/setContactActivity/$1/1';
$route['admin/contact/delete/(:num)'] = 'administration/deleteContact/$1';

$route['annuaire'] = 'client/annuaire';
$route['annuaire/([A-Z])'] = 'client/annuaire/initial/$1';
$route['annuaire/lastname'] = 'client/annuaire/lastname';
$route['annuaire/firstname'] = 'client/annuaire/firstname';
$route['contact/(:num)'] = 'client/contact/$1';

$route['logout'] = 'connection/logout';
$route['(:any)'] = 'connection/login';
$route['default_controller'] = 'connection/login';
