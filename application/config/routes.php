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
$route['default_controller'] = 'Site';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// RUTAS PARA SITE
$route['cuestionario/(:any)'] = 'Site/questionnaire/$1';
$route['ofertas/(:any)'] = 'Site/offers/$1';
$route['redirect'] = 'Site/redirect';


// RUTAS PARA ADMIN

$route['login'] = 'Site';
$route['process_login'] = 'Site/login_process';
$route['logout'] = 'Site/process_logout';


$route['admin/login'] = 'Site';
$route['admin/partners'] = 'Admin/partners';
$route['admin/states'] = 'Admin/states';
$route['admin/categories'] = 'Admin/categories';

$route['admin/amounts'] = 'Admin/amounts';
$route['admin/credits'] = 'Admin/credits';
$route['admin/params'] = 'Admin/params';

// PARTNERS
$route['partners'] = 'api/Partner';
$route['partners/(:any)'] = 'api/Partner/$1';

// CATEGORIES 
$route['categories'] = 'api/Category';
$route['categories/(:any)'] = 'api/Category/$1';

// STATES 
$route['states'] = 'api/State';
$route['states/(:any)'] = 'api/State/$1';

// RECORDS 
$route['records'] = 'api/Record';
$route['records/(:any)'] = 'api/Record/$1';

// DOCUMENTS 
$route['documents'] = 'api/Document';
$route['documents/(:any)'] = 'api/Document/$1';

// AMOUNTS 
$route['amounts'] = 'api/Amount';
$route['amounts/(:any)'] = 'api/Amount/$1';

// CREDICTS 
$route['credits'] = 'api/Credit';
$route['credits/(:any)'] = 'api/Credit/$1';
