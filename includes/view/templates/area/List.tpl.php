<?php $outAreaList = $inData["AreaList"];?>
<?php $listPageHelper = $inData["ListPageHelper"];?>
<div class="bodywrap">
 <div style="width: 99%;" id="listbox">
<table cellspacing="0" cellpadding="0" width="100%" border="0">
		  <tbody>
	<tr>
		<td align="left" valign="baseline" colspan="2">
			<strong><?php Language::show("AREA.LIST.LABEL")?></strong>
		</td>
		<td align="right" valign="baseline">
		 <a href="index.php?module=area&action=create">添加新地区</a>
		</td>
	</tr>
			<tr>
			  <td align="center" class="smalltdrow1">
				  <?php Language::show("AREA.AREA_ID.LABEL")?>
			  </td>
			  <td align="center" class="smalltdrow1">
				  <?php Language::show("AREA.AREA_NAME.LABEL")?>
			  </td>
			  <td width="114" align="center" class="smalltdrow1"><?php Language::show("COMMON.ACTION.LABEL")?></td>
			</tr>
<form id="listForm" name="listForm" action="index.php" method="post">
<?php
if(count($outAreaList)>0)
{
//	$rowNum = 0;
	foreach($outAreaList as $outArea)
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
<?php echo $outArea->area_id?>
				  </td>
				  <td align="left" class="smalltdrow2">
<?php echo $outArea->area_name?>
				  </td>
				  <td align="center" class="smalltdrow2">
				  <a href="index.php?module=area&action=update&update_area_id=<?php echo $outArea->area_id;?>"><?php Language::show("COMMON.EDIT.LABEL")?></a>  <a onclick="if(confirm('确认删除？'))location.href='index.php?module=area&action=delete&delete_area_id=<?php echo $outArea->area_id;?>'" href="javascript:void(0);">删除</a>
				</td>
			</tr>
<?php
	}
}
?>
</form>
		
	<tr>
	 <td class="menumaintopon" colspan="2"><?php Language::show("AREA.LIST.LABEL")?> <?php echo $listPageHelper->pageStat();?></td>
		<td align="right" class="smalltdrow2" >
<?php echo $listPageHelper->jumpSelect();?>
		</td>
	</tr>
	</tbody>
</table>
</div></div>