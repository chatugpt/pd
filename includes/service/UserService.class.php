<?php
require_once "value/UserValue.class.php";
class UserService {
  public function getList(UserValue $userVo, $listPageHelper = null) {
    return Zee::registry("DB")->fetchAll($userVo, $listPageHelper);
  }
  public function create(UserValue $userVo) {
    $userVo->created = date("Y-m-d H:i:s");
    $userVo->modified = date("Y-m-d H:i:s");
    $userVo->status = Value::STATUS_ENABLE;
    $primaryValue = Zee::registry("DB")->create($userVo);
    if (!$primaryValue) {
      return false;
    }
    return $this->getByPrimary($primaryValue);
  }
  public function updateByPrimary(UserValue $userVo) {
    $userVo->modified = date("Y-m-d H:i:s");
    $userVo->cleanConditions();
    $userVo->addPrimaryCondition($userVo->getPrimary(), Value::EQUAL);
    $updateNum = Zee::registry("DB")->update($userVo, $where);
    if (!$updateNum) {
      return false;
    }
    return $this->getByPrimary($userVo->getPrimary());
  }
  public function getByPrimary($value) {
    $userVo = new UserValue();
    $userVo->addPrimaryCondition($value, Value::EQUAL);
    return Zee::registry("DB")->fetch($userVo);
  }
  public function deleteByPrimary($value) {
    $userVo = new UserValue();
    $userVo->addPrimaryCondition($value);
    return Zee::registry("DB")->delete($userVo);
  }
}