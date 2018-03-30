<?php 
define('name', 1);
$_conn=null;
require __DIR__.'/includes/common.inc.php';
define('SCRIPT','login');
session_start();
_login_state();
if ($_GET['action']=='login')
{
    _check_code($_POST['code'], $_SESSION['code']);
    include   __DIR__.'/includes/login.func.php';
    //接收数据
    $_clean=array();
    $_clean['username']=_check_username($_POST['username'], 2,20);
    $_clean['password']=_check_password($_POST['password'],6);
    $_clean['time']=_check_time($_POST['time']);
    //print_r($_clean);
    
    if(!!list($username,$uniqid)=_fetch_array($_conn,"select tg_username,tg_uniqid from testguest.tg_user where tg_username='{$_clean['username']}' and tg_password='{$_clean['password']}' and tg_active is null limit 1"))
    {   _query($_conn, "update tg_user set tg_last_time=now(), tg_last_ip='{$_SERVER["REMOTE_ADDR"]}',tg_login_count=tg_login_count+1
                            where tg_username='{$username}'");
        mysqli_close($_conn);
        _session_destory();
        _set_cookies($username, $uniqid,$_clean['time']);
        header('location:index.php');
    }else 
    {   mysqli_close($_conn);
        _session_destory();
        _location('用户名或密码错误或未激活', 'login.php');
       
    }

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>登陆</title>
<?php 
    require ROOT_PATH.'title.inc.php';
?>
</head>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<?php
   
    require ROOT_PATH.'header.inc.php';
?> 
<body>
<div id="login">
	<h2>登陆</h2>
	 <form method="post" name="login" action="login.php?action=login ">
  	
  	<dl>
  		<dd>用户名　:<input type="text" name="username"  class="text"></dd>
  		<dd>密码　　:<input type="password" name="password" class="text"></dd>
  		<dd>保留　　:<input type="radio" name="time" value="0" checked="checked">不保留<input type="radio" name="time" value="1">
  		一天<input type="radio" name="time" value="2">一周<input type="radio" name="time" value="3">一月 </dd>
  		<dd>验证码　:<input type="text" name="code" class="textcode"><img src="code.php" id="code" > </dd>
  		<dd><input type="submit" value ="登陆" class="button"><input type="submit" value ="注册" id="location" class="button location"></dd>
  	</dl>
  	</form>
</div>
<?php 
    require ROOT_PATH.'footer.inc.php'; 
?>
</body>
</html>