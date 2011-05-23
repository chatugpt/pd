<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody>
		<tr>
			<td>
<!-- Form block start -->
<?php
$outProjectViewValue = $inData["ProjectViewValue"];
?>

<table class="menutab" cellspacing="0" cellpadding="0" width="100%" border="0">
	<tbody>
		<tr>
			<td class="menumaintopon"><?php Language::show("PROJECT.VIEW.LABEL")?></td>
		</tr>
		<tr>
			<td>
				<table cellspacing="0" cellpadding="0" width="100%" border="0">
<!-- fields start -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("PROJECT.PROJECT_ID.LABEL")?></td>
						<td align="left" class="smalltdrow2"><?php echo $outProjectViewValue->project_id?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("PROJECT.PROJECT_NAME.LABEL")?></td>
						<td align="left" class="smalltdrow2"><?php echo $outProjectViewValue->project_name?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("PROJECT.FATHER_ID.LABEL")?></td>
						<td align="left" class="smalltdrow2"><?php echo $outProjectViewValue->father_id?>
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