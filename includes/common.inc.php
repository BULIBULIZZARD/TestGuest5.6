<?php
    $_conn=null;
    if(!defined('name'))
    {
        exit('NOWAY');
    }
    define('ROOT_PATH',__DIR__.'\\');
   if(PHP_VERSION<'4.1.1')
       exit('版本过低,请升级后访问?');
   require ROOT_PATH.'global.func.php';
   require ROOT_PATH.'mysql.func.php';
   define('_START_', _runtime_());
   //usleep(2000000); 
   define(_HOST_, 'mysql:dbname=testguest;host=127.0.0.1');
   define(_DBHOST_, 'localhost');
   define(_DBUSER_, 'root');
   define(_DBPSW_, 'a369880790');
   define(_DBNAME_, 'testguest');
  _connect();
  _select_db($_conn);
  _set_names($_conn);
  
//短信提醒
$_message=_fetch_array($_conn,"select count(tg_id)  from tg_message where tg_touser='{$_COOKIE['username']}' and tg_state='0'");
if(empty($_message['0'])){
    $_message_html='<img src="images/m1.gif" alt="未读" title="未读"><strong><a href="member_message.php">0<a></strong>';
    
}
else {
  $_message_html = '<img src="images/m1.gif" alt="未读" title="未读"><strong><a href="member_message.php">('.$_message['0'].')<a></strong>';
  
}

   
   
   
   
   
   
   
   
   
   
   
   
   
   
   ?>