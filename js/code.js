function code(){
	var code=document.getElementById('code')
	code.onclick=function(){
		javascript:this.src='code.php?tm='+Math.random();
	};
}