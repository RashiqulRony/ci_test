<?php

defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'main';
//$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['doreenpoweradmin'] = 'doreenpoweradmin/auth';

/*
 * FRONTEND CUSTOM ROUTING
 */
$route['management'] = 'main/management';
$route['about'] = 'main/about';
$route['contactus'] = 'main/contactus';
$route['profile/(:num)'] = 'main/profile/$1';
$route['project'] = 'main/project';
$route['project-details/(:num)'] = 'main/projectDetails/$1';
$route['gallery'] = 'main/gallery';
$route['gallery-details/(:num)'] = 'main/galleryDetails/$1';
$route['sendContactRequest'] = 'main/sendContactRequest';

