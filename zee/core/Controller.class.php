<?php
abstract class Controller {
	final public function execute($action) {
		if (strlen(trim($action)) <= 0) {
			$action = Config::DEFAULT_ACTION;
		}
		if (!preg_match('/^[_a-zA-Z][_a-zA-Z0-9]+/', $action)) {
			throw new ErrorException("Can not use the action '{$action}'.");
		}
		$doAction = ucwords(str_replace('_', ' ', $action));
		$doAction = 'do'.str_replace(' ', '', $doAction);
		if (!method_exists($this, $doAction)) {
			$className = get_class($this);
			throw new ErrorException("The action \"$doAction\" not exists in \"$className\" class.");
		}
		if (method_exists($this, 'preExecute')) {
			$this->preExecute();
		}
		$this->$doAction();
		if (method_exists($this, 'postExecute')) {
			$this->postExecute();
		}
	}
}
