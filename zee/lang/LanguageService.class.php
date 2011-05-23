<?php
class LanguageService {
  public function getList(LanguageValue $languageVo, $listPageHelper = null) {
    return Zee::registry('DB')->fetchAll($languageVo, $listPageHelper);
  }
  public function create(LanguageValue $languageVo) {
    $languageVo->created = date('Y-m-d H:i:s');
    $languageVo->modified = date('Y-m-d H:i:s');
    $languageVo->status = Value::STATUS_ENABLE;
    $primaryValue = Zee::registry('DB')->create($languageVo);
    if (!$primaryValue) {
      return false;
    }
    return $this->getByPrimary($primaryValue);
  }
  public function updateByPrimary(LanguageValue $languageVo) {
    $languageVo->modified = date('Y-m-d H:i:s');
    $languageVo->cleanConditions();
    $languageVo->addPrimaryCondition($languageVo->getPrimary(), Value::EQUAL);
    $updateNum = Zee::registry('DB')->update($languageVo, $where);
    if (!$updateNum) {
      return false;
    }
    return $languageVo;
  }
  public function getByPrimary($value) {
    $languageVo = new LanguageValue();
    $languageVo->addPrimaryCondition($value, Value::EQUAL);
    return Zee::registry('DB')->fetch($languageVo);
  }
  public function deleteByPrimary($value) {
    $languageVo = new LanguageValue();
    $languageVo->addPrimaryCondition($value);
    return Zee::registry('DB')->delete($languageVo);
  }
}