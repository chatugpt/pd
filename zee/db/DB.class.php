<?php
require_once 'zee/db/engine/Engine.class.php';
require_once 'zee/db/Value.class.php';
class DB {
  private $_engine = null;

  public function __construct() {
    if (isset($this->_engine) && $this->_engine instanceof Engine) {
      return ;
    }
    $this->_engine = new Engine();
    $this->_engine->connect(Config::DB_HOST, Config::DB_USER, Config::DB_PSW, Config::DB_NAME);
  }
  /**
   * Insert one recode to table by Value
   *
   * @param Value $vo
   * @return int
   */
  public function create(Value $vo) {
    $fieldArray = $vo->fieldMap;
    $valueArray = array();
    foreach ($fieldArray as $key=>$fieldName) {
      if (($vo->$fieldName === null) || ($fieldName == $vo->primary)) {
        unset($fieldArray[$key]);
        continue;
      }
      $valueArray[$key] = $this->_engine->quote($vo->$fieldName);
    }
    $fieldString = implode(',', $fieldArray);
    $valueString = implode(',', $valueArray);
    $sql = "insert into {$vo->tableName} ($fieldString) values ($valueString)";
    $this->exec($sql);
    return $this->lastInsertId();
  }
  /**
   * Update one recode by Value
   *
   * @param Value $vo
   * @return int
   */
  public function update(Value $vo) {
    $fieldArray = $vo->fieldMap;
    $fieldSetArray = array();
    foreach ($fieldArray as $key=>$fieldName) {
      if (($vo->$fieldName === null) || ($fieldName == $vo->primary)) {
        unset($fieldArray[$key]);
        continue;
      }
      $fieldSetArray[] = "{$fieldName}=".$this->_engine->quote($vo->$fieldName);
    }
    $fieldSetString = implode(',', $fieldSetArray);
    $whereClause = $this->genWhere($vo);
    $sql = "update {$vo->tableName} set {$fieldSetString} where {$whereClause} limit 1";
    return $this->exec($sql);
  }

  public function delete(Value $vo) {
    $whereClause = $this->genWhere($vo);
    $this->_engine->deleteByWhere($vo->tableName, $whereClause);
  }
  public function fetch(Value $vo) {
    $whereClause = $this->genWhere($vo);
    return $this->_engine->fetchByWhere($vo->tableName, $vo->fieldMap, get_class($vo), $whereClause);
  }
  public function fetchAll(Value $vo, $listPageHelper = null) {
    $whereClause = $this->genWhere($vo);
    if ($listPageHelper instanceof ListPageHelper) {
      $listPageHelper->totalRow = $this->getRowCount($vo);
      $whereClause = $listPageHelper->genPageSQL($whereClause);
    }
    return $this->_engine->fetchAllByWhere($vo->tableName, $vo->fieldMap, get_class($vo), $whereClause);
  }
  public function getRowCount(Value $vo) {
    $whereClause = $this->genWhere($vo);
    $sql = "select count(*) count from {$vo->tableName} where {$whereClause}";
    return $this->fetchColumn($sql);
  }
  public function exec($sql) {
    return $this->_engine->exec($sql);
  }
  public function fetchColumn($sql) {
    return $this->_engine->fetchColumn($sql);
  }
  public function lastInsertId() {
    return $this->_engine->lastInsertId();
  }
  /**
   * Quotes a string for use in a query.
   *
   * @param mixed $value
   * @return mixed
   */
  public function quote($value) {
    return $this->_engine->quote($value);
  }
  /**
   * Initiates a transaction
   *
   * @return bool
   */
  public function beginTransaction() {
    return $this->_engine->beginTransaction();
  }
  /**
   * Commits a transaction
   *
   * @return bool
   */
  public function commit() {
    return $this->_engine->commit();
  }
  /**
   * Rolls back a transaction
   *
   * @return bool
   */
  public function rollBack() {
    return $this->_engine->rollBack();
  }
  public function fetchBySql($sql, $voClass = null) {
    return $this->_engine->fetch($sql, $voClass);
  }
  public function fetchAllBySql($sql, $voClass = null) {
    return $this->_engine->fetchAll($sql, $voClass);
  }
  public function genWhere(Value $vo) {
    $whereString = "1=1";
    if (count($vo->conditions) <= 0) {
      return $whereString;
    }
    foreach ($vo->conditions as $condition) {
      $whereString .= " and {$condition}";
    }
    return $whereString;
  }
}