<?php
require_once "zee/util/ListPageHelper.class.php";
require_once "service/UserService.class.php";

class UserController extends Controller {
  public function doIndex() {
    $this->doList();
  }
  public function doList() {
    //list
    $listPageHelper = new ListPageHelper();
    $listPageHelper->pageSize = 10;
    $pageNum = intval(Request::get("page"));
    $listPageHelper->pageNum = $pageNum?$pageNum:1;
    //Condition
    $userCondition = new UserValue();
    //get data
    $userService = new UserService();
    $userList = $userService->getList($userCondition, $listPageHelper);
    //view
    View::set("UserList", $userList);
    View::set("ListPageHelper", $listPageHelper);
    View::display("List");
  }
  public function doCreate() {
    View::display("Create");
  }
  public function doDelete() {
    $userId = intval(Request::get("delete_user_id"));
    Zee::registry("DB")->exec('delete from user  where user_id= '.$userId);
    Zee::redirect(Zee::url("user", "list"));
  }
  public function doCreateSubmit() {
    $userService = new UserService();
    $userVo = Request::getValue("user", "UserValue");
    if($userVo->password!=''){
    	$userVo->password=MD5($userVo->password);
    }
    //var_dump($userVo);exit;
    if (!$userVo->checkOptions($userVo->getCreateOptions())) {
      View::set("UserCreateValue", $userVo);
      View::display("Create");
      return;
    }
    $userVo = $userService->create($userVo);
    Zee::redirect(Zee::url("user", "list"));
  }
  public function doUpdate() {
    $userService = new UserService();
    $userId = intval(Request::get("update_user_id"));
    $userVo = $userService->getByPrimary($userId);
    View::set("UserUpdateValue", $userVo);
    View::display("Update");
  }
  public function doUpdateSubmit() {
    $userService = new UserService();
    $userVo = Request::getValue("user", "UserValue");
    if($userVo->user_id==''){
    	$userVo->user_id=$_SESSION['user_id'];
    }
	if(trim($userVo->password)!=''){
	    $userVo->password=MD5($userVo->password);
	}
    if (!$userVo->checkOptions($userVo->getUpdateOptions())) {
      View::set("UserUpdateValue", $userVo);
      View::display("Update");
      return;
    }
    $userVo = $userService->updateByPrimary($userVo);
    Zee::redirect(Zee::url("user", "list"));  
  }
  public function doEditSubmit() {
    $userService = new UserService();
    $userVo = Request::getValue("user", "UserValue");
    $userVo->user_id=$_SESSION['user_id'];
	if(trim($userVo->password)!=''){
	    $userVo->password=MD5($userVo->password);
	}
    if (!$userVo->checkOptions($userVo->getUpdateOptions())) {
      View::set("UserUpdateValue", $userVo);
      View::display("Edit");
      return;
    }
    $userVo = $userService->updateByPrimary($userVo);
    View::set('message','<div class="success_box">更新成功</div>');
    View::set("UserUpdateValue", $userVo);
     View::display("Edit");
  }

  public function doView() {
    $userService = new UserService();
    $userId = intval(Request::get("view_user_id"));
    $userVo = $userService->getByPrimary($userId);
    View::set("UserViewValue", $userVo);
    View::display("View");
  }
  public function doLogin() {
  	if(isset($_SESSION['user'])){
  		Errors::addError('已经登陆，请先退出再登陆！','login');
  	}
    View::display("Login");
  }
  public function doLoginSubmit() {
    $username = Request::get("username");
    $password = Request::get("password");
    
    $userService = new UserService();
    $userValue = new UserValue();
    $userValue->addUsernameCondition($username,Value::LIKE);
    $userValue->addPasswordCondition(md5($password),Value::EQUAL);
    $userVo=Zee::registry("DB")->fetch($userValue);
    if($userVo==false){
    	 Errors::addError('用户名密码错误','login');
    	 View::display("Login");
    }else{
    	//$_SESSION['user']=$userVo;
    	$_SESSION['user_id']=$userVo->user_id;
    	$_SESSION['user_role']=$userVo->role;
    	$_SESSION['user_realname']=$userVo->realname;
    	Zee::redirect(Zee::url("index",'index'));
    }
  }
  public function doLogOut() {
     unset($_SESSION['user']);
     unset($_SESSION['user_role']);
     unset($_SESSION['user_realname']);
     Zee::redirect(Zee::url("user", "login"));
  }
  public function doEdit() {
    $userService = new UserService();
    $userId=$_SESSION['user_id'];
    $userVo = $userService->getByPrimary($userId);
    View::set("UserUpdateValue", $userVo);
    View::display("Edit");
  }
}
