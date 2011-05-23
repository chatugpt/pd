<?php 
$outOrdersUpdateValue = $inData["OrdersViewValue"];
$outMessageValue = $inData["MessageViewValue"];
$outUserList = $inData["UserViewValue"];
$projectlist = $inData["ProjectViewValue"];
$outArea = $inData["Arealist"];
header('Content-Type: text/html; charset=utf-8');
//echo Language::get("ORDERS.ORDER_ID.LABEL");
echo '<div  id="tooltipbox">
	<p class="userinfo">
	<span id="ico01">'.Language::get("ORDERS.CUSTOMER_NAME.LABEL").'</span>
	<span class="strong">'.$outOrdersUpdateValue->customer_name.Errors::show("CUSTOMER_NAME").'</span>
	<span class="left">'.Language::get("ORDERS.CUSTOMER_SEX.LABEL").':'.$outOrdersUpdateValue->sex.'</span>
	</p>
<form name="actionForm" action="'.zee::url('orders', "ajax_submit") .'" method="post">';
echo '<input type="hidden"  name="orders_order_id" value="'.$outOrdersUpdateValue->order_id.'" />'; Errors::show("ORDER_ID");
echo '<p>
	  <span class="left">'.Language::get("ORDERS.CUSTOMER_ADDRESS.LABEL").'</span><span>'.$outOrdersUpdateValue->customer_address.Errors::show("CUSTOMER_ADDRESS").'</span>
	  <span class="left">'. Language::get("ORDERS.ASSIGN.LABEL").'</span><span>';Errors::show("ASSIGN");
$outOrdersUpdateValueAssign=explode(',',$outOrdersUpdateValue->assign);
if(count($outArea)>0){
	foreach($outArea as $outAreaInfo){
		if(in_array($outAreaInfo->area_id,$outOrdersUpdateValueAssign)){
			echo $outAreaInfo->area_name.',';
		}
	}
}

echo '</span>
   </p>  
   <p>
      <span class="left">'.Language::get("ORDERS.PROJECT_ID.LABEL").'</span><span>';
if(count($projectlist)>0){
	foreach($projectlist as $project){
		if($outOrdersUpdateValue->project_id==$project->project_id){
			echo $project->project_name;
			break;
		}
	}
}
echo '</span>
      <span class="left">'.Language::get("ORDERS.MOBILE.LABEL").'</span><span>'. $outOrdersUpdateValue->mobile.Errors::show("MOBILE").'</span>
   </p>
   <p>
     <span class="left">'.Language::get("ORDERS.HIS.LABEL").'</span><span><input type="text" class="textinput" name="orders_HIS" value="'. $outOrdersUpdateValue->HIS.'" />'.Errors::show("HIS").'</span><span class="left"></span>
   </p>				
   <p id="oldcheck">
      <span class="left">'.Language::get("ORDERS.OPERATE_STATUS.LABEL").'</span>
<input name="orders_operate_status" type="radio" value="'.Value::OPERATE_STATUS_NOT_OPERATE.'" '.($outOrdersUpdateValue->operate_status==Value::OPERATE_STATUS_NOT_OPERATE?'checked':'').' />未成交 
<input name="orders_operate_status" type="radio" value="'.Value::OPERATE_STATUS_OPERATED.'"  '.($outOrdersUpdateValue->operate_status==Value::OPERATE_STATUS_OPERATED?'checked':'').'/>已成交    
  </p>
  <p><span class="left">'.Language::get("ORDERS.CONTACT_STATUS.LABEL").'</span>
<select name="orders_contact_status">
  <option value="'.Value::CONTACT_STATUS_NOT_CONTACT .'" '.($outOrdersUpdateValue->contact_status==Value::CONTACT_STATUS_NOT_CONTACT?'selected="selected"':'').'>未联系</option>
  <option value="'.Value::CONTACT_STATUS_CONTACTED  .'" '.($outOrdersUpdateValue->contact_status==Value::CONTACT_STATUS_CONTACTED?'selected="selected"':'').'>已联系</option>
  <option value="'.Value::CONTACT_STATUS_CANNOT_CONTACT .'" '.($outOrdersUpdateValue->contact_status==Value::CONTACT_STATUS_CANNOT_CONTACT?'selected="selected"':'').'>无法联系</option>
</select>

  </p>
  <p id="timearea0">
     <span class="left">'.Language::get("ORDERS.CONTACT_TIME.LABEL").'</span><span id="timearea"><input type="text" class="textinput" name="orders_contact_time" value="'. $outOrdersUpdateValue->contact_time.'" onClick="WdatePicker()"/>'.Errors::show("CONTACT_TIME").'</span>
  </p>
  <p>
    <span class="left">'.Language::get("ORDERS.OPERATE_TIME.LABEL").'</span><span><input type="text" class="textinput" name="orders_operate_time" value="'. $outOrdersUpdateValue->operate_time.'" onClick="WdatePicker()"/>'.Errors::show("OPERATE_TIME").'</span>
 </p>
  <p>
  <span class="left">'.Language::get("ORDERS.OPERATE_PRICE.LABEL").'</span><input type="text" class="textinput" name="orders_operate_price" value="'. $outOrdersUpdateValue->operate_price.'" />'.Errors::show("OPERATE_PRICE").'元
  </p>
   <p>
    <span class="left">'.Language::get("ORDERS.INFO.LABEL").'</span>
    '.$outOrdersUpdateValue->info.'
  </p>
  <ul class="comm">';
if(count($outMessageValue)>0){
	foreach($outMessageValue as $outMessage){
		if(count($outUserList)>0){
			foreach($outUserList as $outUser){
				if($outMessage->user_id==$outUser->user_id){
					$user_name=$outUser->realname;
					break;
				}
			}
		}
		if(!isset($user_name)){$user_name='未知用户';}
     echo '<li class="work"><h4>客服 '.$user_name.' 留言</h4><p>留言时间:'.$outMessage->time.' </p><p>'.$outMessage->content.'</p></li>';
	}
}
echo '</ul>
   <p><span class="left">添加新留言:</span><textarea class="inputEdit" name="message_content"></textarea></p>	<p id="submitbox">
   <input type="submit" value="提交修改" class="btn" name="sub"></p></form>
	<span class="clear"></span>
</div></form>';