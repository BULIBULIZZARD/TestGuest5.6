window.onload=function(){
	code();
	var fm=document.getElementsByTagName('form')[0];

	fm.onsubmit=function(){
		if((fm.username.value.length<2)||(fm.username.value.length>20))
		{
			alert('请输入用户名在2为到20位之间');
			fm.username.value='';
			fm.username.focus();
			return false;
		}
		if(/[<>\'\"\ ]/.test(fm.username.value))
		{
			alert('用户名中不能有特殊字符');
			fm.username.value='';
			fm.username.focus();
			return false;
		}
		if((fm.password.value.length<6)||(fm.password.value.length>20))
		{
			alert('密码在6~20位之间');
			fm.password.value='';
			//fm.repassword.value='';
			fm.password.focus();
			return false;
		}
		if(fm.code.value.length!=4)
		{
			alert('验证4位');
			fm.code='';
			fm.code.focus();
			return false;
		}
	}
}