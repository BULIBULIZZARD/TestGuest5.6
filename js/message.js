window.onload=function(){
	code();
	var fm=document.getElementsByTagName('form')[0];
	fm.onsubmit=function(){
		if(fm.code.value.length!=4)
		{
			alert('验证4位');
			fm.code.value='';
			fm.code.focus();
			return false;
		}
		if(fm.content.value.length>200)
		{
			alert('请输入小于两百字内容');
			fm.content.focus();
			return false;
		}
		if(fm.content.value.length==0)
		{
			alert('内容不能为空');
			fm.content.focus();
			return false;
		}
	}
}