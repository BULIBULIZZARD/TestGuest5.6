<?php 

    define('name', 1);
    require __DIR__.'/includes/common.inc.php';
    define('SCRIPT','face');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>头像</title>
<?php 
    require __DIR__.'/includes/title.inc.php'
?>
<script type="text/javascript" src="js/opener.js"></script>
</head>
<body>

<div id="face">
 <h3>选择头像</h3>
 <dl>
 	<?php foreach(range(1,9)as $number){?>
 	<dd><img src="face/m0<?php echo $number ?>.gif" alt="face/m0<?php echo $number ?>.gif" title="头像<?php echo $number?>"></dd>
    <?php }?>
    
 </dl>
 <dl>
 	<?php foreach(range(10,64)as $number){?>
 	<dd><img src="face/m<?php echo $number ?>.gif" alt="face/m<?php echo $number ?>.gif" title="头像<?php echo $number ?>"></dd>
    <?php }?>
    
 </dl>
</div>
</body>
</html>