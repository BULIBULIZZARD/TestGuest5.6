<?php 

$_conn=null;
define('name', 1);
define('SCRIPT','member_message');
require __DIR__.'/includes/common.inc.php';
if(!isset($_COOKIE['username']))
{
    _alert_('请登录后重试');
}
//皮删除
if($_GET['action']=='delete'&& isset($_POST['ids'])){
    if(!$_uni=_fetch_array($_conn, "select tg_uniqid from tg_user where tg_username = '{$_COOKIE['username']}'")){
        _alert_('不存在该用户');
    }
    //唯一标示符验证
    _uniqid($_uni['tg_uniqid'], $_COOKIE['uniqid']); 
    $_clean=addslashes(implode(',', $_POST['ids']));
    _query($_conn, "delete from tg_message where tg_id in ($_clean)");
    if(_affected_rows($_conn))
    {
        //@mysqli_close($_conn);
        //_session_destory();
        _location('删除'.$_clean.'成功！', 'member_message.php');
        
    }
    else
    {
        //@mysqli_close($_conn);
        //_session_destory();
        _location('删除失败请重试！', 'member_message.php');
    }
//    print_r($_POST['ids']);
//     echo $_clean;
//     exit();
}
//分页
$_pagesize=$_pageabsolute=null;
$_pagenum=null;
$_pagesize=null;
_page($_conn,5, "select tg_id from tg_message where tg_touser='{$_COOKIE['username']}'");
$_result=_query($_conn,"select
                        *
                    from
                        tg_message
                    where
                        tg_touser='{$_COOKIE['username']}'
                    order by 
                        tg_state desc,
                        tg_date desc
                    limit $_pagenum,$_pagesize");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>短信列表</title>
<link rel="shortcut icon" href="1.ico">
<link rel="shortcut icon" href="1.ico">
<?php 
    require ROOT_PATH.'title.inc.php';
?>
<script type="text/javascript" src="js/member_message.js"></script>
</head>
<body>
<?php
    require ROOT_PATH.'header.inc.php';
?> 
<div id="member">
	<?php require ROOT_PATH.'member.inc.php';?>
	<div id="member_main">
		<h2>短信管理</h2>
		<form method="post" action="?action=delete">
		<table cellspacing="1">
		<tr><th>发信人</th><th>短信内容</th><th>时间</th><th>状态</th><th>操作</th></tr>
		<?php while(!!$_rows=_fetch_array_list($_result)){
		    if (empty($_rows['tg_state'])){
		        $_content= '<strong>'._title($_rows['tg_content']).'</strong>';
		        $_state='<img src="images/m2.gif" alt="未读" title="未读">';
		    }else{
		        $_content= _title($_rows['tg_content']);
		        $_state='<img src="images/m3.gif" alt="已读" title="已读">';
		    }
		        
		echo '<tr><td>'.$_rows['tg_fromuser'].'</td><td><a href="member_message_detail.php?id='.$_rows['tg_id'].'" title="'.$_rows['tg_content'].'">'.$_content.'</a></td><td>'.$_rows['tg_date'].'</td><td>'.$_state.'</td><td><input type="checkbox" name="ids[]" value="'.$_rows['tg_id'].'"></td></tr>';
		  }
		  _free($_result);
		  
		?>
		<tr><td colspan="5"><label for="all">全选<input type="checkbox" name="chkall" id="all"></label><input type="submit" value ="皮删除"></td></tr>
		</table>
		<?php 
		
		_paging(2);
		?>
		</form>
	</div>
	
	
</div>



<?php 
    require ROOT_PATH.'footer.inc.php';
    
?>
</body>
</html>