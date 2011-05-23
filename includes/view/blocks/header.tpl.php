<link href="css/<?php if(isset($_GET['action']) && (strtolower($_GET['action'])=='login' or strtolower($_GET['action'])=='loginsubmit')){echo 'login.css';}else{echo 'header.css'; }?>" rel="stylesheet" type="text/css" />
<link href="css/contact.css" rel="stylesheet" type="text/css" />
<link href="css/ymPrompt.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $title?></title>
<script language="javascript" src="js/jquery-min.js"></script>
<script language="javascript" src="js/ymPrompt.js"></script>
<script language="javascript" type="text/javascript" src="js/datepicker/WdatePicker.js"></script>
<script language="javascript">
function checkAll(targetName, switchName)
{
	var checkAllSwitch = document.getElementsByName(switchName);
	var targetCheckboxes = document.getElementsByName(targetName);
	for (var i=0; i<targetCheckboxes.length; i++)
	{
		targetCheckboxes[i].checked = checkAllSwitch[0].checked;
	}
}
function existSelectedCheckbox(targetName)
{
	var targetCheckboxes = document.getElementsByName(targetName);
	for (var i=0; i<targetCheckboxes.length; i++)
	{
		if(targetCheckboxes[i].checked)
		{
			 return true;
		}
	}
	//alert('select one');
	return false;
}
function switchSysBar()
{
	if (document.getElementById("switchPoint").innerText==3)
	{
		document.getElementById("switchPoint").innerText=4
		document.getElementById("frmTitle").style.display="none"
	}
	else
	{
		document.getElementById("switchPoint").innerText=3
		document.getElementById("frmTitle").style.display=""
	}
}
//selected action
function selectedAction(targetName, actionObj)
{
	if (actionObj.value == '')
	{
		return;
	}
	if (!existSelectedCheckbox(targetName))
	{
		alert('no selected items');
		actionObj.selectedIndex = 0;
		return;
	}
	if (!confirm('confirm_delete_selected?'))
	{
		actionObj.selectedIndex = 0;
		return;
	}
	var listFormDom = document.getElementById('listForm');
	listFormDom.action = actionObj.value;
	listFormDom.submit();
}

function popupWindow(url) {
  window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=450,height=320,screenX=150,screenY=150,top=150,left=150')
}
function toggleLeft(obj){
	$(obj).parent().find('ul').toggle();
	$(obj).children('img').attr('src')=='images/fadein.gif'?$(obj).children('img').attr('src','images/fadeout.gif'):$(obj).children('img').attr('src','images/fadein.gif');
	
}
//如果表格内容为空则加入一个空格
$(document).ready(function()
{     
   $("table td").append(" ");	  
});
</script>
