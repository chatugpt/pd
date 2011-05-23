<?php
abstract class UserValueBase extends Value {
  //setup
  public $primary = "user_id";
  public $tableName = "user";
  public $fieldMap = array(
    "user_id"
    ,"role"
    ,"username"
    ,"password"
    ,"realname"

  );


  //fields
  
  public $user_id;
  public $role;
  public $username;
  public $password;
  public $realname;

  
  //methods
  public function getPrimary() {
    return $this->{$this->primary};
  }
  public function setPrimary($value) {
    $this->{$this->primary} = $value;
  }



  public function addUserIdCondition($value, $condition) {
    $this->addFieldCondition("user_id", $value, $condition);
  }

  public function addRoleCondition($value, $condition) {
    $this->addFieldCondition("role", $value, $condition);
  }

  public function addUsernameCondition($value, $condition) {
    $this->addFieldCondition("username", $value, $condition);
  }

  public function addPasswordCondition($value, $condition) {
    $this->addFieldCondition("password", $value, $condition);
  }

  public function addRealnameCondition($value, $condition) {
    $this->addFieldCondition("realname", $value, $condition);
  }

}