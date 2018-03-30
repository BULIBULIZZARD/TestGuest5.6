<?php 
define('name', 1);
$_conn=null;
require __DIR__.'/includes/common.inc.php';
define('SCRIPT','member');
if(!isset($_COOKIE['username']))
{
    _alert_('请登录后重试');
}
$_result=_query($_conn,"select * from tg_user where tg_username='{$_COOKIE['username']}';");
$_rows=_fetch_array_list($_result);
if(!$_rows){
    _alert_('此用户不存在');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>个人中心</title>
<link rel="shortcut icon" href="1.ico">
<link rel="shortcut icon" href="1.ico">
<?php 
    require ROOT_PATH.'title.inc.php';
?>
</head>
<body>
<?php
    require ROOT_PATH.'header.inc.php';
?> 
<div id="member">
	<?php require ROOT_PATH.'member.inc.php';?>
	<div id="member_main">
	<h2>会员管理中心</h2>
		<dl>
		<dd>用户名　:<?php echo _html($_rows['tg_username'])?></dd>
		<dd>性别　　:<?php echo _html($_rows['tg_sex'])?></dd>
		<dd>头像　　:<?php echo _html($_rows['tg_face'])?></dd>
		<dd>电子邮件:<?php echo _html($_rows['tg_email'])?></dd>
		<dd>主页　　:<?php echo _html($_rows['tg_url'])?></dd>
		<dd>Q Q 　　:<?php echo _html($_rows['tg_qq'])?></dd>
		<dd>注册时间:<?php echo _html($_rows['tg_reg_time'])?></dd>
		<dd>身份　　:<?php if(!$_rows['tg_level'])echo '注册会员'; else echo '管理员 '?></dd>
		</dl>
	</div>
</div>



<?php 
    require ROOT_PATH.'footer.inc.php';
    
?>
</body>
</html>