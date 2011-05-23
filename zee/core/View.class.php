<?php
class View {
	const NONE = 'NONE';
	const NOT_LAYOUT = 'NOT_LAYOUT';
	
	static private $_module;
	static private $_layout;
	static private $_body;
	
	static private $_data = array();
	static private $_title;

	static public function setModule($module) {
		self::$_module = $module;
	}
	static public function setTitle($title) {
		self::$_title = $title;
	}

	static public function getBlock($block) {
		$blockFile = 'view/blocks/'.$block;
		return $blockFile;
	}

	static public function getPart($module, $action = null, $params = array()) {
		if(strlen(trim($action)) <= 0) {
			$action = Config::DEFAULT_ACTION;
		}
		$part = Dispatch::getPart($module);
		$part->params = $params;
		//var_dump($params);
		$template = $part->execute($action);
		//var_dump($template);
		include self::getBody("_" . $template);
	}
	static public function display($template, $noLayout=false) {
		$title = self::$_title;
		$inData = self::$_data;
		$body = self::getBody($template);
		if ($noLayout) {
			include $body;
			return;
		}
		//var_dump(self::$_layout);
		include 'view/layout/'.self::$_layout;
	}
	static public function setLayout($layout) {
		self::$_layout = $layout;
	}

	static public function getBody($body) {
		return "view/templates/" . self::$_module . "/{$body}.tpl.php";
	}

	static public function get($name) {
		if (key_exists($name, self::$_data)) {
			return self::$_data[$name];
		} else {
			return null;
		}
	}
	static public function set($name, $value) {
		self::$_data[$name] = $value;
	}
}
