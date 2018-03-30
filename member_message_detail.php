<?php 
$_conn=null;
session_start();
define('name', 1);
define('SCRIPT','member_message_detail');
require __DIR__.'/includes/common.inc.php';
if(!isset($_COOKIE['username']))
{
    _alert_('请登录后重试');
}


if($_GET['action']=='delete'&&isset($_GET['id'])){
    //验证短信id
    $_result=_query($_conn,"select tg_id from tg_message where tg_id='{$_GET['id']}';");
    $_rows=_fetch_array_list($_result);
    if(!$_rows){
        _alert_('未查询到此消息,无法删除');
    }
    //取出唯一标示符
    if(!$_uni=_fetch_array($_conn, "select tg_uniqid from tg_user where tg_username = '{$_COOKIE['username']}'")){
        _alert_('不存在该用户');
    }
    //唯一标示符验证
    _uniqid($_uni['tg_uniqid'], $_COOKIE['uniqid']); 
    _query($_conn,"delete from tg_message where tg_id='{$_GET['id']}' limit 1");
    if(_affected_rows($_conn)==1)
    {
        //@mysqli_close($_conn);
        _session_destory();
        _location('删除成功！', 'member_message.php');
        
    }
    else
    {
        @mysqli_close($_conn);
        _session_destory();
        _location('删除失败请重试！', 'member_message.php');
    }

}

if(!isset($_GET['id'])){
    
    _alert_('非法操作');
}
$_result=_query($_conn,"select * from tg_message where tg_id='{$_GET['id']}';");
$_rows=_fetch_array_list($_result);
if(empty($_rows[tg_state]))
{
    _query($_conn, "update tg_message set tg_state=1 where tg_id='{$_GET['id']}'");
    if(!_affected_rows($_conn)){
        _alert_("打开失败");
    }
}
if(!$_rows){
    _alert_('未查询到此消息');
}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>短信</title>
<link rel="shortcut icon" href="1.ico">
<link rel="shortcut icon" href="1.ico">
<?php 
    require ROOT_PATH.'title.inc.php';
?>
<script type="text/javascript" src="js/member_message_detail.js"></script>
</head>
<body>
<?php
    require ROOT_PATH.'header.inc.php';
?> 
<div id="member">
	<?php require ROOT_PATH.'member.inc.php';?>
	<div id="member_main">
		<h2>短信内容</h2>
		<dl>
			<dd>发信人:<?php echo _html($_rows['tg_fromuser'])?></dd>
			<dd>内容:<strong><?php echo _html($_rows['tg_content'])?></strong></dd>
			<dd>发信时间:<?php echo _html($_rows['tg_date'])?></dd>
			<dd class=button><input type="button" value="返回列表" id="return"><input type="button" name="<?php echo $_GET['id']?>" value="删除短信" id="delete"></dd>
		</dl>
	</div>
</div>



<?php 
    require ROOT_PATH.'footer.inc.php';
    
?>
</body>
</html>