<?php
$outCodes = '<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody>
		<tr>
			<td>
<!-- Form block start -->
<?php
$out'.$moduleName.'ViewValue = $inData["'.$moduleName.'ViewValue"];
?>

<table class="menutab" cellspacing="0" cellpadding="0" width="100%" border="0">
	<tbody>
		<tr>
			<td class="menumaintopon"><?php Language::show("'.strtoupper($table).'.VIEW.LABEL")?></td>
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
						<td align="left" class="smalltdrow2"><?php echo $out'.$moduleName.'ViewValue->'.$field->name.'?>
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
</table>';
return $outCodes;

