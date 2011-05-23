<?php
abstract class Part
{
	public $params;
	final public function getParam($name) {
		return (array_key_exists($name, $this->params)?$this->params[$name]:null);
	}
	final public function getParams() {
		return $this->params;
	}

	final public function execute($action)
	{
		if (!preg_match('/^[_a-zA-Z][_a-zA-Z0-9]+/', $action))
		{
			throw new ErrorException("Can not use the part action '{$action}'.");
		}
		$doAction = ucwords(str_replace('_', ' ', $action));
		$doAction = 'do'.str_replace(' ', '', $doAction);
		if (!method_exists($this, $doAction))
		{
			$className = get_class($this);
			throw new ErrorException("The action \"$doAction\" not exists in \"$className\" class.");
		}
		//return
		return $this->$doAction();
	}
}
