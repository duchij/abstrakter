<?php /* Smarty version 2.6.28, created on 2014-02-15 08:42:12
         compiled from reguser.tpl */ ?>
<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="css/layout.css">
<meta charset="UTF-8">
<title>Abstrakter - Registration form</title>

</head>

<body>
<div id="wrapper">
	<div id="header">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
	
	<div id="content">
		
			<div id="content-main" style="width:900px;">
				<h1> Registrácia nového užívateľa do aplikácie ABSTRAKTER</h1>
				<hr />
				<form method='post' action="index.php">
					<input type="hidden" name="registerNewUser_fnc" value="1">
					<table>
						<tr><td>Email:</td><td> <input type="text" name="email"></td></tr>
						<tr><td>Heslo: </td><td> <input type="password" name="password"></td></tr>
						<tr><td>Re-Heslo:</td><td>  <input type="password" name="password2"></td></tr>
						<tr><td colspan="2"><input type="submit" value="Zaregistruj..."></td></tr>
						
					</table>
				</form> 
			</div>
	</div>
	<div id="footer"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
	<div id="bottom"></div>
</div>
</body>

</html>