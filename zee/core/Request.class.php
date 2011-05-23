<?php
abstract class Request {
  static private $_request;
  static private $_module;
  static private $_action;

  static public function init($inRequest) {
    self::$_request = $inRequest;
    if (key_exists('module', self::$_request)) {
      self::$_module = self::$_request['module'];
    } else {
      self::$_module = Config::DEFAULT_MODULE;
    }

    if (key_exists('action', self::$_request)) {
      self::$_action = self::$_request['action'];
    } else {
      self::$_action = Config::DEFAULT_ACTION;
    }
  }

  static public function get($name) {
    return (array_key_exists($name, self::$_request)?self::$_request[$name]:null);
  }

  static public function set($name, $value) {
    self::$_request[$name] = $value;
  }

  static public function has($name) {
    return array_key_exists($name, self::$_request);
  }

  static public function getModule() {
    return self::$_module;
  }

  static public function getAction() {
    return self::$_action;
  }

  static public function setArray($inArray) {
    self::$_request = $inArray;
  }
  static public function toArray() {
    return self::$_request;
  }
  static public function getValue($fromPrefix, $valueClass) {
    $returnVo = new $valueClass();
    //var_dump($returnVo);
    $keys = get_class_vars($valueClass);
    //var_dump($keys);exit;
    $haveData = false;
    foreach ($keys as $key => $value) {
      if (in_array($key, array('primary', 'tableName', 'fieldMap', 'conditions'))) {
        continue;
      }
      $inputName = "{$fromPrefix}_{$key}";
      $returnVo->$key = self::get($inputName);
      if (!$haveData && $returnVo->$key !== null) {
        $haveData = true;
      }
    }
    if (!$haveData) {
      return null;
    }
    return $returnVo;
  }
}
