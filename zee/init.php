<?php
if (!defined('IS_ACCESS_FLAG')) {
  die('Illegal Access');
}
//==================
// Core files
//==================
require_once 'Config.class.php';
require_once 'zee/Zee.class.php';
require_once 'zee/db/DB.class.php';
require_once 'zee/db/Value.class.php';
require_once 'zee/core/View.class.php';
require_once 'zee/core/Request.class.php';
require_once 'zee/core/Dispatch.class.php';
require_once 'zee/core/Controller.class.php';
require_once 'zee/core/Part.class.php';
require_once 'zee/core/FilterHelper.calss.php';
require_once 'zee/message/Errors.class.php';
require_once 'zee/message/Messages.class.php';
require_once 'zee/lang/Language.class.php';
require_once 'zee/lang/LanguageContentValue.class.php';
require_once 'zee/lang/LanguageValue.class.php';
require_once 'zee/lang/LanguageService.class.php';
require_once 'zee/lang/LanguageContentService.class.php';


//==================
// Request
//==================
Request::init($_REQUEST);
//==================
// DB
//==================
Zee::register('DB', new DB());
//==================
// Language
//==================


//==================
// Exec Pre Filters
//==================
FilterHelper::execFilters(FilterHelper::PRE_FILTER);

//==================
// Do Module
//==================
$controller = Dispatch::getController(Request::getModule());
$controller->execute(Request::getAction());

//==================
// Exec Post Filters
//==================
FilterHelper::execFilters(FilterHelper::POST_FILTER);
