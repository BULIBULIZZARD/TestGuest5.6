
<?php 
$_conn=null;
define('name', 1);
define('SCRIPT','message');
require __DIR__.'/includes/common.inc.php';
session_start();
if(!isset($_COOKIE['username'])){
    _alert_close('登录后可发送');
}
if(!$_rows=_fetch_array($_conn, "select tg_uniqid from tg_user where tg_username = '{$_COOKIE['username']}'")){
    _alert_('不存在该用户');
}

_uniqid($_rows['tg_uniqid'], $_COOKIE['uniqid']); 
if($_GET['action']=='write'){
    _check_code($_POST['code'], $_SESSION['code']);
    include 'includes/register.func.php';
    $_clean=array();
    $_clean['touser']=$_POST['touser'];
    $_clean['fromuser']=$_COOKIE['username'];
    $_clean['content']=addslashes(_check_content($_POST['content']));
    _query($_conn, "insert into tg_message (
                                 tg_touser,
                                 tg_fromuser,   
                                 tg_content, 
                                 tg_date  
                       ) values(
                                 '{$_clean['touser']}',
                                 '{$_clean['fromuser']}',
                                 '{$_clean['content']}',
                                 now()            
                                                )");
    if(_affected_rows($_conn)==1)
    {
        //@mysqli_close($_conn);
        _session_destory();
        _alert_close('发送成功');
        
    }
    else
    {
        @mysqli_close($_conn);
        _session_destory();
        _alert_('发送失败');
    }
    print_r($_clean);
    exit();
}
if(isset($_GET['id'])){
   if(!!$_row= _fetch_array($_conn,"select tg_username from testguest.tg_user where tg_id='{$_GET['id']}' limit 1"))
   {
       $_user=$_row['tg_username'];
       
   }
   else {
       _alert_close('不存在该用户');
   }
}else {
    _alert_close('非法操作'); 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
<?php 

 require ROOT_PATH.'title.inc.php';
?>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/message.js"></script>
</head>
<body>
<div id="message">
	<h3>写短信</h3>
	<form method="post" action="?action=write">
	<input type="hidden" value="<?php echo $_user?>" name="touser">
	<dl>
		<dd><input type="text" class="text" value="TO:<?php echo $_user;?>"></dd>
		<dd><textarea name="content"></textarea></dd>
		<dd>验证码　:<input type="text" name="code" class="textyzm"><img src="code.php" id="code" >
		<input type="submit" class="submit" value="发送"></dd>
	</dl>
	</form>

</div>
</body>
</html>