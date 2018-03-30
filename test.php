<?php


define('name', 1);
function _check_fq($_string,$_max_num)
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
require __DIR__.'/includes/register.func.php';
echo _check_fq('978082243@qq.com', 40);
echo _check_fq('fqfq@qq.com', 40);
?>