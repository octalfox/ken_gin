<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
//$route['members/(:any)'] = 'members/index/$1';
$route['ledger/(:any)'] = 'ledger/index/$1';
$route['ajax/memberajax/details/(:any)'] = 'ajax/MemberAjax/details/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
