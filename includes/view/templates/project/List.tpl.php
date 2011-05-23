<?php $outProjectList = $inData["ProjectList"];?>
<?php $listPageHelper = $inData["ListPageHelper"];?>
<?php $copyProjectList = $inData["ProjectCopy"];?>

<div class="bodywrap"> <div style="width: 99%;" id="listbox">
<table class="menutab" cellspacing="0" cellpadding="0" width="100%" border="0">
  <tbody>
	<tr>
		<td align="left" valign="baseline" colspan="2">
			<strong><?php Language::show("PROJECT.LIST.LABEL")?></strong>
		</td>
		<td align="right" valign="baseline" colspan="2">
			<a href="index.php?module=project&action=create" >添加新项目</a>
		</td>
	</tr>
	<tr>
			  <td align="center" class="smalltdrow1">
				  <?php Language::show("PROJECT.PROJECT_ID.LABEL")?>
			  </td>
			  <td align="center" class="smalltdrow1">
				  <?php Language::show("PROJECT.PROJECT_NAME.LABEL")?>
			  </td>
			  <td align="center" class="smalltdrow1">
				  <?php Language::show("PROJECT.FATHER_ID.LABEL")?>
			  </td>
			  <td width="114" align="center" class="smalltdrow1"><?php Language::show("COMMON.ACTION.LABEL")?></td>
			</tr>
<form id="listForm" name="listForm" action="index.php" method="post">
<?php
if(count($outProjectList)>0)
{
//	$rowNum = 0;
	foreach($outProjectList as $outProject)
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
<?php echo $outProject->project_id?>
				  </td>
				  <td align="left" class="smalltdrow2">
<?php echo $outProject->project_name?>
				  </td>
				  <td align="left" class="smalltdrow2">
<?php
if(count($copyProjectList)>0)
{
//	$rowNum = 0;
	foreach($copyProjectList as $project)
	{
		if($project->project_id==$outProject->father_id){
			echo $project->project_name;
			break;
		}elseif($outProject->father_id==0){
			echo '顶级栏目';
			break;	
		}
	}
}
?>
				  </td>
				  <td align="center" class="smalltdrow2">
				  <a href="index.php?module=project&action=update&update_project_id=<?php echo $outProject->project_id;?>"><?php Language::show("COMMON.EDIT.LABEL")?></a>
				  <a onclick="if(confirm('确认删除？'))location.href='index.php?module=project&action=delete&delete_project_id=<?php echo $outProject->project_id;?>'" href="javascript:void(0);">删除</a>
				</td>
			</tr>
<?php
	}
}
?>
</form>

	<tr>
  <td class="menumaintopon" colspan="3"><?php Language::show("PROJECT.LIST.LABEL")?> <?php echo $listPageHelper->pageStat();?></td>
		<td align="right" class="smalltdrow2">
<?php echo $listPageHelper->jumpSelect();?>
		</td>
	</tr>
		  </tbody>
	  </table></div></div>
