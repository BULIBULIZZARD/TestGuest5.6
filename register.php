<?php 
    $_conn=null;
    define('name', 1);
    require __DIR__.'/includes/common.inc.php';
    define('SCRIPT','register');
    _login_state();
    session_start();
    //echo _mysql_string("fq'f?q'dd");
    
    
    if($_GET['action']=='register')
    {
        _check_code($_POST['code'], $_SESSION['code']);
        
        include   __DIR__.'/includes/register.func.php';
        $_clean =array();
        $_field =array('uniqid','active','username','password','question','answer','sex','face','email','qq','url');
        $_clean['uniqid']=_check_uniqid($_SESSION['uniqid'], $_POST['uniqid']);
        //为刚注册用户激活?
        $_clean['active']=_sha1_uniqid();
        $_clean['username']=_check_username($_POST['username'],2,20);
        $_clean['password']=_check_password($_POST['password'], $_POST['repassword'],6,20);
        $_clean['question']=_check_question($_POST['question'],2, 20);
        $_clean['answer']=_check_answer($_POST['question'], $_POST['answer'], 2, 20);
        $_clean['sex']=$_POST['sex'];
        $_clean['face']=_check_face($_POST['face']);
        $_clean['email']=_check_email($_POST['email'],40);
        $_clean['qq']=_check_qq($_POST['qq']);
        $_clean['url']=_check_url($_POST['url'],40);
        
      
        
        _is_repeat($_conn, "select tg_username from tg_user where tg_username='{$_clean['username']}'" , '用户名已存在');
        $_heti1=null;
        $_heti2=null;
        for ($i=0;$i<11;$i++)
        {
            $_heti1.="tg_".$_field[$i].',';
        }
        $_heti1=substr($_heti1,0,strlen($_heti1)-1);
        //echo $_heti1."<br>";
        foreach ($_clean as $i)
        {
            $_heti2.="'".$i."',";
        }
        $_heti2=substr($_heti2,0,strlen($_heti2)-1);
        //echo $_heti2;
        _query($_conn,
            "insert into tg_user(
                ".$_heti1."
                 ,tg_reg_time
                 ,tg_last_time
                 ,tg_last_ip
                                ) values (
                ".$_heti2."
                ,NOW()
                ,NOW()
                ,'{$_SERVER["REMOTE_ADDR"]}'
                        )"
                ) or die(mysqli_error($_conn));
        if(_affected_rows($_conn)==1)
        {
            //@mysqli_close($_conn);
            _session_destory();
            _location('注册成功！', 'active.php?active='.$_clean['active']);
        
        }
        else 
        {
            @mysqli_close($_conn);
            _session_destory();
            _location('注册失败请重试！', 'regster.php');
        }
        
    }else 
    $_SESSION['uniqid']=$_uniqid= _sha1_uniqid();
     
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>注册</title>
<link rel="shortcut icon" href="1.ico">
<?php 
    require ROOT_PATH.'title.inc.php';
?>
</head>
<body>
<?php
   
    require ROOT_PATH.'header.inc.php';
?> 
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/register.js"></script>
<div id="register">
  <h2>会员注册</h2>
  <form method="post" name="register" action="register.php?action=register">
  	<input type="hidden" name="uniqid" value="<?php echo $_uniqid ?>">
  	<dl>
  		<dt>请填写基本信息</dt>
  		<dd>用户名　:<input type="text" name="username"  class="text">*2</dd>
  		<dd>密码　　:<input type="password" name="password" class="text">*6</dd>
  		<dd>确认密码:<input type="password" name="repassword" class="text">*6</dd>
  		<dd>密码提示:<input type="text" name="question" class="text">*2</dd>
  		<dd>密码回答:<input type="text" name="answer" class="text">*2</dd>
  		<dd>性别　　:<input type="radio" name="sex"  value="男" checked="checked">男<input type="radio" name="sex" value="女">女</dd>
  		<dd class="face"><input type="hidden" name="face"value="face/m01.gif" id="face"><img src="face/m01.gif" alt="头像选择" id="faceimg"></dd>
  		<dd>电子邮件:<input type="text" name="email" class="text"></dd>
  		<dd>腾讯企鹅:<input type="text" name="qq" class="text"></dd>
  		<dd>主页地址:<input type="text" name="url" class="text" value="http://"></dd>
  		<dd>验证码　:<input type="text" name="code" class="textyzm"><img src="code.php" id="code" ></dd>
  		<dd><input type="submit" class="submit" value="注册"></dd>
  	</dl>
  </form>
</div>
<?php 
    require ROOT_PATH.'footer.inc.php';
?>
</body>
</html>