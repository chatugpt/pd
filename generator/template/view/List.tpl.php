<?php
$outCodes = '<?php $out'.$moduleName.'List = $inData["'.$moduleName.'List"];?>
<?php $listPageHelper = $inData["ListPageHelper"];?>
<table width="100%" height="24" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td align="left" valign="baseline">
			<strong><?php Language::show("'.strtoupper($table).'.LIST.LABEL")?></strong>
		</td>
		<td align="right" valign="baseline">
			<input type="button" class="smcreate" onclick="location.href=\'index.php?module='.$table.'&action=create\';" value="<?php Language::show("COMMON.CREATE.LABEL")?>" />
		</td>
	</tr>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody>
		<tr>
			<td>

<table class="menutab" cellspacing="0" cellpadding="0" width="100%" border="0">
  <tbody>
	<tr>
	  <td class="menumaintopon" colspan="2"><?php Language::show("'.strtoupper($table).'.LIST.LABEL")?> <?php echo $listPageHelper->pageStat();?></td>
	</tr>
	<tr>
	  <td colspan="2"><table cellspacing="0" cellpadding="0" width="100%" border="0">
		  <tbody>
			<tr>
			  <td class="smalltdrow1" width="34">
  				<input name="list_'.$table.'_check_all" type="checkbox" value="" onClick="checkAll(\'list_'.$table.'_ids[]\', \'list_'.$table.'_check_all\');" />
			  </td>';
foreach ($fieldList as $field)
{
	if (($field->name=='created')||($field->name=='modified')||($field->name=='status')||($field->name=='id'))
	{
		continue;
	}
	$outCodes .= '
			  <td align="center" class="smalltdrow1">
				  <?php Language::show("'.strtoupper($table.'.'.$field->name.'.LABEL').'")?>
			  </td>';
}
$outCodes .= '
			  <td width="114" align="center" class="smalltdrow1"><?php Language::show("COMMON.ACTION.LABEL")?></td>
			</tr>
<form id="listForm" name="listForm" action="index.php" method="post">
<?php
if(count($out'.$moduleName.'List)>0)
{
//	$rowNum = 0;
	foreach($out'.$moduleName.'List as $out'.$moduleName.')
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
			  <td width="34" class="smalltdrow2"><input name="list_'.$table.'_ids[]" type="checkbox" value="<?php echo $out'.$moduleName.'->id?>"></td>';

foreach ($fieldList as $field)
{
	if (($field->name=='created')||($field->name=='modified')||($field->name=='status'))
	{
		continue;
	}
	$outCodes .= '
				  <td align="left" class="smalltdrow2">
<?php echo $out'.$moduleName.'->'.$field->name.'?>
				  </td>';
}
$outCodes .= '
				  <td align="center" class="smalltdrow2">
				   <a href="index.php?module='.$table.'&action=view&view_'.$table.'_id=<?php echo $out'.$moduleName.'->id;?>"><?php Language::show("COMMON.VIEW.LABEL")?></a>
				  <a href="index.php?module='.$table.'&action=update&update_'.$table.'_id=<?php echo $out'.$moduleName.'->id;?>"><?php Language::show("COMMON.EDIT.LABEL")?></a>
				</td>
			</tr>
<?php
	}
}
?>
</form>
		  </tbody>
	  </table>
	  </td>
	</tr>

	<tr>
		<td align="left" class="smalltdrow2">
			<?php Language::show("COMMON.SELECTED_ACTION.LABEL")?>:
			<select id="selectedActions" name="selectedActions" onchange="selectedAction(\'list_'.$table.'_ids[]\', this);">
				<option value="" selected><?php Language::show("COMMON.SELECT.LABEL")?>:</option>
				<?php //<option value="index.php?module='.$table.'&action=delete_selected">DELETE</option> ?>
			</select>
		</td>
		<td align="right" class="smalltdrow2">
<?php echo $listPageHelper->jumpSelect();?>
		</td>
	</tr>
	
  </tbody>
</table>				<br/>
			</td>
		</tr>
	</tbody>
</table>';
return $outCodes;

