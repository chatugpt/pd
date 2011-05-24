<?php $outOrdersList = $inData["OrdersList"];?>
<?php $listPageHelper = $inData["ListPageHelper"];?>
<?php $projectlist = $inData["Projectlist"];?>
<?php $outUserList = $inData["UserViewValue"]; ?>
<?php $outArea=$inData['Area']; ?>

<div class="bodywrap">
		<div>您好<span class="red strong"><?php if(isset($_SESSION['user_realname'])){
		echo $_SESSION['user_realname'];
	} ?></span><span class="bodywelcome">欢迎使用派单查询系统</span> 您共有<span class="red"><?php echo $listPageHelper->totalRow; ?></span>封派单， 当前模式为<span class="red"><?php echo  $inData["orderListModel"]; ?></span></div>
 <div style="width: 99%;" id="listbox">
<table width="100%" height="24" border="0" cellpadding="0" cellspacing="0" style="display:none;">
	<tr>
		<td align="left" valign="baseline">
			<!--<strong><?php Language::show("ORDERS.LIST.LABEL")?></strong>-->
		</td>
		<td align="right" valign="baseline">
			<input type="button" class="smcreate" onclick="location.href='index.php?module=orders&action=create';" value="<?php Language::show("COMMON.CREATE.LABEL")?>" />
		</td>
	</tr>
	<tr>
	<td align="left" valign="baseline" colspan="2">
		</td>	
	</tr>	
</table>


<table cellspacing="0" cellpadding="0" width="100%" border="0">
		  <tbody>
			<tr>
			  <td align="center" class="smalltdrow1">
				  <?php Language::show("ORDERS.ADDTIME.LABEL")?>
			  </td>
			  <td align="center" class="smalltdrow1">
				  <?php Language::show("ORDERS.CUSTOMER_NAME.LABEL")?>
			  </td>
			  <td align="center" class="smalltdrow1">
				  <?php Language::show("ORDERS.CUSTOMER_ADDRESS.LABEL")?>
			  </td>
			  <td align="center" class="smalltdrow1">
				  <?php Language::show("ORDERS.PROJECT_ID.LABEL")?>
			  </td>
			  <td align="center" class="smalltdrow1">
				  <?php Language::show("ORDERS.HIS.LABEL")?>
			  </td>
			  <td align="center" class="smalltdrow1">
				  <?php Language::show("ORDERS.OPERATE_STATUS.LABEL")?>
			  </td>
			  <td align="center" class="smalltdrow1">
				  <?php Language::show("ORDERS.CONTACT_STATUS.LABEL")?>
			  </td>
			  <td align="center" class="smalltdrow1">
				  <?php Language::show("ORDERS.USER_ID.LABEL")?>
			  </td>

			  <td align="center" class="smalltdrow1">
				  <?php Language::show("ORDERS.INFO.LABEL")?>
			  </td>
			  <td width="114" align="center" class="smalltdrow1"><?php Language::show("COMMON.ACTION.LABEL")?></td>
			</tr>
<form id="listForm" name="listForm" action="index.php" method="post">
<?php
if(count($outOrdersList)>0)
{
//	$rowNum = 0;
	foreach($outOrdersList as $outOrders)
	{
//		$rowNum++;
//		if(($rowNum % 2) == 0)
//		{
//			$rowCssName = "evenRow";
//		}
//		else
//		{
//			$rowCssName = "oddRow";
//		}
?>
			<tr <?php if($outOrders->contact_status==Value::STATUS_NOT_SEE ){ echo 'class="checking"';} ?>>
							  <td align="left" class="smalltdrow2">
<?php echo $outOrders->addtime?>
				  </td>
				  <td align="left" class="smalltdrow2">
<?php echo $outOrders->customer_name?>
				  </td>
				  <td align="left" class="smalltdrow2">
<?php echo $outOrders->customer_address?>
				  </td>

				  <td align="left" class="smalltdrow2">
<?php
if(count($projectlist)>0){
	foreach($projectlist as $project){
		if($outOrders->project_id==$project->project_id){
			echo $project->project_name;
			break;
		}
	}
}
?>
				  </td>
				  <td align="left" class="smalltdrow2">
<?php echo $outOrders->HIS?>
				  </td>
			
				  <td align="left" class="smalltdrow2">
<?php
switch ($outOrders->operate_status){
		case Value::OPERATE_STATUS_OPERATED:
		  echo '已成交';
		  break;
		default:
		  echo '未成交';
}
?>
				  </td>
				  <td align="left" class="smalltdrow2">
<?php
switch ($outOrders->contact_status){
		case Value::CONTACT_STATUS_CONTACTED :
		  echo '已联系';
		  break;
		case Value::CONTACT_STATUS_CANNOT_CONTACT  :
		  echo '无法联系';
		  break;
		default:
		 echo '未联系';
}
?>
				  </td>
				  </td>
				  <td align="left" class="smalltdrow2">
<?php
if(count($outUserList)>0){
	foreach($outUserList as $outUser){
		if($outOrders->user_id==$outUser->user_id){
			echo $outUser->realname;
			break;
		}
	}
}
?>
				  </td>

				  <td align="left" class="smalltdrow2">
<?php echo (strlen($outOrders->info)>50)?Validation::utf8_trim(substr($outOrders->info,0,50)).'...':$outOrders->info;?>
				  </td>

				  <td align="center" class="smalltdrow2">
				  <?php if($outOrders->contact_status==Value::STATUS_SEEM){ ?>
				  <a id="show_order<?php echo $outOrders->order_id;?>" onclick="showDetail(<?php echo $outOrders->order_id;?>);" class="clickevent" href="index.php?module=orders&action=AjaxView&view_orders_id=<?php echo $outOrders->order_id;?>">已查看</a>
				  <?php }else{?>
				  <a id="show_order<?php echo $outOrders->order_id;?>" onclick="showDetail(<?php echo $outOrders->order_id;?>);" class="clickevent" href="index.php?module=orders&action=AjaxView&view_orders_id=<?php echo $outOrders->order_id;?>">未查看</a>
				  <?php }?>
				<?php  if(isset($_SESSION['user_role']) and  $_SESSION['user_role']==Value::USER_ROLE_ADMIN){ ?>
				<a href="index.php?module=orders&action=update&update_orders_id=<?php echo $outOrders->order_id;?>"><?php Language::show("COMMON.EDIT.LABEL")?></a>
				<a onclick="if(confirm('和该派单有关的留言也会一起删除，确认删除该派单？'))location.href='index.php?module=orders&action=delete&delete_orders_id=<?php echo $outOrders->order_id;?>'" href="javascript:void(0);">删除</a>
				<?php } ?>
				</td>
			</tr>
<?php
	}
}
?>
</form>
		  </tbody>
	  </table>
</div>
<div style="display: none; position: fixed; overflow-y: scroll; overflow-x: hidden;" id="tooltipbox">
  </div>
  <div style="display: none; position: fixed;" id="paidanbox">
 
  </div>
<p style="display:none;"><?php Language::show("COMMON.SELECTED_ACTION.LABEL")?>:
			<select id="selectedActions" name="selectedActions" onchange="selectedAction('list_orders_ids[]', this);">
				<option value="" selected><?php Language::show("COMMON.SELECT.LABEL")?>:</option>
				<option value="index.php?module=orders&action=delete_selected">DELETE</option> 
			</select> </p>
<p>	<?php echo $listPageHelper->pageStat();?><?php echo $listPageHelper->jumpSelect();?></p>
			
	</div>
<script language="javascript">
function handler(tp){

}

$(".clickevent").click(function(e){
	e.preventDefault();
})
function showDetail(i){
	href=$("#show_order"+i).attr("href");
	$.get(href,function(data){
	   //ymPrompt.win(data,525,700,'派单详情',handler,null,null,false,allowRightMenu:true);
	   ymPrompt.win({message:data, width:500,height: 700,title: '派单详情',allowSelect:true,allowRightMenu:true});
	})
}
</script>