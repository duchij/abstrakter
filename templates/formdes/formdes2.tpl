<!DOCTYPE html>
<html>

<head>

<link rel="stylesheet" type="text/css" href="css/designer.css" >

<link rel="stylesheet" type="text/css" href="js/src/fancyfields.css" >

<meta charset="UTF-8">
<title>Formdes pokus</title>	


<script src="js/jquery.js"></script>
</head>
<body>
<p>
<button name="TextBox" id="TextBox" type="button">TextBox</button>
<button name="TextArea" id="TextArea" type="button">TextArea</button>
</p>
<div id="designerPlace"><p>Design area:</p></div>
<div id="propertiesPlace"><p>Properties:</p>
IDF:
Width:
Height:
Text:
Items:

</div>


{literal}
<script>
$( document ).ready(function() {
//window.alert( "ready!" );

	$("#TextBox").click(function(e){
		//window.alert( "ready!" );
		$("#designerPlace").append('<div>Text: <input type="text" name="lolo"/></div>');
		
	});
	
	$("#TextArea").click(function(e){
		$("#designerPlace").append('<div>Textarea: <textarea name="lolo"></textarea></div>');
	});
	
	


});
</script>
{/literal}
</body>
</html>