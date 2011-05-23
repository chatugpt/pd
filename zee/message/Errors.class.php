<?php
abstract class Errors {
  static private $_errors = array();
  static public function addError($message, $field) {
    self::$_errors[$field][$name] = $message;
  }
  static public function show($field) {
    if (array_key_exists($field, self::$_errors)) {
      foreach (self::$_errors[$field] as $errorCode) {
        echo '<br /><span color="#FF0066"><img src="images/error.gif" alt="Error Message" title="Error Message">'.Language::content($errorCode).'</span>';
      }
    }
  }
}