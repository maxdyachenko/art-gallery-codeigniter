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
$route['remove-selected-images'] = 'gallery_page/delete_selected_images';
$route['delete-all-images/(:num)'] = 'gallery_page/delete_all_images/$1';
$route['delete-image'] = 'gallery_page/delete_image';
$route['gallery/(:num)/upload-image'] = 'gallery_page/upload_image/$1';
$route['gallery/(:num)'] = 'gallery_page/index/$1';
$route['exit'] = 'exit_page/index';
$route['edit-profile/edit-avatar'] = 'edit_profile_page/edit_avatar';
$route['edit-profile/edit-pswd'] = 'edit_profile_page/edit_pswd';
$route['edit-profile/edit-name'] = 'edit_profile_page/edit_name';
$route['edit-profile'] = 'edit_profile_page/index';
$route['create-gallery-form'] = 'gallery_create_page/create_gallery';
$route['create-gallery'] = 'gallery_create_page/index';
$route['delete-gallery'] = 'list_page/delete_gallery';
$route['main'] = 'list_page/index';
$route['verify-email/code/(:any)'] = 'front_page/email_verify/$1';
$route['activate-email'] = 'front_page/email_activate';
$route['register'] = 'front_page/register';
$route['auth'] = 'front_page/auth';
$route['404_override'] = 'errors/page_missing';
$route['default_controller'] = 'front_page/index';
$route['translate_uri_dashes'] = FALSE;
