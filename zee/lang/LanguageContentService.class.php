<?php
class LanguageContentService {
  public function getList(LanguageContentValue $languageContentVo, $listPageHelper = null) {
    return Zee::registry('DB')->fetchAll($languageContentVo, $listPageHelper);
  }
  public function create(LanguageContentValue $languageContentVo) {
    $languageContentVo->created = date('Y-m-d H:i:s');
    $languageContentVo->modified = date('Y-m-d H:i:s');
    $languageContentVo->status = Value::STATUS_ENABLE;
    $primaryValue = Zee::registry('DB')->create($languageContentVo);
    if (!$primaryValue) {
      return false;
    }
    return $this->getByPrimary($primaryValue);
  }
  public function updateByPrimary(LanguageContentValue $languageContentVo) {
    $languageContentVo->modified = date('Y-m-d H:i:s');
    $languageContentVo->cleanConditions();
    $languageContentVo->addPrimaryCondition($languageContentVo->getPrimary(), Value::EQUAL);
    $updateNum = Zee::registry('DB')->update($languageContentVo, $where);
    if (!$updateNum) {
      return false;
    }
    return $languageContentVo;
  }
  public function getByPrimary($value) {
    $languageContentVo = new LanguageContentValue();
    $languageContentVo->addPrimaryCondition($value, Value::EQUAL);
    return Zee::registry('DB')->fetch($languageContentVo);
  }
  public function deleteByPrimary($value) {
    $languageContentVo = new LanguageContentValue();
    $languageContentVo->addPrimaryCondition($value, Value::EQUAL);
    return Zee::registry('DB')->delete($languageContentVo);
  }
  public function getByLangIdAndCode($languageId, $code) {
    $languageContentVo = new LanguageContentValue();
    $languageContentVo->addFieldCondition('code', $code, Value::EQUAL);
    $languageContentVo->addFieldCondition('language_id', $languageId, Value::EQUAL);
    return Zee::registry('DB')->fetch($languageContentVo);
  }
}