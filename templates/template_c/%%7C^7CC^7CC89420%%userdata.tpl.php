<?php /* Smarty version 2.6.28, created on 2014-02-18 09:34:13
         compiled from userdata.tpl */ ?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/layout.css">
<meta charset="UTF-8">
<title>Abstrakter - User Data</title>
</head>
<script src="js/abstracter.js"></script>
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
		<div id="content-left">
		<ul>
		<?php if ($this->_tpl_vars['admin']): ?>
			<li><a href="app.php?addcon=1">Kongresy</a></li>
		<?php endif; ?>
			<li><a href="app.php?logout=1">Odhlásiť sa</a></li>
			</ul>
		</div>
		<div id="content-main">
		
		<h1>Kontaktne údaje...</h1>
		<?php echo $this->_tpl_vars['data']['message']; ?>

				<form method='post' action="app.php">
				<input type="hidden" name="insUserData_fnc" value="1">
				<table>
					
					<tr> 
					<td width="200px" valign="top">Titul pred menom: </td>
					
					<td><input type="text" name="titul_pred" value="<?php echo $this->_tpl_vars['data']['titul_pred']; ?>
"  style="width:400px;"></td>
					
					</tr>
					
					<tr><td width="200px" valign="top">Meno:</td> <td><input type="text" name="meno" value="<?php echo $this->_tpl_vars['data']['meno']; ?>
" style="width:400px;"></td></tr>
					<tr><td width="200px" valign="top">Priezvisko:</td> <td><input type="text" name="priezvisko" value="<?php echo $this->_tpl_vars['data']['priezvisko']; ?>
"  style="width:400px;"></td></tr>
					<tr><td width="200px" valign="top">Titul za menom:</td> <td> <input type="text" name="titul_za" value="<?php echo $this->_tpl_vars['data']['titul_za']; ?>
"  style="width:400px;"></td></tr>
					<tr><td width="200px" valign="top">Kontaktný email:</td> <td> <input type="text" name="contact_email" value="<?php echo $this->_tpl_vars['data']['contact_email']; ?>
"  style="width:400px;"></td></tr>
					<tr><td width="200px" valign="top">Adresa pracoviska:</td> <td> <textarea rows="10" name="adresa" style="width:400px;" ><?php echo $this->_tpl_vars['data']['adresa']; ?>
</textarea></td></tr>
					<tr><td colspan="2"><input type="submit" value="Ulož"></td></tr>
								
			
		</table>
		</form>
		</div>
		<div id="content-right">
			 	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "regbyuser.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><hr/>
 				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "avabkongres.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		
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