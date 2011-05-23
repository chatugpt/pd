<?php
date_default_timezone_set('PRC');
//define("IS_ACCESS_FLAG", true);
global $appGlobal;
//==================
// Path
//==================
$appGlobal['APP_ROOT'] = dirname(__FILE__);
$appGlobal['LIB_PATH'] = $appGlobal['APP_ROOT'].'/includes';

if (!isset($appGlobal['INIT_FLAG']) || $appGlobal['INIT_FLAG'] == false) {
  set_include_path(get_include_path() . PATH_SEPARATOR . $appGlobal['LIB_PATH']);
  $appGlobal['INIT_FLAG'] = true;
}
//init
require_once 'Config.class.php';
require_once 'zee/Zee.class.php';
require_once 'zee/db/DB.class.php';
require_once 'zee/db/Value.class.php';
require_once 'zee/lang/Language.class.php';
require_once 'zee/lang/LanguageContentValue.class.php';
require_once 'zee/lang/LanguageValue.class.php';
require_once 'zee/lang/LanguageService.class.php';
require_once 'zee/lang/LanguageContentService.class.php';

//db
$db = new DB();
Zee::register('DB', $db);

$action = addslashes(trim($_GET['action']));

//get langs
$languageContentService = new LanguageContentService();
$languageService = new LanguageService();
$languageVo = new LanguageValue();
$languageList = $languageService->getList($languageVo);
//var_dump($languageList);exit;
$typeArray = array('ERROR', 'LABEL', 'MESSAGE');
switch ($action) {
  case 'update':
    {
      if (!trim($_POST['language_content_code'])) {
        echo 'no code';
        exit;
      }
      //do update
      addslashes(trim($_POST['language_content_code']));
      $codeArrayTmp = explode('.', addslashes(trim($_POST['language_content_code'])));
      if (count($codeArrayTmp) != 3) {
        echo 'code error!';
        exit;
      }
      if (!in_array($codeArrayTmp[2], $typeArray)) {
        echo 'End code must be ERROR, LABEL, MESSAGE';
        exit;
      }
      $contents = $_POST['language_content_content'];
      foreach ($contents as $language_id => $content) {
        $languageContentValue = new LanguageContentValue();
        $languageContentValue->code = addslashes(trim($_POST['language_content_code']));
        $languageContentValue->language_id = intval(trim($language_id));
        $languageContentValue->model_code = $codeArrayTmp[0];
        $languageContentValue->content = addslashes(trim($content));
        $languageContentValue->type = 'ERROR';
        $languageContentCondition = new LanguageContentValue();
        $languageContentCondition->addFieldCondition('code', $languageContentValue->code, Value::EQUAL);
        $languageContentCondition->addFieldCondition('language_id', $languageContentValue->language_id, Value::EQUAL);
        $languageContentList = $languageContentService->getList($languageContentCondition);
        if (count($languageContentList) <= 0) {
          $languageContentValue = $languageContentService->create($languageContentValue);
        } else {
          $languageContentValue->setPrimary($languageContentList[0]->getPrimary());
          $languageContentValue = $languageContentService->updateByPrimary($languageContentValue);
        }
        //var_dump($languageContentValue);
      }
      require_once 'zee/lang/update.tpl.php';
    }
    break;
  default:
    {
      $code = trim($_GET['code']);
      if (!$code) {
        echo 'no code';
        exit;
      }
      $codeArrayTmp = explode('.', $code);
      if (count($codeArrayTmp) != 3) {
        echo 'code error!';
        exit;
      }
      if (!in_array($codeArrayTmp[2], $typeArray)) {
        echo 'End code must be ERROR, LABEL, MESSAGE';
        exit;
      }
      $languageContentValue = new LanguageContentValue();
      $languageContentValue->addFieldCondition('code', $code, Value::EQUAL);
      $languageContentList = $languageContentService->getList($languageContentValue);
      require_once 'zee/lang/create.tpl.php';
    }
    break;
}


