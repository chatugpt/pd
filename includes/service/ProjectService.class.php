<?php
require_once "value/ProjectValue.class.php";
class ProjectService {
  public function getList(ProjectValue $projectVo, $listPageHelper = null) {
    return Zee::registry("DB")->fetchAll($projectVo, $listPageHelper);
  }
  public function create(ProjectValue $projectVo) {
    $projectVo->created = date("Y-m-d H:i:s");
    $projectVo->modified = date("Y-m-d H:i:s");
    $projectVo->status = Value::STATUS_ENABLE;
    $primaryValue = Zee::registry("DB")->create($projectVo);
    if (!$primaryValue) {
      return false;
    }
    return $this->getByPrimary($primaryValue);
  }
  public function updateByPrimary(ProjectValue $projectVo) {
    $projectVo->modified = date("Y-m-d H:i:s");
    $projectVo->cleanConditions();
    $projectVo->addPrimaryCondition($projectVo->getPrimary(), Value::EQUAL);
    $updateNum = Zee::registry("DB")->update($projectVo, $where);
    if (!$updateNum) {
      return false;
    }
    return $this->getByPrimary($projectVo->getPrimary());
  }
  public function getByPrimary($value) {
    $projectVo = new ProjectValue();
    $projectVo->addPrimaryCondition($value, Value::EQUAL);
    return Zee::registry("DB")->fetch($projectVo);
  }
  public function deleteByPrimary($value) {
    $projectVo = new ProjectValue();
    $projectVo->addPrimaryCondition($value);
    return Zee::registry("DB")->delete($projectVo);
  }
}