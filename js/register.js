window.onload=function(){
	var faceimg= document.getElementById('faceimg');
	faceimg.onclick=function(){
		window.open('face.php','face','width=400,height=400,top=0,left=0,scrollbars=1');
	}
	code();
	//表单验证
	var fm=document.getElementsByTagName('form')[0];
	fm.onsubmit = function()
	{
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
			fm.repassword.value='';
			fm.password.focus();
			return false;
		}
		if(fm.password.value!=fm.repassword.value)
		{
			alert('两次密码不一致');
			fm.repassword.value='';
			fm.repassword.focus();
			return false;
		}
		if((fm.question.value.length<2)||(fm.question.value.length>20))
		{
			alert('验证问题2~20位');
			fm.question.value='';
			fm.question.focus();
			return false;
		}
		if((fm.answer.value.length<2)||(fm.answer.value.length>20))
		{
			alert('验证回答2~20位');
			fm.answer.value='';
			fm.answer.focus();
			return false;
		}
		if(fm.answer.value==fm.question.value)
		{
			alert('验证问题和验证回答不能相同');
			fm.answer.value='';
			fm.answer.focus();
			return false;
		}
		if(!/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(fm.email.value)){
			alert('邮箱格式不正确');
			fm.email.value='';
			fm.email.focus();
			return false;
		}
		if(!/^[1-9]{1}[0-9]{4,10}$/.test(fm.qq.value)&&fm.qq.value!=''){
			alert('qq格式不正确');
			fm.qq.value='';
			fm.qq.focus();
			return false;
		}
		if(!/^https?:\/\/(\w+\.)?[\.\w-\.]+(\.\w+)+$/.test(fm.url.value)&&fm.url.value!='http://'&&fm.url.value!=''){
			alert('url格式不正确');
			fm.url.value='http://';
			fm.url.focus();
			return false;
		}
		if(fm.code.value.length!=4)
		{
			alert('验证4位');
			fm.code.value='';
			fm.code.focus();
			return false;
		}
		
		
		return true;
	}
	
};