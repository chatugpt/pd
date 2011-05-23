<div class="bodywrap">
 <div style="width: 99%;" id="listbox">
<form name="actionForm" action="<?php echo zee::url(area, "update_submit");?>" method="post">
<!-- Form block start -->
<?php
$outAreaUpdateValue = $inData["AreaUpdateValue"];
?>
<table cellspacing="0" cellpadding="0" width="100%" border="0">
<!-- fields start -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("AREA.AREA_ID.LABEL")?></td>
						<td align="left" class="smalltdrow2">
<input type="hidden" name="area_area_id" value="<?php echo $outAreaUpdateValue->area_id?>" />
<?php echo $outAreaUpdateValue->area_id?>
<?php Errors::show("AREA_ID")?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("AREA.AREA_NAME.LABEL")?></td>
						<td align="left" class="smalltdrow2">
<input type="text" class="textinput" name="area_area_name" value="<?php echo $outAreaUpdateValue->area_name?>" />
<?php Errors::show("AREA_NAME")?>
						</td>
					</tr>
					<!-- Field end -->
<!-- fields end -->
		<tr>
			<td height="25" align="center" valign="center" class="tdblue" colspan="2">
			<!-- action blocks start -->
				<input type="submit" value="<?php Language::show("COMMON.SAVE.LABEL")?>" class="submit" />
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="button" onclick="location.href='<?php echo zee::url(area, "list");?>'" value="<?php Language::show("COMMON.BACK.LABEL")?>" class="submit" />
			<!-- action blocks end -->
			</td>
		</tr>
	</tbody>
</table>
<!-- Form block end -->

</form>
</div></div>