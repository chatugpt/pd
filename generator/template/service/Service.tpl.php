<?php
$outCodes = '<?php
require_once "value/'.$moduleName.'Value.class.php";
class '.$moduleName.'Service {
  public function getList('.$moduleName.'Value $'.$moduleVarName.'Vo, $listPageHelper = null) {
    return Zee::registry("DB")->fetchAll($'.$moduleVarName.'Vo, $listPageHelper);
  }
  public function create('.$moduleName.'Value $'.$moduleVarName.'Vo) {
    $'.$moduleVarName.'Vo->created = date("Y-m-d H:i:s");
    $'.$moduleVarName.'Vo->modified = date("Y-m-d H:i:s");
    $'.$moduleVarName.'Vo->status = Value::STATUS_ENABLE;
    $primaryValue = Zee::registry("DB")->create($'.$moduleVarName.'Vo);
    if (!$primaryValue) {
      return false;
    }
    return $this->getByPrimary($primaryValue);
  }
  public function updateByPrimary('.$moduleName.'Value $'.$moduleVarName.'Vo) {
    $'.$moduleVarName.'Vo->modified = date("Y-m-d H:i:s");
    $'.$moduleVarName.'Vo->cleanConditions();
    $'.$moduleVarName.'Vo->addPrimaryCondition($'.$moduleVarName.'Vo->getPrimary(), Value::EQUAL);
    $updateNum = Zee::registry("DB")->update($'.$moduleVarName.'Vo, $where);
    if (!$updateNum) {
      return false;
    }
    return $this->getByPrimary($'.$moduleVarName.'Vo->getPrimary());
  }
  public function getByPrimary($value) {
    $'.$moduleVarName.'Vo = new '.$moduleName.'Value();
    $'.$moduleVarName.'Vo->addPrimaryCondition($value, Value::EQUAL);
    return Zee::registry("DB")->fetch($'.$moduleVarName.'Vo);
  }
  public function deleteByPrimary($value) {
    $'.$moduleVarName.'Vo = new '.$moduleName.'Value();
    $'.$moduleVarName.'Vo->addPrimaryCondition($value);
    return Zee::registry("DB")->delete($'.$moduleVarName.'Vo);
  }
}';
return $outCodes;
