<?php 

define('name', 1);
$_pagenum=null;
$_pagesize=null;
$_conn=null;
require __DIR__.'/includes/common.inc.php';
define('SCRIPT','blog');
$_pagesize=$_pageabsolute=null;
_page($_conn,15, "select tg_username from tg_user");
$_result=_query($_conn,"select  
        tg_id,
        tg_username,
        tg_sex,
        tg_face
     from 
        tg_user 
    order by tg_reg_time desc 
        limit $_pagenum,$_pagesize");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title> 博客好友</title>
<link rel="shortcut icon" href="1.ico">
<?php 
    require ROOT_PATH.'title.inc.php';
?>
<script type="text/javascript" src="js/blog.js"></script>
</head>
<body>
<?php
    require ROOT_PATH.'header.inc.php';
?> 
<div id="blog">
	<h2>博友列表</h2>
	<?php while(!!$_rows=_fetch_array_list($_result)){
// 	       $_html=array();
// 	       $_html['id']=$_rows['tg_id'];
// 	       echo $_html['id'].$_rows['tg_id'];
// 	       $_html['username']=$_rows['tg_username'];
// 	       $_html['face']=$_rows['tg_face'];
// 	       $_html['sex']=$_rows['tg_sex'];
// 	       $_html=_html($_html);
	    
	    
	    ?>
	<dl>
	<dd class="user"><?php echo $_rows['tg_username'] ?></dd>
	<dt><img src="<?php echo $_rows['tg_face'];?> "></dt>
	<dd class="message"><a href="###" name="message" title="<?php echo $_rows['tg_id']?>">发消息</a></dd>
	<dd class="friend">加好友</dd>
	<dd class="guest">写留言</dd>
	<dd class="flower">送<?php if($_rows['tg_sex']=='女')echo '她';else echo'他'; ?>花</dd>
	</dl>
	<?php }
	_free($_result);
	_paging(2);
	?>
	
</div>
<?php 
    require ROOT_PATH.'footer.inc.php';
    
?>
</body>
</html>