<?php
require_once "phing/Task.php";
require_once "includes/lib/dao/DBFactory.class.php";
class MyEchoTask extends Task {

	/**
     * The message passed in the buildfile.
     */
	private $message = null;

	/**
     * The setter for the attribute "message"
     */
	public function setMessage($str) {
		$this->message = $str;
	}

	/**
     * The init method: Do init steps.
     */
	public function init() {
		// nothing to do here
	}

	/**
     * The main entry point method.
     */
	public function main() {
		print($this->message);
	}
}

?>