<?php
require_once "value/OrdersValue.class.php";
require_once "zee/util/Validation.class.php";
require_once "zee/util/excel.class.php";
class OrdersService {
  public function getList(OrdersValue $ordersVo, $listPageHelper = null) {
    return Zee::registry("DB")->fetchAll($ordersVo, $listPageHelper);
  }
  public function create(OrdersValue $ordersVo) {
    $ordersVo->created = date("Y-m-d H:i:s");
    $ordersVo->modified = date("Y-m-d H:i:s");
    $ordersVo->status = Value::STATUS_ENABLE;
    $primaryValue = Zee::registry("DB")->create($ordersVo);
    if (!$primaryValue) {
      return false;
    }
    return $this->getByPrimary($primaryValue);
  }
  public function updateByPrimary(OrdersValue $ordersVo) {
    $ordersVo->modified = date("Y-m-d H:i:s");
    $ordersVo->cleanConditions();
    $ordersVo->addPrimaryCondition($ordersVo->getPrimary(), Value::EQUAL);
    $updateNum = Zee::registry("DB")->update($ordersVo, $where);
    if (!$updateNum) {
      return false;
    }
    return $this->getByPrimary($ordersVo->getPrimary());
  }
  public function getByPrimary($value) {
    $ordersVo = new OrdersValue();
    $ordersVo->addPrimaryCondition($value, Value::EQUAL);
    return Zee::registry("DB")->fetch($ordersVo);
  }
  public function deleteByPrimary($value) {
    $ordersVo = new OrdersValue();
    $ordersVo->addPrimaryCondition($value);
    return Zee::registry("DB")->delete($ordersVo);
  }
}