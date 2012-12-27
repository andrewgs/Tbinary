<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "users_interface";
$route['404_override'] = '';

/************************************************** CLIENT INTRERFACE ***********************************************/

$route['cabinet/balance']	= "clients_interface/balance";
$route['cabinet/portfolio']	= "clients_interface/portfolio";
$route['cabinet/profile']	= "clients_interface/profile";

/*************************************************** ADMINS INTRERFACE ***********************************************/

$route['admin-panel/actions/users-list']						= "admin_interface/users_list";
$route['admin-panel/actions/users-list/from']					= "admin_interface/users_list";
$route['admin-panel/actions/users-list/from/:num']				= "admin_interface/users_list";

$route['admin-panel/actions/users/edit/id/:num']				= "admin_interface/user_edit";
$route['admin-panel/actions/users/delete/id/:num']				= "admin_interface/user_delete";

$route['admin-panel/actions/pages']								= "admin_interface/pages_lang";
$route['admin-panel/actions/pages/lang/:num/new-page']			= "admin_interface/lang_new_page";
$route['admin-panel/actions/pages/lang/:num/page/:num']			= "admin_interface/lang_edit_page";
$route['admin-panel/actions/pages/lang/:num/page/home']			= "admin_interface/home_page";
$route['admin-panel/actions/pages/lang/:num/page/trade']		= "admin_interface/menu_page";
$route['admin-panel/actions/pages/lang/:num/page/faq']			= "admin_interface/menu_page";
$route['admin-panel/actions/pages/lang/:num/page/deposit']		= "admin_interface/menu_page";
$route['admin-panel/actions/pages/lang/:num/page/contact-us']	= "admin_interface/menu_page";

$route['admin-panel/actions/pages/delete-lang/:num']			= "admin_interface/lang_detele";
$route['admin-panel/actions/pages/delete-category/:num']		= "admin_interface/category_detele";
$route['admin-panel/actions/pages/delete-page/:num']			= "admin_interface/lang_delete_page";

$route['admin-panel/actions/pages/lang/:num/categories']		= "admin_interface/lang_categories";
$route['admin-panel/actions/pages/lang/:num/properties']		= "admin_interface/lang_properties";

$route['admin-panel/actions/profile']					= "admin_interface/actions_profile";

/*************************************************** USERS INTRERFACE ***********************************************/

$route['']							= "users_interface/index";
$route['trade']						= "users_interface/trade";
$route['faq']						= "users_interface/pages";
$route['deposit']					= "users_interface/pages";
$route['contact-us']				= "users_interface/pages";

$route['login']						= "users_interface/login";
$route['logoff']					= "users_interface/logoff";
$route['registering']				= "users_interface/registering";
$route['forgot-password']			= "users_interface/forgot_password";

$route['change-site-language/:any'] = "users_interface/change_language";

$route[':any']						= "users_interface/pages";