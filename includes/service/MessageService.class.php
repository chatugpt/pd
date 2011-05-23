<?php
require_once "value/MessageValue.class.php";
class MessageService {
  public function getList(MessageValue $messageVo, $listPageHelper = null) {
    return Zee::registry("DB")->fetchAll($messageVo, $listPageHelper);
  }
  public function create(MessageValue $messageVo) {
    $messageVo->created = date("Y-m-d H:i:s");
    $messageVo->modified = date("Y-m-d H:i:s");
    $messageVo->status = Value::STATUS_ENABLE;
    $primaryValue = Zee::registry("DB")->create($messageVo);
    if (!$primaryValue) {
      return false;
    }
    return $this->getByPrimary($primaryValue);
  }
  public function updateByPrimary(MessageValue $messageVo) {
    $messageVo->modified = date("Y-m-d H:i:s");
    $messageVo->cleanConditions();
    $messageVo->addPrimaryCondition($messageVo->getPrimary(), Value::EQUAL);
    $updateNum = Zee::registry("DB")->update($messageVo, $where);
    if (!$updateNum) {
      return false;
    }
    return $this->getByPrimary($messageVo->getPrimary());
  }
  public function getByPrimary($value) {
    $messageVo = new MessageValue();
    $messageVo->addPrimaryCondition($value, Value::EQUAL);
    return Zee::registry("DB")->fetch($messageVo);
  }
  public function getByOderid($value) {
    $messageVo = new MessageValue();
    $messageVo->addOrderIdCondition($value, Value::EQUAL);
    return Zee::registry("DB")->fetchAll($messageVo);
  }
  public function deleteByPrimary($value) {
    $messageVo = new MessageValue();
    $messageVo->addPrimaryCondition($value);
    return Zee::registry("DB")->delete($messageVo);
  }
}