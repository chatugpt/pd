<?php
abstract class AreaValueBase extends Value {
  //setup
  public $primary = "area_id";
  public $tableName = "area";
  public $fieldMap = array(
    "area_id"
    ,"area_name"
    ,"reid"
    ,"disorder"

  );


  //fields
  
  public $area_id;
  public $area_name;
  public $reid;
  public $disorder;

  
  //methods
  public function getPrimary() {
    return $this->{$this->primary};
  }
  public function setPrimary($value) {
    $this->{$this->primary} = $value;
  }



  public function addAreaIdCondition($value, $condition) {
    $this->addFieldCondition("area_id", $value, $condition);
  }

  public function addAreaNameCondition($value, $condition) {
    $this->addFieldCondition("area_name", $value, $condition);
  }

  public function addReidCondition($value, $condition) {
    $this->addFieldCondition("reid", $value, $condition);
  }

  public function addDisorderCondition($value, $condition) {
    $this->addFieldCondition("disorder", $value, $condition);
  }

}