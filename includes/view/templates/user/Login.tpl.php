<div class="header"></div>
<p><?php Errors::show('login'); ?></p>
<div class="wrap">
			<div class="leftbox">
			<div id="logo"><img src="images/logo.gif"></div>
			<div id="keyword"><img src="images/keyword.gif"><span>华美派单系统</span></div>
				</div>
			<div class="rightbox">
			<div id="loginMsg"></div>
			<form id="Login" method="post" action="index.php?module=user&action=loginSubmit">
			<p><label for="username">用户名:</label><input type="text" value="" class="hasborder" id="username" name="username"></p>
			<p><label for="password">密&nbsp;&nbsp;码:</label><input type="password" class="hasborder" name="password" id="password"></p>
			<p class="checkbox"><input type="checkbox" value="1" name="rember">&nbsp;&nbsp;自动登录</p>
			<p class="checkbox"><input onclick="this.submit;" type="image" src="images/login-btn.gif" id="btnLogin"></p>
			</form>
				</div><span class="clear"></span>
		</div>