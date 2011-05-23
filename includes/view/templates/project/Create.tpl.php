<?php $projectlist = $inData["Projectlist"];?>
<div class="bodywrap">
 <div style="width: 99%;" id="listbox">
<form id="actionForm" name="actionForm" action="<?php echo zee::url(project, "create_submit");?>" method="post">
<!-- Form block start -->
<?php
$outProjectUpdateValue = $inData["ProjectUpdateValue"];

$array_top=array();

$select='<select name="project_father_id">';
if($outProjectUpdateValue->father_id==0){
   $select.='<option value="0" selected="selected">顶级栏目</option>';
}else{
   $select.='<option value="0">顶级栏目</option>';	
}
if(count($projectlist)>0){
	foreach ($projectlist as $project){  
	  if($project->father_id==0){
	  	//如果有父亲ID
        if($outProjectUpdateValue->father_id==$project->project_id){
			$select.='<option value="'.$project->project_id.'" selected="selected">'.$project->project_name.'</option>';
		}else{
			$select.='<option value="'.$project->project_id.'">'.$project->project_name.'</option>';
		}  		  	
	  }
	  
	}
}
//$array_top 

$select.='</select>';
?>
<table cellspacing="0" cellpadding="0" width="100%" border="0">
<!-- fields start -->
		<tr>
			<td class="menumaintopon" colspan="2"><?php Language::show("PROJECT.CREATE.LABEL")?></td>
		</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("PROJECT.PROJECT_NAME.LABEL")?></td>
						<td align="left" class="smalltdrow2">
<input type="text" class="textinput" name="project_project_name" value="<?php echo $outProjectCreateValue->project_name?>" />
<?php Errors::show("PROJECT_NAME")?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("PROJECT.FATHER_ID.LABEL")?></td>
						<td align="left" class="smalltdrow2">
<?php echo $select; ?>
<?php Errors::show("FATHER_ID")?>
						</td>
					</tr>
					<!-- Field end -->
							<tr>
			<td height="25" align="center" valign="center" class="tdblue" colspan="2">
			<!-- action blocks start -->
				<input type="submit" value="<?php Language::show("COMMON.SAVE.LABEL")?>" class="submit" />
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="button" onclick="location.href='<?php echo zee::url(project, "list");?>'" value="<?php Language::show("COMMON.BACK.LABEL")?>" class="submit" />
			<!-- action blocks end -->
			</td>
		</tr><!-- fields end -->
				</table>
			</td>
		</tr>
<!-- Form block end -->
</form>
</div></div>