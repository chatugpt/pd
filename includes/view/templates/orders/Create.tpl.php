<?php 
$projectlist = $inData["Projectlist"];
$arealist = $inData["Arealist"];
$outOrdersCreateValue = $inData["OrdersCreateValue"];
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
				if($outOrdersCreateValue->project_id==$v[0]){
					$select.='<option value="'.$v[0].'" selected="selected">'.$v[1].'</option>';
				}else{
					$select.='<option value="'.$v[0].'">'.$v[1].'</option>';
				}
			}else{
				if($outOrdersCreateValue->project_id==$v[0]){
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
<table width="60%" border="0" cellpadding="0" cellspacing="0">
<form id="actionForm" name="actionForm" action="<?php echo zee::url(orders, "create_submit");?>" method="post">
<tbody>
		<tr>
			<td>


<table class="menutab" cellspacing="0" cellpadding="0" width="100%" border="0">
	<tbody>
		<tr>
			<td class="menumaintopon"><b><?php Language::show("ORDERS.CREATE.LABEL")?></b></td>
		</tr>
		<tr>
			<td>
				<table cellspacing="0" cellpadding="0" width="100%" border="0">
<!-- fields start -->
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.CUSTOMER_NAME.LABEL")?></td>
						<td align="left" class="smalltdrow2">
<input type="text" class="textinput" name="orders_customer_name" value="<?php echo $outOrdersCreateValue->customer_name?>" />
<?php Errors::show("CUSTOMER_NAME")?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.CUSTOMER_ADDRESS.LABEL")?></td>
						<td align="left" class="smalltdrow2">
<input type="text" class="textinput" name="orders_customer_address" value="<?php echo $outOrdersCreateValue->customer_address?>" />
<?php Errors::show("CUSTOMER_ADDRESS")?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.ASSIGN.LABEL")?></td>
						<td align="left" class="smalltdrow2">
<?php 
$array_assign=explode(',',$outOrdersCreateValue->assign);
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
<input type="text" class="textinput" name="orders_age" value="<?php echo $outOrdersCreateValue->age?>" />
<?php Errors::show("AGE")?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.SEX.LABEL")?></td>
						<td align="left" class="smalltdrow2">
<input type="radio" name="orders_sex" value="男" <?php if($outOrdersCreateValue->sex!='女')echo 'checked="checked"'; ?>/> 男
<input type="radio" name="orders_sex" value="女" <?php if($outOrdersCreateValue->sex=='女')echo 'checked="checked"'; ?>/>女				
<?php Errors::show("SEX")?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.PROJECT_ID.LABEL")?></td>
						<td align="left" class="smalltdrow2">
<?php echo $select; ?>
<?php Errors::show("PROJECT_ID")?>
						</td>
					</tr>
					<!-- Field end -->
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.MOBILE.LABEL")?></td>
						<td align="left" class="smalltdrow2">
<input type="text" class="textinput" name="orders_mobile" id="orders_mobile" value="<?php echo $outOrdersCreateValue->mobile?>" />
<?php Errors::show("MOBILE")?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.TELEPHONE.LABEL")?></td>
						<td align="left" class="smalltdrow2">
<input type="text" class="textinput" name="orders_telephone" value="<?php echo $outOrdersCreateValue->telephone?>" />
<?php Errors::show("TELEPHONE")?>
						</td>
					</tr>

					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.INFO.LABEL")?></td>
						<td align="left" class="smalltdrow2">
  <textarea name="orders_info"><?php echo $outOrdersCreateValue->info?></textarea>
<?php Errors::show("INFO")?>
						</td>
					</tr>
					<!-- Field end
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.PRICE.LABEL")?></td>
						<td align="left" class="smalltdrow2">
<input type="text" class="textinput" name="orders_price" value="<?php echo $outOrdersCreateValue->price?>" />
<?php Errors::show("PRICE")?>
						</td>
					</tr>
				Field end -->
<!-- fields end -->
				</table>
			</td>
		</tr>
		<tr>
			<td height="25" align="center" valign="center" class="tdblue">
			<!-- action blocks start -->
				<input type="submit" value="<?php Language::show("COMMON.SAVE.LABEL")?>" class="submit" />
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="button" onclick="location.href='<?php echo zee::url(orders, "list");?>'" value="<?php Language::show("COMMON.BACK.LABEL")?>" class="submit" />
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
<script language="javascript">
<!--
$(function(){
	ymPrompt.win({message:'<div id="seach_div"><br /><br /><br /><p>请输入手机号：<input type="text" name="num" value="" id="phone"><input type="submit" name="submit" value="Go" class="btn" onclick="newOrderSearch();"></p></div>', width:500,height:200,title: '新派单',allowSelect:true,allowRightMenu:true});
})
function newOrderSearch(){
	href='index.php?module=orders&action=searchorderbyphone&num='+$('#phone').val();
	$.get(href,function(data){
		if(data=='0'){
		  $("#orders_mobile").val($('#phone').val());
		  ymPrompt.close();
		}else{
          $("#seach_div").html(data);
		}  
	})
}


//-->
</script>