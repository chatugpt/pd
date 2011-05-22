<?php
require_once "zee/util/ListPageHelper.class.php";
require_once "service/MessageService.class.php";
require_once "service/UserService.class.php";
require_once "service/OrdersService.class.php";

class MessageController extends Controller {
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

    
    
    $messageCondition = new MessageValue();
    
    if($_SESSION['user_role']==Value::USER_ROLE_ADMIN  or $_SESSION['user_role']==Value::USER_ROLE_ASSIGN ){
    	
    }else{
		$ordersCondition = new OrdersValue();
		$ordersCondition->addAssignCondition('%'.$_SESSION['user_role'].'%',Value::LIKE);
		$ordersService=new OrdersService();
		$ordersList = $ordersService->getList($ordersCondition);
		$orderscondition='';
		foreach ($ordersList as $k=>$v){
			if($k==count($ordersList)-1){
		  		$orderscondition .= $v->order_id;
			}else{
				$orderscondition .= $v->order_id.',';
			}
		}    
        if($orderscondition!=''){
           $messageCondition->addOrderIdCondition($orderscondition,'in');   
        }
    }

    //get data
    $messageService = new MessageService();  
    $userCondition=new UserValue();
    $userService = new UserService();
    $userlist=$userService->getlist($userCondition);   

    $messageCondition->addCondition(' 1=1 ORDER BY `message_id` DESC');
    $messageList = $messageService->getList($messageCondition, $listPageHelper);
    //view
    View::set("UserViewValue", $userlist);
    View::set("MessageList", $messageList);
    View::set("ListPageHelper", $listPageHelper);
    View::display("List");
  }
  public function doNewList() {
    //list
    $listPageHelper = new ListPageHelper();
    $listPageHelper->pageSize = 10;
    $pageNum = intval(Request::get("page"));
    $listPageHelper->pageNum = $pageNum?$pageNum:1;
    //Condition
    $messageCondition = new MessageValue();
    //get data
    $messageService = new MessageService();
    
    $messageCondition->addStatusCondition(Value::STATUS_NOT_SEE,Value::EQUAL);
    $messageCondition->addCondition(' 1=1 ORDER BY `message_id` DESC');
    $messageList = $messageService->getList($messageCondition, $listPageHelper);
    
    $userCondition=new UserValue();
    $userService = new UserService();
    $userlist=$userService->getlist($userCondition);   
    //view
    View::set("UserViewValue", $userlist);
    View::set("MessageList", $messageList);
    View::set("ListPageHelper", $listPageHelper);
    View::display("List");
  }
  public function doCreate() {
    View::display("Create");
  }
  public function doCreateSubmit() {
    $messageService = new MessageService();
    $messageVo = Request::getValue("message", "MessageValue");
    //var_dump($messageVo);exit;
    if (!$messageVo->checkOptions($messageVo->getCreateOptions())) {
      View::set("MessageCreateValue", $messageVo);
      View::display("Create");
      return;
    }
    $messageVo = $messageService->create($messageVo);
    Zee::redirect(Zee::url("message", "list"));
  }
  public function doUpdate() {
    $messageService = new MessageService();
    $messageId = intval(Request::get("update_message_id"));
    $messageVo = $messageService->getByPrimary($messageId);
    View::set("MessageUpdateValue", $messageVo);
    View::display("Update");
  }
  public function doUpdateSubmit() {
    $messageService = new MessageService();
    $messageVo = Request::getValue("message", "MessageValue");
    //var_dump($messageVo);exit;
    if (!$messageVo->checkOptions($messageVo->getCreateOptions())) {
      View::set("MessageUpdateValue", $messageVo);
      View::display("Update");
      return;
    }
    $messageVo = $messageService->updateByPrimary($messageVo);
    Zee::redirect(Zee::url("message", "list"));
  }
  public function doView() {
    $messageService = new MessageService();
    $messageId = intval(Request::get("view_message_id"));
    $messageVo = $messageService->getByPrimary($messageId);
    View::set("MessageViewValue", $messageVo);
    View::display("View");
  }
}
