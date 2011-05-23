<?php
class PreFilter extends Filter {
    protected $_moduleList = array('*');
	protected $_excludeModuleList = array();
  public function execute() {
  	 	if(Request::getModule()=='user' and (Request::getAction()=='login' || strtolower(Request::getAction())=='loginsubmit')){	
  	 		
  	 	}else{  	 
  	 		if($_SESSION['user_id']==''){
  	 			     Zee::redirect(Zee::url("user", "login"));
  	 		}
  	 	}
    View::setLayout('default.tpl.php');
  }
}