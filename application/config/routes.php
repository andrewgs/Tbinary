<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "users_interface";
$route['404_override'] = '';

/*************************************************** USERS INTRERFACE ***********************************************/

$route['']					= "users_interface/index";
$route['trade']				= "users_interface/trade";

$route['login']				= "users_interface/login";
$route['logoff']			= "users_interface/logoff";

/************************************************** CLIENT INTRERFACE ***********************************************/

$route['cabinet/profile']			= "clients_interface/profile";

/*************************************************** ADMINS INTRERFACE ***********************************************/

$route['admin-panel/actions/users-list']				= "admin_interface/users_list";
$route['admin-panel/actions/users-list/from']			= "admin_interface/users_list";
$route['admin-panel/actions/users-list/from/:num']		= "admin_interface/users_list";

$route['admin-panel/actions/pages']						= "admin_interface/pages_lang";
$route['admin-panel/actions/pages/lang/:num/new-page']	= "admin_interface/lang_new_page";
$route['admin-panel/actions/pages/lang/:num/page/:num']	= "admin_interface/lang_edit_page";

$route['admin-panel/actions/profile']					= "admin_interface/actions_profile";