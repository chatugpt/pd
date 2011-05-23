<?php
require_once "value/base/OrdersValueBase.class.php";
class OrdersValue extends OrdersValueBase {
  public function getCreateOptions() {
    return array(
      "created" => ""
      ,"modified" => ""
      ,"status" => ""
	   	,"order_id" => ""
	   	,"customer_name" => "required:必须输入客户姓名;"
	   	,"customer_address" => "required:必须输入客户地址;"
	   	,"assign" => "required:分配的地区不能为空;"
	    	, "age" => ""
	   	,"sex" => "required:ERROR.REQUIRED;"
	   	,"project_id" => "required:项目不能为空;"
	    	, "HIS" => ""
	    	, "mobile" => ""
	   	,"telephone" => ""
	    	, "operate_status" => ""
	    	, "contact_status" => ""
	    	, "contact_time" => ""
	    	, "operate_time" => ""
	    	, "operate_price" => ""
	   	,"user_id" => ""
	    	, "modifyer_id" => ""
	   	,"addtime" => ""
	    	, "info" => ""
	    	, "price" => ""
      );
  }

  public function getUpdateOptions() {
    return $this->getCreateOptions();
  }
}