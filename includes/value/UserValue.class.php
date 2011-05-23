<?php
require_once "value/base/UserValueBase.class.php";
class UserValue extends UserValueBase {
  public function getCreateOptions() {
    return array(
      "created" => ""
      ,"modified" => ""
      ,"status" => ""
	   	,"user_id" => ""
	   	,"role" => "required:ERROR.REQUIRED;"
	   	,"username" => "required:ERROR.REQUIRED;"
	   	,"password" => "required:ERROR.REQUIRED;"
	   	,"realname" => "required:ERROR.REQUIRED;"
      );
  }

  public function getUpdateOptions() {
    return $this->getCreateOptions();
  }
}