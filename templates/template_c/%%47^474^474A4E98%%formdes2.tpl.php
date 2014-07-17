<?php /* Smarty version 2.6.28, created on 2014-07-17 09:03:02
         compiled from formdes/formdes2.tpl */ ?>
<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="css/designer.css" >
<link rel="stylesheet" type="text/css" href="js/src/fancyfields.css" >
<meta charset="UTF-8">
<title>Form Designer</title>	


</head>
<body>

<?php echo '
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/myfnc.js"></script>
'; ?>



<div id="wrapper">

<div id="activeArea">
<div id="designerPlace">
	<form>
	<button name="TextBox" id="TextBox" type="button" title="Simple textbox">TextBox</button>
	<button name="TextArea" id="TextArea" type="button" title="Textarea to enter more text">TextArea</button>
	<button name="SelectList" id="SelectList" type="button" title="Dropdown list with key/value">SelectList</button>
	<button name="RadioButton" id="RadioButton" type="button" title="Radiobutton with grouping">Radio</button>
	</form>
	<hr/>
	<form id="desForm"><h1>Design area:</h1><hr/></form>
	<button name="send" id="sendData" type="button">Create form</button>
</div>

<div id="propertiesPlace"><h1>Properties for:</h1><hr/>
	<form id="formProps">
	<div id="input_text_prop">
	<div><div class="properties_key_val">IDF:</div><div><input type="text" id="input_text_idf"></div></div>
	<div><div class="properties_key_val">Label name:</div><div><input type="text" id="input_text_label"></div></div>
	<div><div class="properties_key_val">Width:</div><div><input type="text" id="input_text_width"></div></div>
	<!-- <div><div class="properties_key_val">Height:</div><div><input type="text" id="input_text_height"></div></div> -->
	<div><div class="properties_key_val">Text:</div><div><input type="text" id="input_text_text"></div></div>
	<div><div class="properties_key_val">Column name:</div><div><input type="text" id="input_text_column_name"></div></div>
	<div><div class="properties_key_val">Column size:</div><div><input type="text" id="input_text_column_size"></div></div>
	<!-- <div><div class="properties_key_val">Items:</div><div><input type="text" id="input_text_items"></div></div> -->
	</div>
	<div id="textarea_text_prop">
	<div><div class="properties_key_val">IDF:</div><div><input type="text" id="textarea_idf"></div></div>
	<div><div class="properties_key_val">Textarea label:</div><div><input type="text" id="textarea_label"></div></div>
	<div><div class="properties_key_val">Width:</div><div><input type="text" id="textarea_width"></div></div>
	<div><div class="properties_key_val">Height:</div><div><input type="text" id="textarea_height"></div></div>
	<div><div class="properties_key_val">Text:</div><div><input type="text" id="textarea_text"></div></div>
	<div><div class="properties_key_val">Column name:</div><div><input type="text" id="textarea_column_name"></div></div>
	<!--  <div><div class="properties_key_val">Column size:</div><div><input type="text" id="input_text_column_size"></div></div>-->
	<!--  <div><div class="properties_key_val">Items:</div><div><input type="text" id="input_text_items"></div></div> -->
	</div>
	<div id="selectList_prop">
	<div><div class="properties_key_val">IDF:</div><div><input type="text" id="selectlist_idf"></div></div>
	<div><div class="properties_key_val">Selectlist label:</div><div><input type="text" id="selectlist_label"></div></div>
	<div><div class="properties_key_val">Width:</div><div><input type="text" id="selectlist_width"></div></div>
	<!-- <div><div class="properties_key_val">Height:</div><div><input type="text" id="textarea_height"></div></div> -->
	<div><div class="properties_key_val">Item/Value:</div><div><textarea id="selectlist_items" style="width:200px;height:100px;"> </textarea><button name="CreateList" id="CreateList" type="button">Create List</button></div></div>
	<div><div class="properties_key_val">Column name:</div><div><input type="text" id="selectlist_column_name"></div></div>
	<!--  <div><div class="properties_key_val">Column size:</div><div><input type="text" id="input_text_column_size"></div></div>-->
	<!--  <div><div class="properties_key_val">Items:</div><div><input type="text" id="input_text_items"></div></div> -->
	</div>

	<div id="radioButton_prop">
	<div><div class="properties_key_val">IDF:</div><div><input type="text" id="radio_idf"></div></div>
	<div><div class="properties_key_val">Radio label:</div><div><input type="text" id="radio_label"></div></div>
	<div><div class="properties_key_val">Radio group:</div><div><input type="text" id="radio_group" title="Group of one radio choice "></div></div>
	<div><div class="properties_key_val">Radio value:</div><div><input type="text" id="radio_value" title="The value which will be stored in database"></div></div>
	<!--  <div><div class="properties_key_val">Width:</div><div><input type="text" id="selectlist_width"></div></div>-->
	<!-- <div><div class="properties_key_val">Height:</div><div><input type="text" id="textarea_height"></div></div> -->
	<div><div class="properties_key_val">Column name:</div><div><input type="text" id="radio_column_name"></div></div>
	<!--  <div><div class="properties_key_val">Column size:</div><div><input type="text" id="input_text_column_size"></div></div>-->
	<!--  <div><div class="properties_key_val">Items:</div><div><input type="text" id="input_text_items"></div></div> -->
	</div>
</form>
</div>
	
</div>

<div id="createdForm"><h1>Form preview</h1>
	<div id="definitiveForm"></div>
</div>

<div id="tableProperties">
		<h1>Table, Congress & Other:</h1><hr/>
		<strong>For naming of your table</strong> use only letters, numbers or _. Other character will be not accepted !!!!<br/><br/>
		Table name: <input type="text" id="tableName"/><br/><br/>
		Your avaible Congress to associate with your form:<br/>
		<select>
		
		<?php $_from = $this->_tpl_vars['congress']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['row']):
?>
				<option val="<?php echo $this->_tpl_vars['row']['item_id']; ?>
"><?php echo $this->_tpl_vars['row']['congress_titel']; ?>
 / </option>
		<?php endforeach; endif; unset($_from); ?>
		
		</select><br>
		<button name="assocTableCongress" id="assocTable" type="button" title="Simple textbox">Assoc table with selected congress</button>
	</div>
</div>

</body>
</html>