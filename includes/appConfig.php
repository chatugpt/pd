<?php
date_default_timezone_set('PRC');
define("IS_ACCESS_FLAG", true);
error_reporting(E_ALL & ~E_NOTICE);
global $appGlobal;
//==================
// Path
//==================
$appGlobal['APP_ROOT'] = dirname(dirname(__FILE__));
$appGlobal['LIB_PATH'] = $appGlobal['APP_ROOT'].'/includes';

if (!isset($appGlobal['INIT_FLAG']) || $appGlobal['INIT_FLAG'] == false) {
	set_include_path(get_include_path() . PATH_SEPARATOR . $appGlobal['LIB_PATH']);
	$appGlobal['INIT_FLAG'] = true;
}

//==================
// Filters
//==================
$appGlobal['PRE_FILTERS'] = array('PreFilter1','PreFilter');
$appGlobal['POST_FILTERS'] = array('PostFilter1');

