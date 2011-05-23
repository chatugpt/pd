<div id="seabox">
		<p><b>请输入时间范围</b>(不输入则默认导出所有时间)</p>
		<form method="get" action="<?php echo Zee::url('orders','list'); ?>">
		<input type="hidden" value="orders" name="module">
		<input type="hidden" value="export" name="action">
		<input type="hidden" value="time" name="type">
		<p>派单时间范围:<input type="text" value=""  onClick="WdatePicker()"  id="startArea" name="start"> -
		<input type="text" value="" onClick="WdatePicker()" id="endArea" name="end"></p>
		<input type="submit" class="btn" value="Go" name="submit">
		</form>
</div>