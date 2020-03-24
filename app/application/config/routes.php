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

$route['get_credits'] = 'Site/get_credits';
$route['get_credits/(:any)'] = 'Site/get_credits/$1';

$route['get_categories'] = 'Site/get_categories';
$route['get_categories/(:any)'] = 'Site/get_categories/$1';

$route['get_amounts'] = 'Site/get_amounts';
$route['get_amounts/(:any)'] = 'Site/get_amounts/$1';

$route['get_documents'] = 'Site/get_documents';
$route['get_documents/(:any)'] = 'Site/get_documents/$1';

$route['get_records'] = 'Site/get_records';
$route['get_records/(:any)'] = 'Site/get_records/$1';

$route['get_states'] = 'Site/get_states';
$route['get_states/(:any)'] = 'Site/get_states/$1';

$route['get_partners'] = 'Site/get_partners';
$route['get_partners/(:any)'] = 'Site/get_partners/$1';

$route['get_codes'] = 'Site/get_codes';
$route['get_codes/(:any)'] = 'Site/get_codes/$1';




// RUTAS PARA ADMIN

$route['login'] = 'Site';
$route['process_login'] = 'Site/login_process';
$route['logout'] = 'Site/process_logout';


$route['check'] = 'Site/check';
$route['admin/login'] = 'Site';
$route['admin/generator'] = 'Admin/generator';
$route['admin/partners'] = 'Admin/partners';
$route['admin/states'] = 'Admin/states';
$route['admin/categories'] = 'Admin/categories';

$route['admin/amounts'] = 'Admin/amounts';
$route['admin/records'] = 'Admin/records';
$route['admin/methods'] = 'Admin/methods';
$route['admin/credits'] = 'Admin/credits';
$route['admin/users'] = 'Admin/users';

$route['admin/upload_image'] = 'Site/uploadImage';

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

// CODES
$route['codes'] = 'api/Codes';
$route['codes/(:any)'] = 'api/Codes/$1';

// DOCUMENTS 
$route['documents'] = 'api/Document';
$route['documents/(:any)'] = 'api/Document/$1';

// AMOUNTS 
$route['amounts'] = 'api/Amount';
$route['amounts/(:any)'] = 'api/Amount/$1';

// CREDICTS 
$route['credits'] = 'api/Credit';
$route['credits/(:any)'] = 'api/Credit/$1';

// METHODS 
$route['methods'] = 'api/Methods';
$route['methods/(:any)'] = 'api/Methods/$1';

$route['users'] = 'api/Users';
$route['users/(:any)'] = 'api/Users/$1';
