<?php
abstract class Value {
  const EQUAL = '=';
  const NOT_EQUAL = "<>";
  const GREATER_THAN = ">";
  const LESS_THAN = "<";
  const GREATER_EQUAL = ">=";
  const LESS_EQUAL = "<=";
  const LIKE = "like";
  const NOT_LIKE = "not like";
  const IN = "in";
  const NOT_IN = "not in";
  const IS_NULL = "is null";
  const IS_NOT_NULL = "is not null";
  const ASC = "asc";
  const DESC = "desc";

  //status
  const STATUS_ENABLE = 1;
  const STATUS_DISABLE = 2;
  
  //联系的状态
	// 待联系
  const CONTACT_STATUS_NOT_CONTACT=0;
	// 已联系
  const CONTACT_STATUS_CONTACTED=1;
	// 无法联系
  const CONTACT_STATUS_CANNOT_CONTACT=2;	
  
  //派单或者消息的查看状态
	// 未查看
  const STATUS_NOT_SEE=0;
  	// 已查看
  const STATUS_SEEM=1;
  
  //成交状态
	// 已成交
	// 未成交
  const OPERATE_STATUS_NOT_OPERATE=0;
  const OPERATE_STATUS_OPERATED=1;
  
  
  /**
   * 用户角色
   *
   *a 总管理员 权限（项目管理 派往地区管理 管理员管理 +普通用户权限）
   *s 派单员 留言 查询 导出
   *普通跟单员的ID为地区的ID号 普通用户 留言 查询 导出
   * 
   */  
  const USER_ROLE_ADMIN='a';
  const USER_ROLE_ASSIGN='s';
 


  public $conditions = array();
  public $primary = null;
  public $tableName = null;
  public $fieldMap = array();
  //fields
  public $created = null;
  public $modified = null;
  public $status = null;

  /**
   * Clean conditions
   *
   */
  final public function cleanConditions() {
    $this->conditions = array();
  }
  /**
   * Add condition
   *
   * @param string $conditionString
   */
  final public function addCondition($conditionString) {
    $this->conditions[] = $conditionString;
  }
  /**
   * Add primary condition
   *
   * @param mixed $value
   * @param mixed $condition
   */
  final public function addPrimaryCondition($value, $condition) {
    $this->addFieldCondition($this->primary, $value, $condition);
  }
  final public function addCreatedCondition($value, $condition) {
    $this->addFieldCondition('created', $value, $condition);
  }
  final public function addModifiedCondition($value, $condition) {
    $this->addFieldCondition('modified', $value, $condition);
  }
  final public function addStatusCondition($value, $condition) {
    $this->addFieldCondition('status', $value, $condition);
  }

  /**
   * Add field condition
   *
   * @param string $fieldName
   * @param mixed $value
   * @param string $condition
   */
  final public function addFieldCondition($fieldName, $value, $condition) {
    //null or not null condition
    if ($condition == self::IS_NOT_NULL || $condition == self::IS_NULL) {
      $conditionString = "{$fieldName} {$condition}";
      $this->addCondition($conditionString);
      return ;
    }
    //in or not in condition
    if ($condition == self::IN || $condition == self::NOT_IN) {
      if ( is_string($value)) {
        $value = addslashes($value);
        $conditionString = "{$fieldName} {$condition} ({$value})";
        $this->addCondition($conditionString);
        return ;
      } elseif (is_array($value) && count($value) > 0) {
        $valueString = implode(',', $value);
        $valueString = addslashes($valueString);
        $conditionString = "{$fieldName} {$condition} ({$valueString})";
        $this->addCondition($conditionString);
        return ;
      } else {
        return ;
      }
    }
    //number value
    if (is_float($value) || is_int($value)) {
      $conditionString = "{$fieldName} {$condition} {$value}";
      $this->addCondition($conditionString);
      return ;
    }
    //string value
    $value = addslashes($value);
    $conditionString = "{$fieldName} {$condition} '{$value}'";
    $this->addCondition($conditionString);
    return ;
  }
  /**
   * Check value
   *
   * @param array $options
   */
  final public function checkOptions($checkOptions) {
    $attributes = get_object_vars($this);
    $checkPass = true;

    foreach ($attributes as $attribute => $value) {
      if (in_array($attribute, array('primary', 'tableName', 'fieldMap', 'conditions'))) {
        continue;
      }
      $checkOptionString = trim($checkOptions[$attribute]);
      if (strlen($checkOptionString) <= 0) {
        continue;
      }
      $checkList = explode(';', $checkOptionString);
      //var_dump($checkList);
      foreach ($checkList as $check) {
        //var_dump($check);
        $field = strtoupper($attribute);
        $checkInfo = explode(':', $check);
        //var_dump($checkInfo);
        //var_dump($valueObject->$attribute, $field, $checkInfo[1]);
        switch ($checkInfo[0]) {
          case 'required':
            {
              if (!trim($this->$attribute)) {
                $message = Language::content($checkInfo[1]);
                Errors::addError($message, $field);
                $checkPass = false;
              }
              break;
            }
          case 'number':
            {
              if (strlen(trim($this->$attribute)) <= 0) {
                break;
              }
              if (strlen($valueObject->$attribute)>0 && !is_numeric($valueObject->$attribute)) {
                $message = Language::content($checkInfo[1]);
                Errors::addError($message, $field);
                $checkPass = false;
              }
              break;
            }
          case 'email':
            {
              if (strlen(trim($this->$attribute)) <= 0) {
                break;
              }
              if (!Validation::isEmail($valueObject->$attribute)) {
                $message = Language::content($checkInfo[1]);
                Errors::addError($message, $field);
                $checkPass = false;
              }
              break;
            }
          case 'date':
            {
              //var_dump($valueObject->$attribute);
              if (strlen(trim($this->$attribute)) <= 0) {
                break;
              }
              if (!Validation::isDate($valueObject->$attribute)) {
                $message = Language::content($checkInfo[1]);
                Errors::addError($message, $field);
                $checkPass = false;
                break;
              }
            }
          case 'alnum':
            {
              if (strlen(trim($this->$attribute)) <= 0) {
                break;
              }
              if (!Validation::isAlnum($valueObject->$attribute)) {
                $message = Language::content($checkInfo[1]);
                Errors::addError($message, $field);
                $checkPass = false;
              }
              break;
            }
          case 'minLength':
            {
              if (strlen(trim($this->$attribute)) <= 0) {
                break;
              }
              if (strlen($valueObject->$attribute) < $checkInfo[2]) {
                $messageTpl = Language::content($checkInfo[1]);
                $message = str_replace('{0}', $checkInfo[2], $messageTpl);
                Errors::addError($message, $field);
                $checkPass = false;
              }
              break;
            }
          case 'maxLength':
            {
              if (strlen(trim($this->$attribute)) <= 0) {
                break;
              }
              if (strlen($valueObject->$attribute) > $checkInfo[2]) {
                $messageTpl = Language::content($checkInfo[1]);
                $message = str_replace('{0}', $checkInfo[2], $messageTpl);
                Errors::addError($message, $field);
                $checkPass = false;
              }
              break;
            }
        }
      }
    }
    return $checkPass;
  }
  abstract public function getPrimary();
  abstract public function setPrimary($value);
}