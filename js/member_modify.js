window.onload=function (){
	code();
	var fm=document.getElementsByTagName('form')[0];
	fm.onsubmit = function(){
		
		if(fm.password.value.length<6 &&( fm.password.value.length!=0))
		{
			alert('密码在6~20位之间');
			fm.password.value='';
			fm.password.focus();
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
		return true;
	}
}