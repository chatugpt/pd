<?php
$outCodes = '<table width="100%" border="0" cellpadding="0" cellspacing="0">
<form name="actionForm" action="<?php echo zee::url('.$table.', "update_submit");?>" method="post">
<tbody>
		<tr>
			<td>
<!-- Form block start -->
<?php
$out'.$moduleName.'UpdateValue = $inData["'.$moduleName.'UpdateValue"];
?>

<table class="menutab" cellspacing="0" cellpadding="0" width="100%" border="0">
	<tbody>
		<tr>
			<td class="menumaintopon"><?php Language::show("'.strtoupper($table).'.UPDATE.LABEL")?></td>
		</tr>
		<tr>
			<td>
				<table cellspacing="0" cellpadding="0" width="100%" border="0">
<!-- fields start -->';
foreach ($fieldList as $field)
{
	if (($field->name=='created')||($field->name=='modified')||($field->name=='status'))
	{
		continue;
	}
	$outCodes .= '
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("'.strtoupper($table.'.'.$field->name.'.LABEL').'")?></td>
						<td align="left" class="smalltdrow2">
<input type="text" class="textinput" name="'.$table.'_'.$field->name.'" value="<?php echo $out'.$moduleName.'UpdateValue->'.$field->name.'?>" />
<?php Errors::show("'.strtoupper($field->name).'")?>
						</td>
					</tr>
					<!-- Field end -->';
}
$outCodes .= '
<!-- fields end -->
				</table>
			</td>
		</tr>
		<tr>
			<td height="25" align="center" valign="center" class="tdblue">
			<!-- action blocks start -->
				<input type="submit" value="<?php Language::show("COMMON.SAVE.LABEL")?>" class="submit" />
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="button" onclick="location.href=\'<?php echo zee::url('.$table.', "list");?>\'" value="<?php Language::show("COMMON.BACK.LABEL")?>" class="submit" />
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
</table>';
return $outCodes;


