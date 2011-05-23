<?php
class LanguageContentValue extends Value {
  //setup
  public $primary = 'id';
  public $tableName = 'language_content';
  public $fieldMap = array(
      'created'
      ,'modified'
      ,'status'
      ,'id'
      ,'language_id'
      ,'model_code'
      ,'code'
      ,'content'
      ,'type'
      );
  //fields
  public $id;
  public $language_id;
  public $model_code;
  public $code;
  public $content;
  public $type;

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
        , "language_id" => "required:ERROR.REQUIRED;"
        , "model_code" => "required:ERROR.REQUIRED;"
        , "code" => "required:ERROR.REQUIRED;"
        , "content" => "required:ERROR.REQUIRED;"
        , "type" => "required:ERROR.REQUIRED;"
        );
  }

  public function getUpdateOptions() {
    return $this->getCreateOptions();
  }
}