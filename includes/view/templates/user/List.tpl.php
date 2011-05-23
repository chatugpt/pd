<?php $outUserList = $inData["UserList"];?>
<?php $listPageHelper = $inData["ListPageHelper"];?>
<div class="bodywrap"> <div id="listbox" style="width: 99%;">


<table class="menutab" cellspacing="0" cellpadding="0" width="100%" border="0">
  <tbody>
	<tr>
	  <td class="menumaintopon" colspan="4"><?php Language::show("USER.LIST.LABEL")?> </td>
       <td class="menumaintopon" colspan="4"><a href="index.php?module=user&action=create">添加新用户</a>
	</tr>
			<tr>
			  <td align="center" class="smalltdrow1">
				  <?php Language::show("USER.USER_ID.LABEL")?>
			  </td>
<td align="center" class="smalltdrow1">
				  <?php Language::show("USER.ROLE.LABEL")?>
			  </td>
			  <td align="center" class="smalltdrow1">
				  <?php Language::show("USER.USERNAME.LABEL")?>
			  </td>
			  <td align="center" class="smalltdrow1">
				  <?php Language::show("USER.REALNAME.LABEL")?>
			  </td>
			  <td width="114" align="center" class="smalltdrow1"><?php Language::show("COMMON.ACTION.LABEL")?></td>
			</tr>
<form id="listForm" name="listForm" action="index.php" method="post">
<?php
if(count($outUserList)>0)
{
//	$rowNum = 0;
	foreach($outUserList as $outUser)
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
<?php echo $outUser->user_id?>
				  </td>
				  <td align="left" class="smalltdrow2">
<?php 
if($outUser->role==Value::USER_ROLE_ADMIN ){
	echo '管理员';
}else{
	echo '普通用户';
}?>
				  </td>
				  <td align="left" class="smalltdrow2">
<?php echo $outUser->username?>
				  </td>
				  <td align="left" class="smalltdrow2">
<?php echo $outUser->realname?>
				  </td>
				  <td align="center" class="smalltdrow2">
				<a href="index.php?module=user&action=update&update_user_id=<?php echo $outUser->user_id;?>"><?php Language::show("COMMON.EDIT.LABEL")?></a>   <a onclick="if(confirm('确认删除？'))location.href='index.php?module=user&action=delete&delete_user_id=<?php echo $outUser->user_id;?>'" href="javascript:void(0);">删除</a>
				</td>
			</tr>
<?php
	}
}
?>
</form>
	

	<tr>
		<td align="left" class="smalltdrow2" colspan="4">
			<?php echo $listPageHelper->pageStat();?>
		</td>
		<td align="right" class="smalltdrow2">
<?php echo $listPageHelper->jumpSelect();?>
		</td>
	</tr>
	</tbody>
</table></div></div>