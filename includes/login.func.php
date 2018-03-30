<?php 

if (! defined('name')) {
    exit('NOWAY');
}
    

function _check_username($_string, $_min_num, $_max_num)
{
    $_string = trim($_string);
    if (mb_strlen($_string, 'utf-8') < $_min_num || mb_strlen($_string, 'utf-8') > $_max_num) {
        _alert_('用户名长度为' . $_min_num . '到' . $_max_num . '之间');
        exit();
    }
    $_char_pattern = '/[<>\'\"\ \　]/';
    if (preg_match($_char_pattern, $_string)) {
        _alert_('用户名不能含有特殊字符');
    }
    return $_string;
}
function _check_password($_string, $_min_num)
{
    if (strlen($_string) < $_min_num ) {
        _alert_('请保持密码大于' . $_min_num .'位');
    }
    
    return sha1($_string);
}
function _check_time($_string)
{
    $_time=array('0','1','2','3');
    if(!in_array($_string, $_time))
        _alert_('保留方式出错');
    return addslashes($_string);
}
function _set_cookies($_username,$_uniqid,$_time){
    switch ($_time)
    {
        case'0':
            setcookie('username',$_username);
            setcookie('uniqid',$_uniqid);
            break;
        case'1':
            setcookie('username',$_username,time()+86400);
            setcookie('uniqid',$_uniqid,time()+86400);
            break;
        case'2':
            setcookie('username',$_username,time()+604800);
            setcookie('uniqid',$_uniqid,time()+604800);
            break;
        case'3':
            setcookie('username',$_username,time()+2592000);
            setcookie('uniqid',$_uniqid,time()+2592000);
            break;
    }
}
?>