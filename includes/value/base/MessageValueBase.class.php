<?php
abstract class MessageValueBase extends Value {
  //setup
  public $primary = "message_id";
  public $tableName = "message";
  public $fieldMap = array(
    "message_id"
    ,"order_id"
    ,"content"
    ,"user_id"
    ,"time"
    ,"status"

  );


  //fields
  
  public $message_id;
  public $order_id;
  public $content;
  public $user_id;
  public $time;

  
  //methods
  public function getPrimary() {
    return $this->{$this->primary};
  }
  public function setPrimary($value) {
    $this->{$this->primary} = $value;
  }



  public function addMessageIdCondition($value, $condition) {
    $this->addFieldCondition("message_id", $value, $condition);
  }

  public function addOrderIdCondition($value, $condition) {
    $this->addFieldCondition("order_id", $value, $condition);
  }

  public function addContentCondition($value, $condition) {
    $this->addFieldCondition("content", $value, $condition);
  }

  public function addUserIdCondition($value, $condition) {
    $this->addFieldCondition("user_id", $value, $condition);
  }

  public function addTimeCondition($value, $condition) {
    $this->addFieldCondition("time", $value, $condition);
  }

}