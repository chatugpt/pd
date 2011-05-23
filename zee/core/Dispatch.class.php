<?php
abstract class Dispatch {
	static public function getController($module) {
		if(strlen(trim($module)) <= 0) {
			$module = Config::DEFAULT_MODULE;
		}
		if (!preg_match('/^[_a-zA-Z][_a-zA-Z0-9]+/', $module)) {
			throw new ErrorException('Can not use the module '.$module);
		}
		View::setModule($module);
		$tmpModule = ucwords(str_replace('_', ' ', $module));
		$moduleControllerClass = str_replace(' ', '', $tmpModule).'Controller';
		if (!class_exists($moduleControllerClass)) {
			require_once "controller/{$module}/{$moduleControllerClass}.class.php";
		}
		if (!class_exists($moduleControllerClass)) {
			throw new ErrorException("The class {$moduleControllerClass} no exist, check the file controller/{$module}/{$moduleControllerClass}.class.php");
		}
		$moduleControllerObj = new $moduleControllerClass();
		return $moduleControllerObj;
	}
	static public function getPart($module) {
		if(strlen(trim($module)) <= 0) {
			$module = Config::DEFAULT_MODULE;
		}
		if (!preg_match('/^[_a-zA-Z][_a-zA-Z0-9]+/', $module)) {
			throw new ErrorException('Can not use the module '.$module);
		}
		View::setModule($module);
		$tmpModule = ucwords(str_replace('_', ' ', $module));
		$modulePartClass = '_'.str_replace(' ', '', $tmpModule).'Part';
		if (!class_exists($modulePartClass)) {
			require_once "controller/{$module}/{$modulePartClass}.class.php";
		}
		if (!class_exists($modulePartClass)) {
			throw new ErrorException("The class {$modulePartClass} no exist, check the file controller/{$module}/{$modulePartClass}.class.php");
		}
		$modulePartObj = new $modulePartClass();
		return $modulePartObj;
	}

}