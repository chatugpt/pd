<?php
abstract class Filter {
	protected $_moduleList = array();
	protected $_excludeModuleList = array();

	public function __construct() {
		//do nothing
	}
	final public function setModlueList($moduleList) {
		$this->_moduleList = $moduleList;
	}
	final public function init() {
		$spaceAllModule = '*';
		$oneModule = Request::getModule();
		//exclude modules
		if (in_array($oneModule, $this->_excludeModuleList)) {
			return ;
		}
		//excute modules
		if (in_array($spaceAllModule, $this->_moduleList) || in_array($oneModule, $this->_moduleList)) {
			$this->execute();
		}
	}
	abstract public function execute();
}
