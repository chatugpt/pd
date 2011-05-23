<?php
abstract class Messages {
  static private $_systemMessages = array();
  static private $_userMessages = array();
  static public function addSystemMessage($messageCode) {
    self::$_systemMessages[] = $messageCode;
  }
  static public function showAllSystemMessage() {
    $template = "%s";
    foreach (self::$_systemMessages as $messageCode) {
      printf($template, Language::show($messageCode));
    }
  }
  static public function addUserMessage($message) {
    self::$_userMessages[] = Language::show($messageCode);
  }
  static public function showAllUserMessage() {
    $template = "%s";
    foreach (self::$_userMessages as $messageCode) {
      printf($template, Language::show($messageCode));
    }
  }
}