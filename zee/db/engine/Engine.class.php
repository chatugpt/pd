<?php
class Engine {
  /**
   * pdo connection
   *
   * @var resource
   */
  private $_conn = null;

  /**
   * Fetch one recode by where
   *
   * @param string $tableName
   * @param array $fieldMap
   * @param string $voClass
   * @param string $whereClause
   * @return Value
   */
  public function fetchByWhere($tableName, $fieldMap, $voClass, $whereClause) {
    $fieldString = implode(',', $fieldMap);
    $sql = "select {$fieldString} from {$tableName} where {$whereClause} limit 1";
    //var_dump($sql);
    return $this->fetch($sql, $voClass);
  }
  /**
   * Fetch all recodes by where
   *
   * @param string $tableName
   * @param array $fieldMap
   * @param string $voClass
   * @param string $whereClause
   * @return Value[]
   */
  public function fetchAllByWhere($tableName, $fieldMap, $voClass, $whereClause) {
    $fieldString = implode(',', $fieldMap);
    $sql = "select {$fieldString} from {$tableName} where {$whereClause}";
    return $this->fetchAll($sql, $voClass);
  }
  /**
   * Delete recodes by where
   *
   * @param string $tableName
   * @param string $whereClause
   * @return int
   */
  public function deleteByWhere($tableName, $whereClause) {
    $sql = "delete from {$tableName} where {$whereClause}";
    return self::exec($sql);
  }
  /**
   * Execute sql
   *
   * @param string $sql
   * @return int
   */
  public function exec($sql) {
    //var_dump($sql);exit;
    //returns the number of rows that were modified or deleted by the SQL statement
    return $this->_conn->exec($sql);
  }
  /**
   * Fetch all recodes by sql
   *
   * @param string $sql
   * @return object[]
   */
  public function fetchAll($sql, $voClass = null) {
    $sth = $this->_conn->prepare($sql);
    if ($sth instanceof PDOStatement) {
      if (isset($voClass) && strlen($voClass) > 0) {
        $sth->setFetchMode(PDO::FETCH_CLASS, $voClass);
      } else {
        $sth->setFetchMode(PDO::FETCH_OBJ);
      }
      $sth->execute();
      return $sth->fetchAll();
    }
    return array();
  }
  /**
   * Fetch one recode by sql
   *
   * @param string $sql
   * @return object
   */
  public function fetch($sql, $voClass = null) {
    $sth = $this->_conn->prepare($sql);
    if ($sth instanceof PDOStatement) {
      if (isset($voClass) && strlen($voClass) > 0) {
        $sth->setFetchMode(PDO::FETCH_CLASS, $voClass);
      } else {
        $sth->setFetchMode(PDO::FETCH_OBJ);
      }
      $sth->execute();
      return $sth->fetch();
    }
    return null;
  }
  /**
   * Fetch value by sql
   *
   * @param string $sql
   * @return mixed
   */
  public function fetchColumn($sql) {
    $sth = $this->_conn->prepare($sql);
    if ($sth instanceof PDOStatement) {
      $sth->execute();
      return $sth->fetchColumn();
    }
    return null;
  }
  /**
   * Get last insert id
   *
   * @return int
   */
  public function lastInsertId() {
    return $this->_conn->lastInsertId();
  }
  /**
   * Quotes a string for use in a query.
   *
   * @param mixed $value
   * @return mixed
   */
  public function quote($value) {
    return $this->_conn->quote($value);
  }
  /**
   * Initiates a transaction
   *
   * @return bool
   */
  public function beginTransaction() {
    return $this->_conn->beginTransaction();
  }
  /**
   * Commits a transaction
   *
   * @return bool
   */
  public function commit() {
    return $this->_conn->commit();
  }
  /**
   * Rolls back a transaction
   *
   * @return bool
   */
  public function rollBack() {
    return $this->_conn->rollBack();
  }
  /**
   * Init db connection
   *
   * @param string $host
   * @param string $user
   * @param string $psw
   * @param string $dbname
   * @return bool
   */
  public function connect($host, $user, $psw, $dbname) {
    if (isset($this->_conn) && ($this->_conn instanceof PDO)) {
      return true;
    }
    $dsn = "mysql:host={$host};dbname={$dbname}";
    $this->_conn = new PDO($dsn, $user, $psw);
    $this->_conn->exec("set names 'utf8'");
    return true;
  }
  /**
   * close database connection
   *
   * @return bool
   */
  static public function close() {
    return $this->_conn = null;
  }
}
