<?php
require_once "zee/util/ListPageHelper.class.php";
require_once "service/OrdersService.class.php";
require_once "service/ProjectService.class.php";
require_once "service/UserService.class.php";
require_once "service/MessageService.class.php";
require_once "service/AreaService.class.php";

class OrdersController extends Controller {
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
    $ordersCondition = new OrdersValue();
    if($_SESSION['user_role']==Value::USER_ROLE_ADMIN  or $_SESSION['user_role']==Value::USER_ROLE_ASSIGN ){
    	
    }else{
       $ordersCondition->addAssignCondition('%'.$_SESSION['user_role'].'%',Value::LIKE);
    }
    //派单显示的模式
    $orderListModel='所有派单';
    switch (Request::get('type')){
    	case 'today':
    		$ordersCondition->addAddtimeCondition(date("Y-m-d H:i:s",mktime(23,59,59,date('m'),date('d')-1)),Value::GREATER_THAN);
    		$orderListModel='今日派单';
    		break;
    	case 'week':
			//设置星期
			if(date('w')==0)
			{
				$w=6;
			}else{
				$w=date('w')-1;
			}
    		$ordersCondition->addAddtimeCondition(date("Y-m-d H:i:s",mktime(0,0,0,date('m'),date('d')-$w)),Value::GREATER_EQUAL);
    		$orderListModel='本周派单';
    		break;
    	case 'month':
    		$ordersCondition->addAddtimeCondition(date("Y-m-d H:i:s",mktime(0,0,0,date('m'),1)),Value::GREATER_EQUAL);
    		$orderListModel='本月派单';
    		break;  
    	case 'year':
    		$ordersCondition->addAddtimeCondition(date("Y-m-d H:i:s",mktime(0,0,0,1,1,date('y'))),Value::GREATER_EQUAL);
    		$orderListModel='今年派单';
    		break; 
    	//成交状态
    	case 'isop':
    		$ordersCondition->addOperateStatusCondition(Value::OPERATE_STATUS_OPERATED,Value::EQUAL );
    		$orderListModel='已经成交的派单';
    		break; 
    	case 'notop':
    		$ordersCondition->addOperateStatusCondition(Value::OPERATE_STATUS_NOT_OPERATE ,Value::EQUAL );
    		$orderListModel='未成交的派单';
    		break;
    	//是否查看
    	case 'isview':
    		$orderListModel='已经查看过的派单';
    		$ordersCondition->addStatusCondition(Value::STATUS_SEEM ,Value::EQUAL);
    		break; 
    	case 'notview':
    		$orderListModel='未查看过的派单';
    		$ordersCondition->addStatusCondition(Value::STATUS_NOT_SEE ,Value::EQUAL);
    		break;
    	    	//联系状态
    	case 'c'.Value::CONTACT_STATUS_CANNOT_CONTACT :
    		$ordersCondition->addContactStatusCondition(Value::CONTACT_STATUS_CANNOT_CONTACT,Value::EQUAL );
    		$orderListModel='无法联系的派单';
    		break; 	
    	case 'c'.Value::CONTACT_STATUS_CONTACTED :
    		$ordersCondition->addContactStatusCondition(Value::CONTACT_STATUS_CONTACTED,Value::EQUAL );
    		$orderListModel='已经联系的派单';
    		break; 
    	case 'c'.Value::CONTACT_STATUS_NOT_CONTACT  :
    		$ordersCondition->addContactStatusCondition(Value::CONTACT_STATUS_NOT_CONTACT,Value::EQUAL );
    		$orderListModel='未联系的派单';
    		break; 
       // page from search//
       
    	case 'time':
    		//按时间范围搜索
    		$start=Request::get('start');
    		$end=Request::get('end');
    		if($start=='' or $end==''){
    			Zee::redirect(Zee::url('orders','search'));
    		}else{
    			$ordersCondition->addAddtimeCondition($start,Value::GREATER_EQUAL);
    			$ordersCondition->addAddtimeCondition($end,Value::LESS_EQUAL);
    		    $orderListModel='时间段 '.$start.' 到 '.$end.'的派单';
    		}
    		break;        	
    	case 'mobile':
    		$mobile=Request::get('num');
    		if($mobile==''){
    			Zee::redirect(Zee::url('orders','search'));
    		}else{
    			$ordersCondition->addMobileCondition($mobile,Value::LIKE);
    			$ordersCondition->addCondition('1=1 or `orders`.telephone '.Value::LIKE.' \''.$mobile.' \'');
    			//也查找一下固定电话 			
    		}
    		$orderListModel='手机号(或者固定电话)为 '.$mobile.' 的派单';
    		break; 
    	case 'his':
    		$his=Request::get('his');
    		if($his==''){
    			Zee::redirect(Zee::url('orders','search'));
    		}else{
    			$ordersCondition->addHISCondition($his,Value::LIKE);
    		}
    		$orderListModel='HIS为 '.$his.' 的派单';
    		break;     		
    	case 'orderid' :
    		$orderid=Request::get('num');
    		if($orderid==''){
    			Zee::redirect(Zee::url('orders','search'));
    		}else{
    			$ordersCondition->addOrderIdCondition($orderid,Value::LIKE);
    		}    		
    		$orderListModel='派单ID为 '.$orderid .' 的派单';
    		break; 
    	case 'project':
    		//按项目名称
    		$project=Request::get('project');
    		if($project==''){
    			Zee::redirect(Zee::url('orders','search'));
    		}else{
    			$ordersCondition->addProjectIdCondition($project,Value::EQUAL );
    		}
				$projectService = new ProjectService();
				$projectInfo = $projectService->getByPrimary($project);    		
    		    $orderListModel='项目为 '. $projectInfo->project_name .' 的派单';
    		break; 
    	case 'name':
    		//按客户名称
    		$name=Request::get('name');
    		if($name==''){
    			Zee::redirect(Zee::url('orders','search'));
    		}else{
    			$ordersCondition->addCustomerNameCondition($name,Value::LIKE);
    		}    		
    		$orderListModel='顾客用户姓名为 '. $name .' 的派单';
    		break; 
    	case 'newtime':
    		//按最新留言时间
    		$time=Request::get('time');
    		if($time==''){
    			Zee::redirect(Zee::url('orders','search'));
    		}else{
				$messageCondition = new MessageValue();
				$messageCondition->addTimeCondition($time.' 00:00:00',Value::GREATER_EQUAL);
				$messageCondition->addTimeCondition($time.' 23:59:59',Value::LESS_EQUAL);
				//var_dump($messageCondition->conditions);
				//get data
				$messageService = new MessageService();
				$messageList = $messageService->getList($messageCondition);
				$ConditionStr='';
				if(count($messageList)>0){
					foreach ($messageList as $messageKey => $messageValue){
					   if($messageKey==(count($messageList)-1)){
					   	   $ConditionStr.=$messageValue->order_id;
					   }else{
					   	   $ConditionStr.=$messageValue->order_id.",";
					   }		 
					}
				}
				if($ConditionStr!=''){
					//$ConditionStr='('.$ConditionStr.')';
					//echo $ConditionStr;
				   $ordersCondition->addOrderIdCondition($ConditionStr,'in');
				   //print_r($ordersCondition->conditions);
				   $orderListModel='留言时间 为 '.$time.' 的派单';
				}else{
				  //如果没有查找到 该日期的留言 
				   $ordersCondition->addOrderIdCondition(0,Value::LESS_THAN);
				}
    		}   
    		break; 
    	case 'comment':
    		//按 留言时间段
    		$start=Request::get('start');
    		$end=Request::get('end');
    		if($start=='' or $start==''){
    			Zee::redirect(Zee::url('orders','search'));
    		}else{
				$messageCondition = new MessageValue();
				$messageCondition->addTimeCondition($start.' 00:00:00',Value::GREATER_EQUAL);
				$messageCondition->addTimeCondition($end.' 23:59:59',Value::LESS_EQUAL);
				//var_dump($messageCondition->conditions);
				//get data
				$messageService = new MessageService();
				$messageList = $messageService->getList($messageCondition);
				$ConditionStr='';
				if(count($messageList)>0){
					foreach ($messageList as $messageKey => $messageValue){
					   if($messageKey==(count($messageList)-1)){
					   	   $ConditionStr.=$messageValue->order_id;
					   }else{
					   	   $ConditionStr.=$messageValue->order_id.",";
					   }		 
					}
				}
				if($ConditionStr!=''){
					//$ConditionStr='('.$ConditionStr.')';
					//echo $ConditionStr;
				   $ordersCondition->addOrderIdCondition($ConditionStr,'in');
				   //print_r($ordersCondition->conditions);
				   $orderListModel='留言时间 为 '.$start.' 到 '. $end .' 的派单';
				}else{
				  //如果没有查找到 该日期的留言 
				   $ordersCondition->addOrderIdCondition(0,Value::LESS_THAN);
				}
    		}   
    		break;     
    	case 'timearea' :
    		//联系时间
    		$start=Request::get('start');
    		$end=Request::get('end');
    		if($start=='' or $start==''){
    			Zee::redirect(Zee::url('orders','search'));
    		}else{
                $ordersCondition->addContactTimeCondition($start,Value::GREATER_EQUAL);
                $ordersCondition->addContactTimeCondition($end,Value::LESS_EQUAL);
				$orderListModel='联系时间 为 '.$start.' 到 '. $end .' 的派单';

    		}   
    		break;   
    }
    //get data
    $ordersService = new OrdersService();

    $userCondition=new UserValue();
    $userService = new UserService();
    $userlist=$userService->getlist($userCondition);   
    //get project
    $projectCondition = new ProjectValue();
    $projectService = new ProjectService();
    $projectlist = $projectService->getList($projectCondition);
    $ordersCondition->addCondition('1=1 ORDER BY `order_id` DESC');
    $ordersList = $ordersService->getList($ordersCondition, $listPageHelper);
    
    $areaService= new AreaService();
    $arealist=$areaService->getList(new AreaValue());
    
    //var_dump($messageVo);
    // print_r($arealist);
     View::set('Area',$arealist);
    //view
    View::set("orderListModel",$orderListModel);
    View::set("UserViewValue", $userlist);
    View::set("OrdersList", $ordersList);
    View::set("Projectlist",$projectlist);
    View::set("ListPageHelper", $listPageHelper);
    View::display("List");
  }
  public function doCreate() {
    $projectService = new ProjectService();
    $projectlist = $projectService->getList(new ProjectValue());

    $areaService = new AreaService();
    $arealist = $areaService->getList(new AreaValue());
  	View::set("Arealist",$arealist); 
  	View::set("Projectlist",$projectlist);
    View::display("Create");
  }
  public function doCreateSubmit() {
    $ordersService = new OrdersService();
    $ordersVo = Request::getValue("orders", "OrdersValue");
    $ordersAssign=(Request::get('orders_assign'));
    if(count($ordersAssign)>0){
    	$ordersVo->assign=implode(',',$ordersAssign);
    }else{
    	$ordersVo->assign='';
    }
    $ordersVo->addtime=date("Y-m-d H:i:s");
    $ordersVo->user_id=$_SESSION['user_id'];               
    $ordersVo->status=Value::STATUS_NOT_SEE;
    $ordersVo->operate_status=Value::OPERATE_STATUS_NOT_OPERATE ;
    $ordersVo->contact_status=Value::CONTACT_STATUS_NOT_CONTACT ;
    //var_dump($ordersVo);exit;
    if($ordersVo->mobile=='' and $ordersVo->telephone ==''){
    	//如果同时为空
    	   Errors::addError('手机和电话至少要填一个', 'MOBILE');
    	   $flag_mobile=true;
    }
    if (!$ordersVo->checkOptions($ordersVo->getCreateOptions()) or $flag_mobile) {
		$projectService = new ProjectService();
		$projectlist = $projectService->getList(new ProjectValue());
		
		$areaService = new AreaService();
		$arealist = $areaService->getList(new AreaValue());
		
		View::set("Arealist",$arealist); 
		View::set("Projectlist",$projectlist);
		View::set("OrdersCreateValue", $ordersVo);
		View::display("Create");
		return;
    }
    $ordersVo = $ordersService->create($ordersVo);
    Zee::redirect(Zee::url("orders", "list"));
  }
  public function doUpdate() {
    $projectService = new ProjectService();
    $projectlist = $projectService->getList(new ProjectValue());
    
    $areaService = new AreaService();
    $arealist = $areaService->getList(new AreaValue());
    
    $ordersService = new OrdersService();
    $ordersId = intval(Request::get("update_orders_id"));
    $ordersVo = $ordersService->getByPrimary($ordersId);
    
    $userService= new UserService();
    $userVo=$userService->getList(new UserValue()); 
    
  	View::set("UserList",$userVo);     
    View::set("OrdersUpdateValue", $ordersVo);
  	View::set("Arealist",$arealist); 
  	View::set("Projectlist",$projectlist);
    View::display("Update");
  }
  public function doUpdateSubmit() {
    $ordersService = new OrdersService();
    $ordersVo = Request::getValue("orders", "OrdersValue");
    $ordersAssign=(Request::get('orders_assign'));
    if(count($ordersAssign)>0){
    	$ordersVo->assign=implode(',',$ordersAssign);
    }else{
    	$ordersVo->assign='';
    }
    //var_dump($ordersVo);exit;
    if (!$ordersVo->checkOptions($ordersVo->getCreateOptions())) {
      View::set("OrdersUpdateValue", $ordersVo);
      View::display("Update");
      return;
    }
    $ordersVo = $ordersService->updateByPrimary($ordersVo);
    Zee::redirect(Zee::url("orders", "list"));
  }
  public function doView() {
    $ordersService = new OrdersService();
    $ordersId = intval(Request::get("view_orders_id"));
    $ordersVo = $ordersService->getByPrimary($ordersId);
    View::set("OrdersViewValue", $ordersVo);
    View::display("View");
  }
  public  function doSearch(){
    $projectCondition = new ProjectValue();
    $projectService = new ProjectService();
    $projectlist = $projectService->getList($projectCondition);
  	View::set("Projectlist",$projectlist);
  	View::display("Search");
  }
  public function doAjaxSubmit() {
    $ordersService = new OrdersService();
    $ordersVo = Request::getValue("orders", "OrdersValue");
/*    if (!$ordersVo->checkOptions($ordersVo->getCreateOptions())) {
      View::set("OrdersUpdateValue", $ordersVo);
      View::display("Update");
      return;
    }*/
    $ordersVo = $ordersService->updateByPrimary($ordersVo);
    if(Request::get('message_content')!=''){
    	$messageVo = new MessageValue();
    	$messageVo->content=Request::get('message_content');
    	$messageVo->order_id=Request::get('orders_order_id');
    	$messageVo->user_id=$_SESSION['user_id'];                       
    	$messageVo->time=date("Y-m-d H:i:s");
    	$messageVo->status=Value::STATUS_NOT_SEE;
    	$messageService = new MessageService();
    	$messageVo = $messageService->create($messageVo);
    }
    Zee::redirect(Zee::url("orders", "list"));
  }
  public function doAjaxView() {
    $ordersService = new OrdersService();
    $messageService = new MessageService();
    $ordersId = intval(Request::get("view_orders_id"));
    

    //将 该派单设置为 已经查看 
    Zee::registry("DB")->exec('update orders set status='.Value::STATUS_SEEM .' where order_id= '.$ordersId);
    //将 该派单的留言设置为 已经查看
    Zee::registry("DB")->exec('update message set status='.Value::STATUS_SEEM .' where order_id= '.$ordersId);

    $ordersVo = $ordersService->getByPrimary($ordersId);
    $messageVo=$messageService->getByOderid($ordersId);

    $userCondition=new UserValue();
    $userService = new UserService();
    $userlist=$userService->getlist($userCondition);

    $projectCondition = new ProjectValue();
    $projectService = new ProjectService();
    $projectlist = $projectService->getList($projectCondition);
    
	$areaService = new AreaService();
	$arealist = $areaService->getList(new AreaValue());

    //var_dump($messageVo);
	 View::set("Arealist",$arealist); 
     View::set("ProjectViewValue",$projectlist);
     View::set("UserViewValue",$userlist);
     View::set("MessageViewValue",$messageVo);
     View::set("OrdersViewValue",$ordersVo);
     View::display("AjaxView");

  }
  public function doSearchOrderByPhone() {
    $ordersService = new OrdersService();
    $messageService = new MessageService();
    
    $ordersCondition=new OrdersValue();
    
	$mobile=Request::get('num');
	if($mobile!='')
	{
	  $ordersCondition->addMobileCondition("%$mobile%",Value::LIKE);			
	}
	
	$orderListModel='手机号(或者固定电话)为 '.$mobile.' 的派单';

    $ordersVo = $ordersService->getByPrimary($ordersId);
    $messageVo=$messageService->getByOderid($ordersId);

    $userCondition=new UserValue();
    $userService = new UserService();
    
    $userlist=$userService->getlist($userCondition);

    $projectCondition = new ProjectValue();
    $projectService = new ProjectService();
    $projectlist = $projectService->getList($projectCondition);
    
	$areaService = new AreaService();
	$arealist = $areaService->getList(new AreaValue());
	
	$ordersList = $ordersService->getList($ordersCondition);
	
	if($mobile!='')
	{
	  $ordersCondition->addTelephoneCondition("%$mobile%",Value::LIKE);			
	}
	$ordersList2 = $ordersService->getList($ordersCondition);
	
	if(is_array($ordersList) and is_array($ordersList2)){
			$ordersList=array_merge($ordersList,$ordersList2);
	}elseif(is_array($ordersList2)){
		$ordersList=$ordersList2;
	}
    if(count($ordersList)>0){
    	echo '<table width="480">
    	       <tr>
    	         <td>姓名</td>
    	         <td>顾客地址</td>
    	         <td>详细情况</td>
    	         <td>电话</td>
    	         <td>手机</td>
    	         <td>操作</td>
    	       </tr>';
    	foreach ($ordersList as $k=>$v){
            echo '<tr>
    	         <td>'.$v->customer_name.'</td>
    	         <td>'.$v->customer_address.'</td>
    	         <td>'.$v->telephone.'</td>
    	         <td>'.$v->mobile.'</td>
    	         <td>'.Validation::utf8_trim(substr($v->info,0,25)).'</td>
    	         <td>
				  <a id="show_order'.$v->order_id.'" onclick="showDetail(\'index.php?module=orders&action=AjaxView&view_orders_id='.$v->order_id.'\')" class="clickevent" >查看</a>
				</td>
    	       </tr>';
    	}
    	echo '</table>';
    	echo '
<script language="javascript">
$(".clickevent").click(function(e){
	e.preventDefault();
})

function showDetail(url){
ymPrompt.close();
 href=url;
 $.get(href,function(data){
 ymPrompt.win({message:data, width:500,height: 700,title: "派单详情",allowSelect:true,allowRightMenu:true});
})
} 
</script>';
    }else{
    	echo '0';
    }
   
  }
  public function doExport() {
	// create a simple 2-dimensional array
	if(Request::get('type')=='time'){
    $ordersService = new OrdersService();

    $userCondition=new UserValue();
    $userService = new UserService();
    
    $ordersCondition=new OrdersValue();
    
    $userlist=$userService->getlist($userCondition);   
    //get project
    $projectCondition = new ProjectValue();
    $projectService = new ProjectService();
    $projectlist = $projectService->getList($projectCondition);
    
	//按时间范围搜索
	$start=Request::get('start');
	$end=Request::get('end');
	$orderListModel='所有派单';
	if($start!='' and $end!=''){
		$ordersCondition->addAddtimeCondition($start,Value::GREATER_EQUAL);
		$ordersCondition->addAddtimeCondition($end,Value::LESS_EQUAL);
	    $orderListModel='从'.$start.' 到 '.$end.'的派单';
	}elseif($end=='' and $start!=''){
		$ordersCondition->addAddtimeCondition($end,Value::LESS_EQUAL);
	    $orderListModel='从'.$start.' 到 今天 的派单';		
	}
    
    $ordersCondition->addCondition('1=1 ORDER BY `order_id` DESC');
    $ordersList = $ordersService->getList($ordersCondition, $listPageHelper);
    
    $areaService= new AreaService();
    $arealist=$areaService->getList(new AreaValue());
    
    $array_top=array();
    
    $array_top=array(Language::get("ORDERS.ADDTIME.LABEL"),
				    Language::get("ORDERS.CUSTOMER_NAME.LABEL"),
					Language::get("ORDERS.CUSTOMER_ADDRESS.LABEL"),
					Language::get("ORDERS.PROJECT_ID.LABEL"),
					Language::get("ORDERS.HIS.LABEL"),
					Language::get("ORDERS.OPERATE_STATUS.LABEL"),
					Language::get("ORDERS.CONTACT_STATUS.LABEL"),
					Language::get("ORDERS.USER_ID.LABEL"),
					Language::get("ORDERS.INFO.LABEL")
	);
	
	$data[]=$array_top;

    if(count($ordersList)>0){
    	foreach($ordersList as $k=>$v){
			if(count($projectlist)>0){
				foreach($projectlist as $project){
			    	if($v->project_id==$project->project_id){
			        	 $project=$project->project_name;
			        	break;
			        }
			    }
			}
			switch ($v->operate_status){
				case Value::OPERATE_STATUS_NOT_OPERATE:
					$operate_status='未成交';
					break;
				case Value::OPERATE_STATUS_OPERATED:
					$operate_status='已成交';
					break;
			}
			switch ($v->contact_status){
				case Value::CONTACT_STATUS_CANNOT_CONTACT :
					$contact_status='无法联系';
					break;
				case Value::CONTACT_STATUS_CONTACTED :
					$contact_status='已联系';
					break;
				case Value::CONTACT_STATUS_NOT_CONTACT  :
					$contact_status='未联系';
					break;
			}
			if(count($userlist)>0){
				foreach($userlist as $outUser){
					if($v->user_id==$outUser->user_id){
						$user=$outUser->realname;
						break;
					}
				}
			}
    		$data[]=array($v->addtime,
    		              $v->customer_name,
    		              $v->customer_address,
    		              $project,
    		              $v->HIS,
    		              $operate_status,
    		              $contact_status,
    		              $user,
    		              $v->info); 	
    	}
    }	
	// generate file (constructor parameters are optional)
	$xls = new Excel_XML('UTF-8', false, $orderListModel);
	$xls->addArray($data);
	$xls->generateXML('paidan');	  
	}else{
	  View::display('Export');
	}
  }
}
