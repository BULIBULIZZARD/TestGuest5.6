<?php 
$_conn=null;
define('name', 1);
require __DIR__.'/includes/common.inc.php';
define('SCRIPT','active');
// if(!_affected_rows($_conn)==1)
// {
//     _alert_('非凡操作');
// }
if (isset($_GET['action'])&&isset($_GET['active'])&&$_GET['action']=='ok')
{
    if(_fetch_array($_conn, "select * from tg_user where tg_active='{$_GET['active']} 'limit 1"))
    {
        _query($_conn, "update tg_user set tg_active=null where tg_active='{$_GET['active']}'limit 1");
        if(_affected_rows($_conn)==1)
        {
            //_code($_conn);
            _location('账号激活成功', 'login.php');
            exit();
        }
        else {
            //_code($_conn);
            _location('账号激活失败', 'register.php');
            exit();
        }
    }else {
        _alert_('非凡操作');
        
    }
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
</head>
<body>
<?php
   
    require ROOT_PATH.'header.inc.php';
?> 

<div id="active">
	<h2>激活账户</h2>
	<p>请点击以下链接来激活您的账号!</p>
	<p><a href="active.php?action=ok&amp;active=<?php echo $_GET['active'] ?>"><?php echo  'http://'.$_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"]?>active.php?action=ok&amp;active=<?php echo $_GET['active'] ?></a></p>
	
	

</div>
<?php 
    require ROOT_PATH.'footer.inc.php';
    
?>
</body>
</html>