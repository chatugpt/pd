<?php
abstract class OrdersValueBase extends Value {
  //setup
  public $primary = "order_id";
  public $tableName = "orders";
  public $fieldMap = array(
    "order_id"
    ,"customer_name"
    ,"customer_address"
    ,"assign"
    ,"age"
    ,"sex"
    ,"project_id"
    ,"HIS"
    ,"mobile"
    ,"telephone"
    ,"operate_status"
    ,"contact_status"
    ,"contact_time"
    ,"operate_time"
    ,"operate_price"
    ,"user_id"
    ,"modifyer_id"
    ,"addtime"
    ,"status"
    ,"info"
    ,"price"

  );


  //fields
  
  public $order_id;
  public $customer_name;
  public $customer_address;
  public $assign;
  public $age;
  public $sex;
  public $project_id;
  public $HIS;
  public $mobile;
  public $telephone;
  public $operate_status;
  public $contact_status;
  public $contact_time;
  public $operate_time;
  public $operate_price;
  public $user_id;
  public $modifyer_id;
  public $addtime;
  public $info;
  public $price;

  
  //methods
  public function getPrimary() {
    return $this->{$this->primary};
  }
  public function setPrimary($value) {
    $this->{$this->primary} = $value;
  }



  public function addOrderIdCondition($value, $condition) {
    $this->addFieldCondition("order_id", $value, $condition);
  }

  public function addCustomerNameCondition($value, $condition) {
    $this->addFieldCondition("customer_name", $value, $condition);
  }

  public function addCustomerAddressCondition($value, $condition) {
    $this->addFieldCondition("customer_address", $value, $condition);
  }

  public function addAssignCondition($value, $condition) {
    $this->addFieldCondition("assign", $value, $condition);
  }

  public function addAgeCondition($value, $condition) {
    $this->addFieldCondition("age", $value, $condition);
  }

  public function addSexCondition($value, $condition) {
    $this->addFieldCondition("sex", $value, $condition);
  }

  public function addProjectIdCondition($value, $condition) {
    $this->addFieldCondition("project_id", $value, $condition);
  }

  public function addHISCondition($value, $condition) {
    $this->addFieldCondition("HIS", $value, $condition);
  }

  public function addMobileCondition($value, $condition) {
    $this->addFieldCondition("mobile", $value, $condition);
  }

  public function addTelephoneCondition($value, $condition) {
    $this->addFieldCondition("telephone", $value, $condition);
  }

  public function addOperateStatusCondition($value, $condition) {
    $this->addFieldCondition("operate_status", $value, $condition);
  }

  public function addContactStatusCondition($value, $condition) {
    $this->addFieldCondition("contact_status", $value, $condition);
  }

  public function addContactTimeCondition($value, $condition) {
    $this->addFieldCondition("contact_time", $value, $condition);
  }

  public function addOperateTimeCondition($value, $condition) {
    $this->addFieldCondition("operate_time", $value, $condition);
  }

  public function addOperatePriceCondition($value, $condition) {
    $this->addFieldCondition("operate_price", $value, $condition);
  }

  public function addUserIdCondition($value, $condition) {
    $this->addFieldCondition("user_id", $value, $condition);
  }

  public function addModifyerIdCondition($value, $condition) {
    $this->addFieldCondition("modifyer_id", $value, $condition);
  }

  public function addAddtimeCondition($value, $condition) {
    $this->addFieldCondition("addtime", $value, $condition);
  }

  public function addInfoCondition($value, $condition) {
    $this->addFieldCondition("info", $value, $condition);
  }

  public function addPriceCondition($value, $condition) {
    $this->addFieldCondition("price", $value, $condition);
  }

}