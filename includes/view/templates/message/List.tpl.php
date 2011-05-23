<?php $outMessageList = $inData["MessageList"];?>
<?php $listPageHelper = $inData["ListPageHelper"];?>
<?php $outUserList = $inData["UserViewValue"]; ?>
<div class="bodywrap">
 <div style="width: 99%;" id="listbox">
<table class="menutab" cellspacing="0" cellpadding="0" width="90%" border="0">
  <tbody>
	<tr>
			  <td align="center" class="smalltdrow1" width="10%">
				  <?php Language::show("MESSAGE.MESSAGE_ID.LABEL")?>
			  </td>
			  <td align="center" class="smalltdrow1" width="40%">
				  <?php Language::show("MESSAGE.CONTENT.LABEL")?>
			  </td>
			  <td align="center" class="smalltdrow1" width="20%">
				  <?php Language::show("MESSAGE.USER_ID.LABEL")?>
			  </td>
			  <td align="center" class="smalltdrow1" width="15%">
				  <?php Language::show("MESSAGE.TIME.LABEL")?>
			  </td>
			  <td align="center" class="smalltdrow1" width="15%">
				  <?php Language::show("MESSAGE.STATUS.LABEL")?>
			  </td>
			</tr>
<form id="listForm" name="listForm" action="index.php" method="post">
<?php
if(count($outMessageList)>0)
{
//	$rowNum = 0;
	foreach($outMessageList as $outMessage)
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
			<tr>
				  <td align="left" class="smalltdrow2">
<?php echo $outMessage->message_id?>
				  </td>
				  <td align="left" class="smalltdrow2">
<?php echo $outMessage->content?>
				  </td>
				  <td align="left" class="smalltdrow2">
<?php
if(count($outUserList)>0){
	foreach($outUserList as $outUser){
		if($outMessage->user_id==$outUser->user_id){
			echo $outUser->realname;
			break;
		}
	}
}
?>
				  </td>
				  <td align="left" class="smalltdrow2">
<?php echo $outMessage->time?>
				  </td>
				  <td align="left" class="smalltdrow2">
<?php 
if($outMessage->status==Value::STATUS_NOT_SEE){
?> <a id="show_order<?php echo $outMessage->order_id;?>" onclick="showDetail(<?php echo $outMessage->order_id;?>);" class="clickevent" href="index.php?module=orders&action=AjaxView&view_orders_id=<?php echo $outMessage->order_id;?>">未查看</a>
<?php 
}else{
?>
<a id="show_order<?php echo $outMessage->order_id;?>" onclick="showDetail(<?php echo $outMessage->order_id;?>);" class="clickevent" href="index.php?module=orders&action=AjaxView&view_orders_id=<?php echo $outMessage->order_id;?>">已查看</a>
<?php 
}
?>
				  </td>
			</tr>
<?php
	}
}
?>
</form>
		

	<tr>
	<tr>
	  <td class="menumaintopon" colspan="4"><?php Language::show("MESSAGE.LIST.LABEL")?> <?php echo $listPageHelper->pageStat();?></td>
		<td align="left">
<?php echo $listPageHelper->jumpSelect();?>
		</td>
	</tr>
	
  </tbody>
</table>	
</div></div>
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