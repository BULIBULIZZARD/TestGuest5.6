<?php
    $_conn=null;
    if(!defined('name'))
    {
        exit('NOWAY');
    }
    @mysqli_close($_conn);
   
?>
<div id="footer">
		<p>执行时间<?php echo round((_runtime_()-_START_),4);?></p>
		<p><span>bluetest</span></p>
	</div>