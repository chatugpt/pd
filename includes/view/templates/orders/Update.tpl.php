<table width="100%" border="0" cellpadding="0" cellspacing="0">
<form name="actionForm" action="<?php echo zee::url(orders, "update_submit");?>" method="post">
<tbody>
		<tr>
			<td>
<!-- Form block start -->
<?php
$outOrdersUpdateValue = $inData["OrdersUpdateValue"];

$projectlist = $inData["Projectlist"];
$arealist = $inData["Arealist"];
$userList = $inData["UserList"];


//print_r($projectlist);
$array_top=array();
if(count($projectlist)>0){
	foreach ($projectlist as $project){  
	  if($project->father_id>0){
	  	//如果有父亲ID
	  	$array_top[$project->father_id][]=array($project->project_id,$project->project_name,$project->father_id);	  		  	
	  }else{
	  	if(isset($array_top[$project->father_id])){
	  		array_unshift($array_top[$project->project_id],array($project->project_id,$project->project_name,$project->father_id));
	  	}else{
	  		$array_top[$project->project_id][]=array($project->project_id,$project->project_name,$project->father_id);
	  	}
	  }
	}
}
//$array_top 
$select='<select name="orders_project_id">';
if(count($array_top)>0){
	foreach($array_top as $key => $value){
		foreach($value as $k => $v){
			if($v[2]==0){
				if($outOrdersUpdateValue->project_id==$v[0]){
					$select.='<option value="'.$v[0].'" selected="selected">'.$v[1].'</option>';
				}else{
					$select.='<option value="'.$v[0].'">'.$v[1].'</option>';
				}
			}else{
				if($outOrdersUpdateValue->project_id==$v[0]){
				    $select.='<option value="'.$v[0].'" selected="selected">--'.$v[1].'</option>';
				}else{
					$select.='<option value="'.$v[0].'">--'.$v[1].'</option>';
				}
			}
		}	
	}
}
$select.='</select>';
?>

<table class="menutab" cellspacing="0" cellpadding="0" width="100%" border="0">
	<tbody>
		<tr>
			<td class="menumaintopon"><?php // Language::show("ORDERS.UPDATE.LABEL")?></td>
		</tr>
		<tr>
			<td>
<div class="bodywrap">
 <div style="width: 99%;" id="listbox">
				<table cellspacing="0" cellpadding="0" width="100%" border="0">
<!-- fields start -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.ORDER_ID.LABEL")?></td>
						<td align="left" class="smalltdrow2">
<input type="hidden" name="orders_order_id" value="<?php echo $outOrdersUpdateValue->order_id?>" />
<?php echo $outOrdersUpdateValue->order_id?>
<?php Errors::show("ORDER_ID")?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.CUSTOMER_NAME.LABEL")?></td>
						<td align="left" class="smalltdrow2">
<input type="text" class="textinput" name="orders_customer_name" value="<?php echo $outOrdersUpdateValue->customer_name?>" />
<?php Errors::show("CUSTOMER_NAME")?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.CUSTOMER_ADDRESS.LABEL")?></td>
						<td align="left" class="smalltdrow2">
<input type="text" class="textinput" name="orders_customer_address" value="<?php echo $outOrdersUpdateValue->customer_address?>" />
<?php Errors::show("CUSTOMER_ADDRESS")?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.ASSIGN.LABEL")?></td>
						<td align="left" class="smalltdrow2">
<?php 
$array_assign=explode(',',$outOrdersUpdateValue->assign);
if(count($arealist)>0){
$i=0;
	foreach ($arealist as $k=>$v){
		if(in_array($v->area_id,$array_assign)){
			echo ' <input type="checkbox" name="orders_assign[]" value="'.$v->area_id.'" checked="checked" />'.$v->area_name;
		}else{
			echo ' <input type="checkbox" name="orders_assign[]" value="'.$v->area_id.'" />'.$v->area_name;
		}
		$i++;
		if($i%3==0){echo '<br />';}
	}
}
?>
<?php Errors::show("ASSIGN")?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.AGE.LABEL")?></td>
						<td align="left" class="smalltdrow2">
<input type="text" class="textinput" name="orders_age" value="<?php echo $outOrdersUpdateValue->age?>" />
<?php Errors::show("AGE")?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.SEX.LABEL")?></td>
						<td align="left" class="smalltdrow2">
<input type="text" class="textinput" name="orders_sex" value="<?php echo $outOrdersUpdateValue->sex?>" />
<?php Errors::show("SEX")?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.PROJECT_ID.LABEL")?></td>
						<td align="left" class="smalltdrow2">
<?php // echo $outOrdersUpdateValue->project_id?>
<?php echo $select; ?>
<?php Errors::show("PROJECT_ID")?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.HIS.LABEL")?></td>
						<td align="left" class="smalltdrow2">
<input type="text" class="textinput" name="orders_HIS" value="<?php echo $outOrdersUpdateValue->HIS?>" />
<?php Errors::show("HIS")?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.MOBILE.LABEL")?></td>
						<td align="left" class="smalltdrow2">
<input type="text" class="textinput" name="orders_mobile" value="<?php echo $outOrdersUpdateValue->mobile?>" />
<?php Errors::show("MOBILE")?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.TELEPHONE.LABEL")?></td>
						<td align="left" class="smalltdrow2">
<input type="text" class="textinput" name="orders_telephone" value="<?php echo $outOrdersUpdateValue->telephone?>" />
<?php Errors::show("TELEPHONE")?>
						</td>
					</tr>

					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.USER_ID.LABEL")?></td>
						<td align="left" class="smalltdrow2">
<select name="orders_user_id">
<?php if(count($userList)>0){
	 foreach ($userList as $v){
	 	if($v->user_id==$outOrdersUpdateValue->user_id){
	 		echo '<option value="'.$v->user_id.'" selected="selected">'.$v->realname.'</option>';
	 	}else{
	 		echo '<option value="'.$v->user_id.'">'.$v->realname.'</option>';
	 	}
	 }
}
 Errors::show("USER_ID")?>
 </select>

					
						</td>
					</tr>
					<!-- Field end -->

						<input type="hidden" name="orders_modifyer_id" value="<?php echo $_SESSION['user_id']; ?>" />
<?php Errors::show("MODIFYER_ID")?>
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.INFO.LABEL")?></td>
						<td align="left" class="smalltdrow2">
						<textarea name="orders_info"><?php echo $outOrdersUpdateValue->info?></textarea>
<?php Errors::show("INFO")?>
						</td>
					</tr>

<!-- fields end -->
				</table>
</div></div>
			</td>
		</tr>
		<tr>
			<td height="25" align="center" valign="center" class="tdblue">
			<!-- action blocks start -->
				<input type="submit" value="<?php Language::show("COMMON.SAVE.LABEL")?>" class="submit" />
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="button" onclick="location.href='<?php echo zee::url('orders', "list");?>'" value="<?php Language::show("COMMON.BACK.LABEL")?>" class="submit" />
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