<?php /* Smarty version 2.6.28, created on 2014-02-12 13:45:43
         compiled from userdata.tpl */ ?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="http://doma.local/abstrakter/css/layout.css">
<meta charset="UTF-8">
<title>Abstrakter - User Data</title>
</head>

<body>

<div id="wrapper">
	<div id="header">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<h3><?php echo $this->_tpl_vars['new_reg_msg']; ?>
</h3>
		<?php echo $this->_tpl_vars['message']; ?>
<br />
	</div>
	
	<div id="content">
		<div id="content-left">
			<li><a href="app.php?addcon=1">Pridaj kongress..</a></li>
			<li><a href="app.php?logout=1">Logout</a></li>
		
		</div>
		<div id="content-main">
		<h1>Kontaktne údaje...</h1>
				<form method='post' action="app.php">
				<table width="auto">
					<input type="hidden" name="insdat" value="1">
					<tr> 
					<td width="200px" valign="top">Titul pred menom: </td>
					
					<td><input type="text" name="titul_pred" value="<?php echo $this->_tpl_vars['titul_pred']; ?>
"  style="width:400px;"></td>
					
					</tr>
					
					<tr><td width="200px" valign="top">Meno:</td> <td><input type="text" name="meno" value="<?php echo $this->_tpl_vars['meno']; ?>
" style="width:400px;"></td></tr>
					<tr><td width="200px" valign="top">Priezvisko:</td> <td><input type="text" name="priezvisko" value="<?php echo $this->_tpl_vars['priezvisko']; ?>
"  style="width:400px;"></td></tr>
					<tr><td width="200px" valign="top">Titul za menom:</td> <td> <input type="text" name="titul_za" value="<?php echo $this->_tpl_vars['titul_za']; ?>
"  style="width:400px;"></td></tr>
					<tr><td width="200px" valign="top">Kontaktný email:</td> <td> <input type="text" name="contact_email" value="<?php echo $this->_tpl_vars['contact_email']; ?>
"  style="width:400px;"></td></tr>
					<tr><td width="200px" valign="top">Adresa pracoviska:</td> <td> <textarea cols="50" rows="5" name="adresa" ><?php echo $this->_tpl_vars['adresa']; ?>
</textarea></td></tr>
					<tr><td colspan="2"><input type="submit" value="Vloz"></td></tr>
					
					
			</form>
		</table>
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