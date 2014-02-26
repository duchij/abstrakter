<?php /* Smarty version 2.6.28, created on 2014-02-25 16:37:58
         compiled from admin/form_templater.tpl */ ?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/layout.css">

<link rel="stylesheet" href="js/src/fancyfields.css" /> 
<meta charset="UTF-8">
<title>Form templater</title>
<script src="js/abstracter.js"></script>
<script src="js/jquery.js"></script>
<script src="js/src/fancyfields-1.2.js"></script>

<script>
<?php echo '
$(document).ready(function() {
//console.log( "ready!" );
	$(\'#myForm\').fancyfields();
});
'; ?>

	</script>

</head>

<body>
<div id="myForm" style="width:600px;height:500px;border:1px solid;">
halo <input type="text" name="pokus">
</div>
</body>
</html>