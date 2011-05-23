<?php
require_once "value/base/AreaValueBase.class.php";
class AreaValue extends AreaValueBase {
  public function getCreateOptions() {
    return array(
      "created" => ""
      ,"modified" => ""
      ,"status" => ""
	   	,"area_id" => ""
	   	,"area_name" => "required:ERROR.REQUIRED;"
	   	,"reid" => ""
	   	,"disorder" => ""
      );
  }

  public function getUpdateOptions() {
    return $this->getCreateOptions();
  }
}