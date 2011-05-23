<?php
require_once "phing/Task.php";
require_once "includes/Config.class.php";
class GenerateTack extends Task {

	/**
     * The table passed in the buildfile.
     */
	private $_table = null;
	private $_conn = null;

	/**
     * The setter for the attribute "table"
     */
	public function setTable($str)
	{
		$this->_table = $str;
	}

	/**
     * The init method: Do init steps.
     */
	public function init()
	{
		// nothing to do here
	}

	/**
     * The main entry point method.
     */
	public function main()
	{
		if (!$this->_conn)
		{
			$this->_conn = mysql_connect(Config::DB_HOST , Config::DB_USER , Config::DB_PSW );
			mysql_select_db(Config::DB_NAME , $this->_conn);
		}
		if (!$this->_conn)
		{
			throw new Exception('Mysql connect failing, Please check the config file!');
		}
		if (trim($this->_table)=='*')
		{
			$result = mysql_list_tables(Config::DB_NAME, $this->_conn);
			while ($row = mysql_fetch_row($result)) {
				$fieldList = $this->getAllField($row[0]);
				$table = $fieldList[0]->table;
				foreach ($fieldList as $field) {
				  if ($field->primary_key) {
				    $primaryName = $field->name;
				    break;
				  }
				}
				//mkdir
				$modulePath = "includes/controller/{$table}";
				if (!is_dir($modulePath))
				{
					mkdir($modulePath, 0777);
				}
				//dao
				$this->genDao($fieldList);
				//view
				$this->genView($fieldList);
				//service
				$this->genService($fieldList);
				//module
				$this->genModule($fieldList);
			}
		}
		else
		{
			$fieldList = $this->getAllField(trim($this->_table));
			foreach ($fieldList as $field) {
			  if ($field->primary_key) {
			    $primaryName = $field->name;
			    break;
			  }
			}
			$this->genDao($fieldList);
			//view
			$this->genView($fieldList);
			//service
			$this->genService($fieldList);
			//module
			$this->genModule($fieldList);
		}
	}
	private function querySql($sql)
	{
		$result = mysql_query($sql);
		if (!$result)
		{
			throw new Exception(mysql_error());
		}
		return $result;
	}
	private function getField($table)
	{
		$sql = "select * from {$table}";
		$result = $this->querySql($sql);
		return mysql_fetch_field($result);
	}
	private function getAllField($table)
	{
		$sql = "select * from {$table}";
		$result = $this->querySql($sql);
		$i = 0;
		$fieldList = array();
		while ($i < mysql_num_fields($result)) {
			$field = mysql_fetch_field($result);
			$fieldList[] = $field;
			$i++;
		}
		return $fieldList;
	}
	private function getModuleName($table)
	{
		$str = str_replace('_', ' ', $table);

		$moduleName = str_replace(' ', '', ucwords($str));
		return $moduleName;
	}
	private function getModuleVarName($table)
	{
		$moduleVarName = '';
		$strArray = explode('_', $table);
		foreach ($strArray as $key => $value)
		{
			if ($key == 0)
			{
				$moduleVarName = $value;
				continue;
			}
			$moduleVarName .= ucwords($value);
		}
		return $moduleVarName;
	}
	private function genDao($fieldList)
	{
		$table = $fieldList[0]->table;
		$moduleName = $this->getModuleName($table);
		foreach ($fieldList as $field) {
		  if ($field->primary_key) {
		    $primaryName = $field->name;
		    break;
		  }
		}
		//value base
		$valueBaseString = include 'generator/template/value/ValueBase.tpl.php';
		$valueBaseFile = "includes/value/base/{$moduleName}ValueBase.class.php";
		echo "generating {$valueBaseFile}\n";
		file_put_contents($valueBaseFile, $valueBaseString);
		//value
		$valueFile = "includes/value/{$moduleName}Value.class.php";
		if (!file_exists($valueFile))
		{
			$valueString = include 'generator/template/value/Value.tpl.php';
			echo "generating {$valueFile}\n";
			file_put_contents($valueFile, $valueString);
		}
		return ;
	}
	private function genView($fieldList)
	{
		$table = $fieldList[0]->table;
		$moduleName = $this->getModuleName($table);
		foreach ($fieldList as $field) {
		  if ($field->primary_key) {
		    $primaryName = $field->name;
		    break;
		  }
		}
		$moduleViewPath = "includes/view/templates/{$table}";
		if (!is_dir($moduleViewPath))
		{
			mkdir($moduleViewPath, 0777);
		}
		//create
		$createFile = "{$moduleViewPath}/Create.tpl.php";
		if (!file_exists($createFile))
		{
			$createString = include 'generator/template/view/Create.tpl.php';
			echo "generating {$createFile}\n";
			file_put_contents($createFile, $createString);
		}
		//update
		$updateFile = "{$moduleViewPath}/Update.tpl.php";
		if (!file_exists($updateFile))
		{
			$updateString = include 'generator/template/view/Update.tpl.php';
			echo "generating {$updateFile}\n";
			file_put_contents($updateFile, $updateString);
		}
		//list
		$listFile = "{$moduleViewPath}/List.tpl.php";
		if (!file_exists($listFile))
		{
			$listString = include 'generator/template/view/List.tpl.php';
			echo "generating {$listFile}\n";
			file_put_contents($listFile, $listString);
		}
		//view
		$viewFile = "{$moduleViewPath}/View.tpl.php";
		if (!file_exists($viewFile))
		{
			$viewString = include 'generator/template/view/View.tpl.php';
			echo "generating {$viewFile}\n";
			file_put_contents($viewFile, $viewString);
		}
	}
	private function genService($fieldList)
	{
		$table = $fieldList[0]->table;
		$moduleName = $this->getModuleName($table);
		$moduleVarName = $this->getModuleVarName($table);
		foreach ($fieldList as $field) {
		  if ($field->primary_key) {
		    $primaryName = $field->name;
		    break;
		  }
		}
		//service
		$serviceFile = "includes/service/{$moduleName}Service.class.php";
		if (!file_exists($serviceFile))
		{
			$serviceString = include 'generator/template/service/Service.tpl.php';
			echo "generating {$serviceFile}\n";
			file_put_contents($serviceFile, $serviceString);
		}
	}
	private function genModule($fieldList)
	{
		$table = $fieldList[0]->table;
		//mkdir
		$moduleControllerPath = "includes/controller/{$table}";
		if (!is_dir($moduleControllerPath))
		{
			mkdir($moduleControllerPath, 0777);
		}
		$moduleName = $this->getModuleName($table);
		$moduleVarName = $this->getModuleVarName($table);
		foreach ($fieldList as $field) {
		  if ($field->primary_key) {
		    $primaryName = $field->name;
		    break;
		  }
		}
		//controllerFile
		$controllerFile = "includes/controller/{$table}/{$moduleName}Controller.class.php";
		if (!file_exists($controllerFile))
		{
			$controllerString = include 'generator/template/controller/Controller.tpl.php';
			echo "generating {$controllerFile}\n";
			file_put_contents($controllerFile, $controllerString);
		}
		//partFile
		$partFile = "includes/controller/{$table}/_{$moduleName}Part.class.php";
		if (!file_exists($partFile))
		{
			$partString = include 'generator/template/controller/_Part.tpl.php';
			echo "generating {$partFile}\n";
			file_put_contents($partFile, $partString);
		}
	}
}
