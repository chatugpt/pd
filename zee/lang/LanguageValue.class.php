<?php
class LanguageValue extends Value {
  //setup
  public $primary = 'id';
  public $tableName = 'language';
  public $fieldMap = array(
      'created'
      ,'modified'
      ,'status'
      ,'id'
      ,'code'
      ,'name'
      ,'icon'
      );
  //fields
  public $id;
  public $code;
  public $name;
  public $icon;
  
  //methods
  public function getPrimary() {
    return $this->{$this->primary};
  }
  public function setPrimary($value) {
    $this->{$this->primary} = $value;
  }

  public function getCreateOptions() {
    return array(
        "created" => ""
        , "modified" => ""
        , "status" => ""
        , "id" => ""
        , "code" => "required:ERROR.REQUIRED;"
        , "name" => "required:ERROR.REQUIRED;"
        , "icon" => "required:ERROR.REQUIRED;"
        );
  }

  public function getUpdateOptions() {
    return $this->getCreateOptions();
  }
}