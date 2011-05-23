<?php
abstract class ProjectValueBase extends Value {
  //setup
  public $primary = "project_id";
  public $tableName = "project";
  public $fieldMap = array(
    "project_id"
    ,"project_name"
    ,"father_id"

  );


  //fields
  
  public $project_id;
  public $project_name;
  public $father_id;

  
  //methods
  public function getPrimary() {
    return $this->{$this->primary};
  }
  public function setPrimary($value) {
    $this->{$this->primary} = $value;
  }



  public function addProjectIdCondition($value, $condition) {
    $this->addFieldCondition("project_id", $value, $condition);
  }

  public function addProjectNameCondition($value, $condition) {
    $this->addFieldCondition("project_name", $value, $condition);
  }

  public function addFatherIdCondition($value, $condition) {
    $this->addFieldCondition("father_id", $value, $condition);
  }

}