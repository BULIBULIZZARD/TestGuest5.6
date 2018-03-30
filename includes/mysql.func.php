<?php 
//     if(!defined('name'))
//     {
//         exit('NOWAY');
//     }
define(_HOST_, 'mysql:dbname=testguest;host=127.0.0.1');
define(_DBHOST_, 'localhost');
define(_DBUSER_, 'root');
define(_DBPSW_, 'a369880790');
define(_DBNAME_, 'testguest');

$_conn=null;
function _connect(){
    global $_conn;
    if(!$_conn = @mysqli_connect(_DBHOST_, _DBUSER_, _DBPSW_)) 
        exit('数据库连接失败'.mysqli_error($_conn));
}
function _select_db($_conn){
   if(!mysqli_select_db($_conn,_DBNAME_))
   {
       exit('DBNAME'.mysqli_errno($_conn));
   }
       
}
function _set_names($_conn){

    if(!mysqli_query($_conn, 'SET NAMES UTF8'))
        exit('字符集错误');
}
function _query($_conn,$_sql){
   if(!$_result= mysqli_query($_conn, $_sql)){
       exit('sql语句错误'.mysqli_error($_conn));
   }
   return $_result;
}

function _fetch_array($_conn,$_sql){
    
   return  mysqli_fetch_array(_query($_conn, $_sql));
}

function _affected_rows($_conn){
    return mysqli_affected_rows($_conn);
}

function _is_repeat($_conn,$_sql,$_info)
{
    if(_fetch_array($_conn,$_sql))
    {
        _alert_('用户名已存在');
    }
}

function _fetch_array_list( $_result){
    return mysqli_fetch_array($_result);
    
}
function _num_rows($_result){
    return mysqli_num_rows($_result);
}
function _free($_result){
    return mysqli_free_result($_result);
}


_connect();
_select_db($_conn);
_set_names($_conn);

?>