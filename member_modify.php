<?php 
define('name', 1);
$_conn=null;

require __DIR__.'/includes/common.inc.php';
define('SCRIPT','member_modify');
if(!isset($_COOKIE['username']))
{
    _alert_('请登录后重试');
}
if(!$_rows=_fetch_array($_conn, "select tg_uniqid from tg_user where tg_username = '{$_COOKIE['username']}'")){
    _alert_('不存在该用户');
}

_uniqid($_rows['tg_uniqid'], $_COOKIE['uniqid']); 

if($_GET['action']=='modify'){
    _check_code($_POST['code'], $_SESSION['code']);
    include   __DIR__.'/includes/register.func.php';
    $_clean =array();
    $_clean['password']=_check_modify_password($_POST['password'], 6);
    $_clean['sex']=$_POST['sex'];
    $_clean['face']=_check_face($_POST['face']);
    $_clean['email']=_check_email($_POST['email'], 40);
    $_clean['url']=_check_url($_POST['url'],40);
    $_clean['qq']=_check_qq($_POST['qq']);

    if(empty($_clean['password']))
    {
        _query($_conn, "update tg_user set
            tg_sex='{$_clean['sex']}',
            tg_face='{$_clean['face']}',
            tg_email='{$_clean['email']}',
            tg_url='{$_clean['url']}',
            tg_qq='{$_clean['qq']}'
            where tg_username='{$_COOKIE['username']}'
            ");
        if(_affected_rows($_conn)==1)
        {
            //@mysqli_close($_conn);
            _session_destory();
            _location('修改成功！', 'member.php');
            
        }
        else
        {
            @mysqli_close($_conn);
            _session_destory();
            _location('修改失败', 'member_modify.php');
        }
    }
    
    else {
        _query($_conn, "update tg_user set 
                                            tg_password='{$_clean['password']}',
                                            tg_sex='{$_clean['sex']}',
                                            tg_face='{$_clean['face']}',
                                            tg_email='{$_clean['email']}',
                                            tg_url='{$_clean['url']}',
                                            tg_qq='{$_clean['qq']}'     
                                           where tg_username='{$_COOKIE['username']}'
                ");
        if(_affected_rows($_conn)==1)
        {
            //@mysqli_close($_conn);
            _session_destory();
            _location('修改成功！', 'member.php');
            
        }
        else
        {
            @mysqli_close($_conn);
            _session_destory();
            _location('修改失败', 'member_modify.php');
        }
    }
}
$_result=_query($_conn,"select * from tg_user where tg_username='{$_COOKIE['username']}';");
$_rows=_fetch_array_list($_result);
if(!$_rows){
    _alert_('此用户不存在');
}
if($_rows['tg_sex']=='男')
{
    $_rows['tg_sex_html']='<input type="radio" name="sex" value="男" checked="checked">男'.'<input type="radio" name="sex" value="女">女 ';
}else {
    $_rows['tg_sex_html']='<input type="radio" name="sex" value="男">男'.'<input type="radio" name="sex" value="女" checked="checked">女 ';
}
$_rows['tg_face_html']='<select name="face">';
foreach (range(1,9)as $_num)
{
    $_rows['tg_face_html'].='<option value="face/m0'.$_num.'.gif">face/m0'.$_num.'.gif</option>';
}
foreach (range(10,64)as $_num)
{
    $_rows['tg_face_html'].='<option value="face/m'.$_num.'.gif">face/m'.$_num.'.gif</option>';
}
$_rows['tg_face_html'].='</select>';

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
<script type="text/javascript" src="js/code.js"></script>
<Script type="text/javascript" src="js/member_modify.js"></Script>
</head>
<body>
<?php
    require ROOT_PATH.'header.inc.php';
?> 
<div id="member">
	<?php require ROOT_PATH.'member.inc.php';?>
	<div id="member_main">
	<form method="post" name="modify" action="?action=modify">
	<h2>会员管理中心</h2>
		<dl>
		<dd>用户名　:<?php echo _html($_rows['tg_username'])?></dd>
		<dd>密码　　:<input type="password" class="text" name="password"></dd>
		<dd>性别　　:<?php echo $_rows['tg_sex_html']?></dd>
		<dd>头像　　:<?php echo $_rows['tg_face_html']?></dd>
		<dd>电子邮件:<input type="text" class="text" name="email" value="<?php echo $_rows['tg_email']?>"/> </dd>
		<dd>主页　　:<input type="text" class="text" name="url" value="<?php echo _html($_rows['tg_url'])?>"/> </dd>
		<dd>Q Q 　　:<input type="text" class="text" name="qq" value="<?php echo _html($_rows['tg_qq'])?>"/> </dd>
		<dd>验证码　:<input type="text" name="code" class="textyzm"><img src="code.php" id="code" ></dd>
		<dd><input type="submit" class="submit" value="确定"></dd>
		</dl>
		</form>
	</div>
</div>



<?php 
    require ROOT_PATH.'footer.inc.php';
?>
</body>
</html>