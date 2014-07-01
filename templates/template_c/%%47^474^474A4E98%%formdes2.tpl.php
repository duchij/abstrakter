<?php /* Smarty version 2.6.28, created on 2014-06-06 06:54:52
         compiled from formdes/formdes2.tpl */ ?>
<!DOCTYPE html>
<html>

<head>

<link rel="stylesheet" type="text/css" href="css/layout.css" >

<!-- <link rel="stylesheet" type="text/css" href="js/src/fancyfields.css" > -->

<meta charset="UTF-8">
<title>Formdes pokus</title>	


<script src="js/jquery.js"></script>
</head>
<body>
<button name="TextBox" id="TextBox" type="button">TextBox</button>
<button name="TextArea" id="TextArea" type="button">TextArea</button>
<div id="designerPlace">halo</div>

<?php echo '
<script>
$( document ).ready(function() {
//window.alert( "ready!" );

	$("#TextBox").click(function(e){
		//window.alert( "ready!" );
		$("#designerPlace").append(\'<div>Text: <input type="text" name="lolo"/></div>\');
		
	});


});
</script>
'; ?>

</body>
</html>