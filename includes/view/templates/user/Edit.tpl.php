<div class="bodywrap"> <div id="listbox" style="width: 99%;">
<form name="actionForm" action="<?php echo zee::url(user, "update_submit");?>" method="post">
<!-- Form block start -->
<?php
$outUserUpdateValue = $inData["UserUpdateValue"];
?>

				<table cellspacing="0" cellpadding="0" width="100%" border="0">
<!-- fields start -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("USER.USER_ID.LABEL")?></td>
						<td align="left" class="smalltdrow2">
<input type="hidden" name="user_user_id" value="<?php echo $outUserUpdateValue->user_id?>" /><?php echo $outUserUpdateValue->user_id?>
<?php Errors::show("USER_ID")?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("USER.USERNAME.LABEL")?></td>
						<td align="left" class="smalltdrow2">
<?php echo $outUserUpdateValue->username?>
<?php Errors::show("USERNAME")?>
						</td>
					</tr>
					<!-- Field end -->

					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("USER.PASSWORD.LABEL")?></td>
						<td align="left" class="smalltdrow2">
<input type="text" class="textinput" name="user_password" value="<?php // echo $outUserUpdateValue->password?>" />
<?php Errors::show("PASSWORD")?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("USER.REALNAME.LABEL")?></td>
						<td align="left" class="smalltdrow2">
<input type="text" class="textinput" name="user_realname" value="<?php echo $outUserUpdateValue->realname?>" />
<?php Errors::show("REALNAME")?>
						</td>
					</tr>
					<!-- Field end -->
<!-- fields end -->
		<tr>
			<td height="25" align="center" valign="center" class="tdblue" colspan="2">
			<!-- action blocks start -->
				<input type="submit" value="<?php Language::show("COMMON.SAVE.LABEL")?>" class="submit" />
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="button" onclick="location.href='<?php echo zee::url(user, "list");?>'" value="<?php Language::show("COMMON.BACK.LABEL")?>" class="submit" />
			<!-- action blocks end -->
			</td>
		</tr>
	</tbody>
</table>
<!-- Form block end -->

</form></div></div>