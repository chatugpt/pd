<?php 
if(isset($_GET['action']) && strtolower($_GET['action'])=='ajaxview'){
	 include $body;
	 exit();
} 
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<?php include View::getBlock('header.tpl.php');?>
<body>
<?php 
if(isset($_GET['action']) && (strtolower($_GET['action'])=='login' || strtolower($_GET['action'])=='out' || strtolower($_GET['action'])=='loginsubmit')){
   include $body;
   exit();
}?>
<div id="wrapper" class="wrap">
	<div id="logo"><img src="images/logo.gif"></div>
	<div class="centerbox"><div>
	<p class="bigheight"><span class="blue strong">全国免费电话:</span><span class="red strong">4008865178</span></p>
	<p class="bigheight">欢迎你：<?php if(isset($_SESSION['user_realname'])){
		echo $_SESSION['user_realname'];
	} ?></p></div>
		</div>
	<div class="rightitle"><div id="picotrol" style="width: auto; overflow: hidden;"><img src="images/keyword.gif"></div></div>
	<a href="index.php?module=user&action=logout"><img id="outbtn" src="images/loginout.gif"></a>
</div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="outerdiv">
  <tr>
    <td width="163px" valign="top" id="frmTitle" bgcolor="#3985C1">
	<div id="leftblock">
	<!-- left menu bars filter start -->
	<?php include View::getBlock('left.tpl.php');?>
	<!-- left menu bars filter end -->
	<br />
	<br>
	</div>
	</td>
    <td width="12" align="center" class="sw" onclick="switchSysBar()" bgcolor="#3985C1">
		<span id="switchPoint" style="FONT-SIZE: 9pt; CURSOR: hand; COLOR: #ffffff; FONT-FAMILY: Webdings"><img src="images/closebtn.gif" /></span>
	</td>
    <td align="center" valign="top"><div id="rightblock">
		<!-- include layout start --> 
		<?php include $body;?>
		<!-- include layout end --> 
    </div>
	</td>
  </tr>
</table>
<?php include View::getBlock('footer.tpl.php');?>
</body>
</html>