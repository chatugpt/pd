<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody>
		<tr>
			<td>
<!-- Form block start -->
<?php
$outMessageViewValue = $inData["MessageViewValue"];
?>

<table class="menutab" cellspacing="0" cellpadding="0" width="100%" border="0">
	<tbody>
		<tr>
			<td class="menumaintopon"><?php Language::show("MESSAGE.VIEW.LABEL")?></td>
		</tr>
		<tr>
			<td>
				<table cellspacing="0" cellpadding="0" width="100%" border="0">
<!-- fields start -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("MESSAGE.MESSAGE_ID.LABEL")?></td>
						<td align="left" class="smalltdrow2"><?php echo $outMessageViewValue->message_id?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("MESSAGE.ORDER_ID.LABEL")?></td>
						<td align="left" class="smalltdrow2"><?php echo $outMessageViewValue->order_id?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("MESSAGE.CONTENT.LABEL")?></td>
						<td align="left" class="smalltdrow2"><?php echo $outMessageViewValue->content?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("MESSAGE.USER_ID.LABEL")?></td>
						<td align="left" class="smalltdrow2"><?php echo $outMessageViewValue->user_id?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("MESSAGE.TIME.LABEL")?></td>
						<td align="left" class="smalltdrow2"><?php echo $outMessageViewValue->time?>
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
				<input type="button" onclick="history.back();" value="<?php Language::show("COMMON.BACK.LABEL")?>" class="submit" />
			<!-- action blocks end -->
			</td>
		</tr>
	</tbody>
</table>
<!-- Form block end -->
			</td>
		</tr>
	</tbody>
</table>