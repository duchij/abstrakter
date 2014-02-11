<?php /* Smarty version 2.6.28, created on 2014-02-11 14:48:23
         compiled from userdata.tpl */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Abstrakter - User Data</title>
</head>

<body>
	<h1>Kontaktne údaje...</h1>
	<a href="app.php?addcon=1">Pridaj kongress..</a>
	<a href="app.php?logout=1">Logout</a>
	
	<h3><?php echo $this->_tpl_vars['new_reg_msg']; ?>
</h3>
	<?php echo $this->_tpl_vars['message']; ?>
<br />
	<form method='post' action="app.php">
	<input type="hidden" name="insdat" value="1">
		Titul pred menom: <input type="text" name="titul_pred" value="<?php echo $this->_tpl_vars['titul_pred']; ?>
"><br />
		Meno: <input type="text" name="meno" value="<?php echo $this->_tpl_vars['meno']; ?>
"><br />
		Priezvisko: <input type="text" name="priezvisko" value="<?php echo $this->_tpl_vars['priezvisko']; ?>
"><br />
		Titul za menom: <input type="text" name="titul_za" value="<?php echo $this->_tpl_vars['titul_za']; ?>
"><br />
		Kontaktný email: <input type="text" name="contact_email" value="<?php echo $this->_tpl_vars['contact_email']; ?>
" ><br />
		Adresa pracoviska: <textarea cols="100" rows="5" name="adresa"><?php echo $this->_tpl_vars['adresa']; ?>
</textarea>
		<input type="submit" value="Vloz">
	</form>
 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "regbyuser.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>

</html>