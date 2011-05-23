<?php $projectlist = $inData["Projectlist"];
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
$select='<select name="project">';
if(count($array_top)>0){
	foreach($array_top as $key => $value){
		foreach($value as $k => $v){
			if($v[2]==0){
				$select.='<option value="'.$v[0].'">'.$v[1].'</option>';
			}else{
				$select.='<option value="'.$v[0].'">--'.$v[1].'</option>';
			}
		}	
	}
}
$select.='</select>';
?>
<div id="seabox">
		<p><b>用户相关搜索</b></p>
		<form method="get" action="<?php echo Zee::url('orders','list'); ?>">
		<input type="hidden" value="orders" name="module">
		<input type="hidden" value="list" name="action">
		<input type="hidden" value="time" name="type">
		<p>派单时间范围:<input type="text" value=""  onClick="WdatePicker()"  id="startArea" name="start"> -
		<input type="text" value="" onClick="WdatePicker()" id="endArea" name="end"></p>
		<input type="submit" class="btn" value="Go" name="submit">
		</form>
		<br>
		<form method="get" action="<?php echo Zee::url('orders','list'); ?>">
		<input type="hidden" value="orders" name="module">
		<input type="hidden" value="list" name="action">
		<input type="hidden" value="mobile" name="type">
		<p>按手机号码搜索：<input type="text" value="" name="num">
		<input type="submit" class="btn" value="Go" name="submit"></p>
		</form><br>
		<form method="get" action="<?php echo Zee::url('orders','list'); ?>">
		<input type="hidden" value="orders" name="module">
		<input type="hidden" value="list" name="action">
		<input type="hidden" value="project" name="type">
		<p>按项目进行搜索：<?php echo $select; ?>
		<input type="submit" class="btn" value="Go" name="submit"></p>
		</form><br>
		<form method="get" action="<?php echo Zee::url('orders','list'); ?>">
		<input type="hidden" value="orders" name="module">
		<input type="hidden" value="list" name="action">
		<input type="hidden" value="his" name="type">
		<p>按HIS进行搜索：<input type="text" value="" name="his">
		<input type="submit" class="btn" value="Go" name="submit"></p>
		</form><br>
		<form method="get" action="<?php echo Zee::url('orders','list'); ?>">
		<input type="hidden" value="orders" name="module">
		<input type="hidden" value="list" name="action">
		<input type="hidden" value="orderid" name="type">
		<p>按派单ID搜索：<input type="text" value="" name="num">
		<input type="submit" class="btn" value="Go" name="submit"></p>
		</form><br>
		<form method="get" action="<?php echo Zee::url('orders','list'); ?>">
				<input type="hidden" value="orders" name="module">
		<input type="hidden" value="list" name="action">
        <input type="hidden" value="name" name="type">
		<p>按顾客姓名搜索：<input type="text" value="" name="name">
		<input type="submit" class="btn" value="Go" name="submit"></p>
		</form>
		<hr>
		<p><b>留言相关搜索</b></p>
		<form method="get" action="<?php echo Zee::url('orders','list'); ?>">
		 <input type="hidden" value="orders" name="module">
		 <input type="hidden" value="list" name="action">
		<input type="hidden" value="newtime" name="type">
		<p>按最新留言时间搜索：
		<input type="text" value="" id="time"  onClick="WdatePicker()"  name="time">
		<input type="submit" class="btn" value="Go" name="submit"></p>
		</form><br>
		<form method="get" action="<?php echo Zee::url('orders','list'); ?>">
		<input type="hidden" value="orders" name="module">
		<input type="hidden" value="list" name="action">
		<input type="hidden" value="comment" name="type">
		<p>按留言时间搜索：
		<input type="text" value="" id="start2"  onClick="WdatePicker()"  name="start">
		<input type="text" value="" id="end2"  onClick="WdatePicker()"  name="end">
		<input type="submit" class="btn" value="Go" name="submit"></p>
		</form>
		<hr>
		<p><b>联系时间相关搜索</b></p>
		<form method="get" action="<?php echo Zee::url('orders','list'); ?>" >
				<input type="hidden" value="orders" name="module">
		<input type="hidden" value="list" name="action">
		<input type="hidden" value="timearea" name="type">
<p>按待联系时间段搜索：<input type="text" value=" "  onClick="WdatePicker()"  id="startArea2" name="start"> -<input type="text" value=""  onClick="WdatePicker()"  id="endArea2" name="end"><input type="submit" class="btn" value="Go" name="submit"></p>
		</form>
		</div>