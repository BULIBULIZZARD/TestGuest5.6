<?php
if (! defined('name')) {
    exit('NOWAY');
}

/*
 * _check_username()检查用户
 */

function _check_username($_string, $_min_num, $_max_num)
{
    $_string = trim($_string);
    if (mb_strlen($_string, 'utf-8') < $_min_num || mb_strlen($_string, 'utf-8') > $_max_num) {
        _alert_('用户名长度为' . $_min_num . '到' . $_max_num . '之间');
        exit();
    }
    $_char_pattern = '/[<>\'\"\ ]/';
    if (preg_match($_char_pattern, $_string)) {
        _alert_('用户名不能含有特殊字符');
    }
    $_mg[0] = 'fsh';
    $_mg[1] = 'null';
    foreach ($_mg as $i)
        if (preg_match('/' . $i . '/i', $_string))
            _alert_('被限制字段' . $i . '');
    // return mysqli_real_escape_string($link, $_string);
    // echo $_string;
    return $_string;
}

/*
 * _check_password()密码检查
 */
function _check_password($_first_pass, $_end_pass, $_min_num, $_max_num)
{
    if (strlen($_first_pass) < $_min_num || strlen($_first_pass) > $_max_num) {
        _alert_('请保持密码在' . $_min_num . '~' . $_max_num . '之间');
    }
    if ($_first_pass != $_end_pass) {
        _alert_('两次密码不一致');
    }
    return sha1($_first_pass);
}

/*
 * _check_question()检查密码提示
 */

function _check_question($_string, $_min_num, $_max_num)
{
    $_string=trim($_string);
    if (mb_strlen($_string, 'utf-8') < $_min_num || mb_strlen($_string, 'utf-8') > $_max_num) {
        _alert_('请输入提示在' . $_min_num . '到' . $_max_num . '之间');
        exit();
    }
    // echo $_string;
    return addslashes($_string);
    // return mysqli_real_escape_string($link, $string_to_escape)
}

/*
 *
 */
function _check_answer($_ques, $_answ, $_min_num, $_max_num)
{
    if (mb_strlen($_answ, 'utf-8') < $_min_num || mb_strlen($_answ, 'utf-8') > $_max_num) {
        _alert_('请输入回答在' . $_min_num . '到' . $_max_num . '之间');
        exit();
    }
    if ($_ques == $_answ)
        _alert_('密码提示与回答不可相同');
    return sha1($_answ);
}
/*
 * _check_email()检查邮箱
 */
function _check_email($_string,$_max_num)
{
    if (empty($_string)) {
        return null;
    } else if (! preg_match('/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/', $_string)) {
        _alert_('邮箱格式不正确');
    }
    else if(strlen($_string)>$_max_num)
    {
        _alert_('邮箱长度不正确');
    }
    //echo $_string;
    return $_string;
}
/*
 * _check_qq()
 */
function _check_qq($_string){
    if(empty($_string))
    {
        return null;
    }else if(!preg_match('/^[1-9]{1}[0-9]{4,10}$/', $_string)){
        _alert_('QQ号码不正确');
    }
    return $_string;
}
/*
 * _check_url()
 */
function _check_url($_string,$_max_num){
    if(empty($_string)||($_string=='http://'))
    {
        return null;
    }
    else if (!preg_match('/^https?:\/\/(\w+\.)?[\.\w-\.]+(\.\w+)+$/', $_string))
    {
        _alert_('请输入正确的url');
    }  
    else if(strlen($_string)>$_max_num)
    {
        _alert_('url 过长');
    }
    //echo $_string;
    return $_string;
}

/*
 * 
 */
function _check_uniqid($_first_uniqid,$_end_uniqid){
    //_alert_($_first_uniqid.'\n'.$_end_uniqid);
    if(($_first_uniqid!=$_end_uniqid)||(strlen($_end_uniqid)!=40))
    {
        _alert_('唯一标示符异常');
    }
    return $_first_uniqid;
    
}
/*
 * 
 */
function _check_face($_string)
{
    return addslashes($_string);
}

function _check_modify_password($_string,$_min_num){
    if (empty($_string))
    {
        return $_string;
    }
    if (strlen($_string) < $_min_num ) {
        _alert_('请保持密码大于' . $_min_num . '位');
    }
    return sha1($_string);
}

function _check_content($_string){
    if(mb_strlen($_string,'utf-8')>200){
        _alert_('请输入小于200位内容');
    }
    return $_string;
}



?>