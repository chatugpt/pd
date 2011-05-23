<div id="sidebar">
<div id="all" class="sidewrap nobottom">
<h3><a href="index.php?module=orders"><img src="images/allserver.gif">所有派单</a></h3>
</div>
<div class="sidewrap">
<h3 onclick="toggleLeft(this)"><img src="images/fadein.gif">按时间段</h3>
	<ul><li><a id="todayOrder" href="index.php?module=orders&type=today">今日派单</a></li>
		<li><a href="index.php?module=orders&type=week">本周派单</a></li>
		<li><a href="index.php?module=orders&type=month">本月派单</a></li>
		<li><a href="index.php?module=orders&type=year">今年派单</a></li>
		<li><a href="index.php?module=orders&action=search">自定义查询</a></li>
		<li><a id="newOrder" href="index.php?module=orders&action=create">新派单</a></li>
		<li><a id="newComment" href="index.php?module=message&action=newlist">新留言</a></li>
		<li><a id="todayComment" href="index.php?module=message&type=today">今日留言</a></li>
				<li><a id="" href="index.php?module=orders&action=export">派单导出</a></li>
				</ul>
</div>
<div class="sidewrap">
<h3 onclick="toggleLeft(this)"><img src="images/fadein.gif">按类型</h3>
	<ul><li><a href="index.php?module=orders&orderby=state&amp;type=isview">已查看</a></li>
	<li><a href="index.php?module=orders&orderby=state&amp;type=notview">未查看</a></li>
		<li><a href="index.php?module=orders&orderby=op&amp;type=isop">已成交</a></li>
		<li><a href="index.php?module=orders&orderby=op&amp;type=notop">未成交</a></li>
		<li><a href="index.php?module=orders&orderby=contact&amp;type=c<?php echo Value::CONTACT_STATUS_NOT_CONTACT ; ?>">待联系</a></li>
		<li><a href="index.php?module=orders&orderby=contact&amp;type=c<?php echo Value::CONTACT_STATUS_CONTACTED  ; ?>">已联系</a></li>
		<li><a href="index.php?module=orders&orderby=contact&amp;type=c<?php echo Value::CONTACT_STATUS_CANNOT_CONTACT ; ?>">无法联系</a></li>
				</ul>
</div>

<div class="sidewrap">
<h3 onclick="toggleLeft(this)"><img src="images/fadein.gif">管理</h3>
	<ul>
<?php if(isset($_SESSION['user_role']) and  $_SESSION['user_role']==Value::USER_ROLE_ADMIN){
?>
	<li><a href="index.php?module=project">项目管理</a></li>
	<li><a href="index.php?module=area">派往地区管理</a></li>
	<li><a href="index.php?module=user">管理员管理</a></li>
<?php } ?>
    <li><a href="index.php?module=user&action=edit">修改信息</a></li>
</ul>
</div>

<div id="nowrap" class="sidewrap">
<h3 id="loginaction"><a href="index.php?module=user&action=logout"><img src="images/sideout.gif"></a></h3>
</div>

</div>