<?php 
    
    //授权常量
    define('name', 1);
    require __DIR__.'/includes/common.inc.php';
    define('SCRIPT','index');
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>多用户留言系统---首页</title>
<?php 
    require __DIR__.'/includes/title.inc.php'
?>
</head>
<body>
	
<?php
   
    require   ROOT_PATH.'header.inc.php';
?> 
	<div id="list">
		<h2>帖子列表</h2>

	</div>

	<div id="user">
		<h2>新进会员</h2>
	</div>

	<div id="pics">
		<h2>最新图片</h2>
	</div>
<?php 
    require ROOT_PATH.'footer.inc.php';
    
?>
	
</body>
</html>