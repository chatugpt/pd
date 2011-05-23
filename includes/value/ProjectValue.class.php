<?php
require_once "value/base/ProjectValueBase.class.php";
class ProjectValue extends ProjectValueBase {
  public function getCreateOptions() {
    return array(
      "created" => ""
      ,"modified" => ""
      ,"status" => ""
	   	,"project_id" => ""
	   	,"project_name" => "required:ERROR.REQUIRED;"
	   	,"father_id" => ""
      );
  }

  public function getUpdateOptions() {
    return $this->getCreateOptions();
  }
}