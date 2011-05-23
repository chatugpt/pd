<?php
require_once "value/AreaValue.class.php";
class AreaService {
  public function getList(AreaValue $areaVo, $listPageHelper = null) {
    return Zee::registry("DB")->fetchAll($areaVo, $listPageHelper);
  }
  public function create(AreaValue $areaVo) {
    $areaVo->created = date("Y-m-d H:i:s");
    $areaVo->modified = date("Y-m-d H:i:s");
    $areaVo->status = Value::STATUS_ENABLE;
    $primaryValue = Zee::registry("DB")->create($areaVo);
    if (!$primaryValue) {
      return false;
    }
    return $this->getByPrimary($primaryValue);
  }
  public function updateByPrimary(AreaValue $areaVo) {
    $areaVo->modified = date("Y-m-d H:i:s");
    $areaVo->cleanConditions();
    $areaVo->addPrimaryCondition($areaVo->getPrimary(), Value::EQUAL);
    $updateNum = Zee::registry("DB")->update($areaVo, $where);
    if (!$updateNum) {
      return false;
    }
    return $this->getByPrimary($areaVo->getPrimary());
  }
  public function getByPrimary($value) {
    $areaVo = new AreaValue();
    $areaVo->addPrimaryCondition($value, Value::EQUAL);
    return Zee::registry("DB")->fetch($areaVo);
  }
  public function deleteByPrimary($value) {
    $areaVo = new AreaValue();
    $areaVo->addPrimaryCondition($value);
    return Zee::registry("DB")->delete($areaVo);
  }
}