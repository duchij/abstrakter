<?php /* Smarty version 2.6.28, created on 2014-02-19 19:28:39
         compiled from error.tpl */ ?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/layout.css">
<meta charset="UTF-8">
<title>Abstrakter</title>
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
		
		<div id="content-main" style="width:250px;">
			<!--  <form method='post' action="index.php">
			<input type='hidden' name='login_fnc' value='1'>
				Email: <input type="text" name="email"><br>
				Heslo: <input type="password" name="password"><br>
				
				<input type="submit" value="Prihlás"><button name='register_fnc' value='1' >Vytvoriť nový účet</button> 
			</form> -->
		</div>
		
		<div id="content-right" style="width:700px;">
		<h1 style="color:red;">Chyba....</h1>
		<?php echo $this->_tpl_vars['error']; ?>
<br>
		Naspäť na <a href="index.php">login....</a>
			 		
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