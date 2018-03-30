<?php

/*
 * _runtime_() 返回当前时间戳和微秒数的和
 * @access public
 * @return void
 */
function _runtime_()
{
    list ($time, $wtime) = explode(' ', microtime());
    return $time + $wtime;
}

/*
 * _alert_(); JS弹窗
 * @access public
 * @param $_info弹窗信息
 * @return void
 *
 */
function _alert_($_info)
{
    echo "<script type='text/javascript'>alert('$_info');history.back();</script>";
    exit();
}

/*
 * @access public
 * @return void 验证码函数返回空值
 * @param int $_width为长
 * @param int $_height为高
 * @param int $_rand_code验证码长度数
 * @param bool $_falg为是否添加边框的bool值
 */
function _code($_width = 75, $_height = 25, $_rand_code = 4, $_falg = FALSE)
{
    session_start();
    
    for ($i = 0; $i < $_rand_code; $i ++)
        $_nmsg .= dechex(mt_rand(0, 15));
    $_SESSION['code'] = $_nmsg;
    $_img = imagecreatetruecolor($_width, $_height);
    $_white = imagecolorallocate($_img, 255, 255, 255);
    $_black = imagecolorallocate($_img, 0, 0, 0);
    imagefill($_img, 0, 0, $_white);
    // 随机线条
    for ($i = 0; $i < 6; $i ++) {
        $_rnd_color = imagecolorallocate($_img, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
        imageline($_img, mt_rand(0, $_width), mt_rand(0, $_height), mt_rand(0, $_width), mt_rand(0, $_height), $_rnd_color);
    }
    // 随机雪花
    for ($i = 0; $i < 100; $i ++) {
        $_rnd_color = imagecolorallocate($_img, mt_rand(200, 255), mt_rand(200, 255), mt_rand(200, 255));
        imagestring($_img, 1, mt_rand(1, $_width), mt_rand(1, $_height), '*', $_rnd_color);
    }
    for ($i = 0; $i < strlen($_SESSION['code']); $i ++) {
        $_rnd_color = imagecolorallocate($_img, mt_rand(0, 100), mt_rand(0, 200), mt_rand(0, 200));
        imagestring($_img, mt_rand(3, 5), $i * $_width / $_rand_code + mt_rand(1, 10), mt_rand(1, $_height / 2), $_SESSION['code'][$i], $_rnd_color);
    }
    if ($_falg)
        imagerectangle($_img, 0, 0, $_width - 1, $_height - 1, $_black);
    header('Content-Type:image/png');
    imagepng($_img);
    imagedestroy($_img);
}

/*
 *
 *
 */
function _check_code($_first_code, $_end_code)
{
    if ($_first_code != $_end_code) {
        _alert_('验证码错误');
    }
}

/*
 *
 */
function _sha1_uniqid()
{
    return sha1(uniqid(rand(), true));
}

function _location($_info, $_url)
{
    echo "<script type='text/javascript'>alert('$_info');location.href='$_url'</script>";
    exit();
}

function _session_destory()
{
    if (session_start()){
      session_destroy();
    }
}

function _unsetcookises()
{
    setcookie('username','',time()-1);
    setcookie('uniqid','',time()-1);
    _session_destory();
    _location("退出成功?",'index.php');
}

function _login_state(){
    if(isset($_COOKIE['username'])){
       _alert_('请退出登陆后重试','index.php');
    }
}
/*
 * 
 * 返回分页
 * 
 */
function _paging($_type){
    global $_page,$_pageabsolute,$_num;
    if($_type==1)
    {
       echo  '<div id="page_num">';
       echo '<ul>';
        for($i=0;$i<ceil($_pageabsolute);$i++){
            if ($_page==$i+1){
                echo '<li><a href="'.SCRIPT.'.php?page='.($i+1).'" class="selected">'.($i+1).'</a></li>';
                
            }else
            {
                echo '<li><a href="'.SCRIPT.'.php?page='.($i+1).'">'.($i+1).'</a></li>';
            }}
            
	    echo '</ul>';
	    echo '</div>';
    }else if($_type==2)
    {
        
       
       echo '<div id="page_text">';
       echo '<ul>';
       echo '<li>'.$_page.'/'.$_pageabsolute.'页 |</li>';
	   echo	'<li>共有<strong>'.$_num.'</strong>条记录 | </li>';
		if($_page==1){
		    echo '<li>首页|</li>';
		    echo '<li>上一页|</li>';
		}else{
		    echo '<li><a href="'.SCRIPT.'.php">首页| </a></li>';
		    echo '<li><a href="'.SCRIPT.'.php?page='.($_page-1).'">上一页| </a> </li>';
		} 
		if($_page==$_pageabsolute){
    		echo '<li>下一页|</li>';
    		echo '<li>尾页|</li>';
		}else {
		    echo '<li><a href="'.SCRIPT.'.php?page='.($_page+1).'">下一页|</a> </li>';
		    echo '<li><a href="'.SCRIPT.'.php?page='.$_pageabsolute.'">尾页|</a></li>';
		}	
	echo '</ul>';
	echo '</div>';
    }
}

function _page($_conn,$_n,$_sql){
    global $_pagenum,$_pagesize,$_page,$_pageabsolute,$_num;
    if(isset($_GET['page']))
    {
        $_page=$_GET['page'];
        if(empty($_page)||$_page<1||!is_numeric($_page)){
            $_page=1;
        }
        $_page=intval($_page);
    }else
    {
        $_page=1;
    }
        $_num= _num_rows(_query($_conn, $_sql));
        $_pagesize=$_n;
        if ($_num==0)
        {
            $_pageabsolute=1;
        }else
        {
            $_pageabsolute=ceil($_num/$_pagesize);
        }
        if ($_page>$_pageabsolute)
        {
            $_page=$_pageabsolute;
        }
        $_pagenum=($_page-1)*$_pagesize;
//         $_pagee=array($_page,$_pagesize,$_pageabsolute);
//         return $_pagee;
}


function _html($_string)
{
    if(is_array($_string)){
        foreach ($_string as $_key=>$_value ){
            $_string[$_key]=_html($_key);
        }
        return $_string;
    }
    else {
        return htmlspecialchars($_string);
    }
    
}
function  _uniqid($_mysql_uniqid,$_cookie_uniqid){
    if($_mysql_uniqid!=$_cookie_uniqid) _alert_('唯一标示符异常');
}

function _alert_close($_info)
{
    echo "<script type='text/javascript'>alert('$_info');window.close();</script>";
   // exit();
}

function _title($_string){
    if(mb_strlen($_string,'utf-8')>14)
    {
        return mb_substr($_string,0,14,'utf-8').'...';
    }else
    {
        return $_string;    
    }
}
// function _mysql_string($_string)
// {
// //addslashes($_string);
// define(_HOST_, 'mysql:dbname=demo;host=127.0.0.1');
// define(_DBHOST_, 'localhost');
// define(_DBUSER_, 'root');
// define(_DBPSW_, 'a369880790');
// define(_DBNAME_, 'student');
// $_link=mysqli_connect(_DBHOST_, _DBUSER_, _DBPSW_);
// mysqli_real_escape_string($_link,$_string);
// return $_string;
// }

?>