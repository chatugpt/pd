<table width="100%" border="0" cellpadding="0" cellspacing="0">
<form name="actionForm" action="<?php echo zee::url(message, "update_submit");?>" method="post">
<tbody>
		<tr>
			<td>
<!-- Form block start -->
<?php
$outMessageUpdateValue = $inData["MessageUpdateValue"];
?>

<table class="menutab" cellspacing="0" cellpadding="0" width="100%" border="0">
	<tbody>
		<tr>
			<td class="menumaintopon"><?php Language::show("MESSAGE.UPDATE.LABEL")?></td>
		</tr>
		<tr>
			<td>
				<table cellspacing="0" cellpadding="0" width="100%" border="0">
<!-- fields start -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("MESSAGE.MESSAGE_ID.LABEL")?></td>
						<td align="left" class="smalltdrow2">
<input type="text" class="textinput" name="message_message_id" value="<?php echo $outMessageUpdateValue->message_id?>" />
<?php Errors::show("MESSAGE_ID")?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("MESSAGE.ORDER_ID.LABEL")?></td>
						<td align="left" class="smalltdrow2">
<input type="text" class="textinput" name="message_order_id" value="<?php echo $outMessageUpdateValue->order_id?>" />
<?php Errors::show("ORDER_ID")?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("MESSAGE.CONTENT.LABEL")?></td>
						<td align="left" class="smalltdrow2">
<input type="text" class="textinput" name="message_content" value="<?php echo $outMessageUpdateValue->content?>" />
<?php Errors::show("CONTENT")?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("MESSAGE.USER_ID.LABEL")?></td>
						<td align="left" class="smalltdrow2">
<input type="text" class="textinput" name="message_user_id" value="<?php echo $outMessageUpdateValue->user_id?>" />
<?php Errors::show("USER_ID")?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("MESSAGE.TIME.LABEL")?></td>
						<td align="left" class="smalltdrow2">
<input type="text" class="textinput" name="message_time" value="<?php echo $outMessageUpdateValue->time?>" />
<?php Errors::show("TIME")?>
						</td>
					</tr>
					<!-- Field end -->
<!-- fields end -->
				</table>
			</td>
		</tr>
		<tr>
			<td height="25" align="center" valign="center" class="tdblue">
			<!-- action blocks start -->
				<input type="submit" value="<?php Language::show("COMMON.SAVE.LABEL")?>" class="submit" />
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="button" onclick="location.href='<?php echo zee::url(message, "list");?>'" value="<?php Language::show("COMMON.BACK.LABEL")?>" class="submit" />
			<!-- action blocks end -->
			</td>
		</tr>
	</tbody>
</table>
<!-- Form block end -->
			</td>
		</tr>
	</tbody>
</form>
</table>