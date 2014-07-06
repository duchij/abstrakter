<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="css/designer.css" >
<link rel="stylesheet" type="text/css" href="js/src/fancyfields.css" >
<meta charset="UTF-8">
<title>Formdes pokus</title>	


</head>
<body>
{literal}
<script type="text/javascript" src="js/jquery.js"></script>
{/literal}


<form>
<button name="TextBox" id="TextBox" type="button">TextBox</button>
<button name="TextArea" id="TextArea" type="button">TextArea</button>
</form>

<div id="designerPlace">
<form id="desForm">Design area:</form>
</div>
<div id="propertiesPlace"><p>Properties for:</p>
<form id="formProps">
<div>IDF: <input type="text" id="input_text_idf"></div>
<div>Label name:<input type="text" id="input_text_label"></div>
<div>Width:<input type="text" id="input_text_width"></div>
<div>Height:<input type="text" id="input_text_height"></div>
<div>Text:<input type="text" id="input_text_text"></div>
<div>Column name:<input type="text" id="input_text_column_name"></div>
<div>Column size:<input type="text" id="input_text_column_size"></div>
<div>Items:<input type="text" id="input_text_items"></div>
</form>

</div>
{literal}
<script type="text/javascript" src="js/myfnc.js"></script>
{/literal}

</body>
</html>