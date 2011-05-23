<?php
require_once "value/base/MessageValueBase.class.php";
class MessageValue extends MessageValueBase {
  public function getCreateOptions() {
    return array(
      "created" => ""
      ,"modified" => ""
      ,"status" => ""
	   	,"message_id" => "required:ERROR.REQUIRED;"
	   	,"order_id" => "required:ERROR.REQUIRED;"
	   	,"content" => "required:ERROR.REQUIRED;"
	   	,"user_id" => "required:ERROR.REQUIRED;"
	   	,"time" => "required:ERROR.REQUIRED;"
      );
  }

  public function getUpdateOptions() {
    return $this->getCreateOptions();
  }
}