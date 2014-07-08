<?php /* Smarty version 2.6.28, created on 2014-07-08 10:57:01
         compiled from formdes/formdes2.tpl */ ?>
<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="css/designer.css" >
<link rel="stylesheet" type="text/css" href="js/src/fancyfields.css" >
<meta charset="UTF-8">
<title>Formdes pokus</title>	


</head>
<body>
<?php echo '
<script type="text/javascript" src="js/jquery.js"></script>
'; ?>



<form>
<button name="TextBox" id="TextBox" type="button">TextBox</button>
<button name="TextArea" id="TextArea" type="button">TextArea</button>
</form>

<div id="designerPlace">
<form id="desForm">Design area:</form>
</div>
<div id="propertiesPlace"><h1>Properties for:</h1>
<form id="formProps">

<div><div class="properties_key_val">IDF:</div><div><input type="text" id="input_text_idf"></div></div>
<div><div class="properties_key_val">Label name:</div><div><input type="text" id="input_text_label"></div></div>
<div><div class="properties_key_val">Width:</div><div><input type="text" id="input_text_width"></div></div>
<div><div class="properties_key_val">Height:</div><div><input type="text" id="input_text_height"></div></div>
<div><div class="properties_key_val">Text:</div><div><input type="text" id="input_text_text"></div></div>
<div><div class="properties_key_val">Column name:</div><div><input type="text" id="input_text_column_name"></div></div>
<div><div class="properties_key_val">Column size:</div><div><input type="text" id="input_text_column_size"></div></div>
<div><div class="properties_key_val">Items:</div><div><input type="text" id="input_text_items"></div></div>

</form>

</div>
<?php echo '
<script type="text/javascript" src="js/myfnc.js"></script>
'; ?>


</body>
</html>