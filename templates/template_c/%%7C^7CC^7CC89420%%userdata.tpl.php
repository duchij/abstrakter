<?php /* Smarty version 2.6.28, created on 2014-02-09 16:20:37
         compiled from userdata.tpl */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Abstrakter - User Data</title>
</head>

<body>
	<h1>Kontaktn údaje...</h1>
	<h3><?php echo $this->_tpl_vars['new_reg_msg']; ?>
</h3>
	<form method='post' action="index.php">
	<input type="hidden" name="insdat" value="1">
		Titul pred menom: <input type="text" name="titul_pred" value="<?php echo $this->_tpl_vars['titul_pred']; ?>
"><br />
		Meno: <input type="text" name="meno" value="<?php echo $this->_tpl_vars['meno']; ?>
"><br />
		Priezvisko: <input type="text" name="priezvisko" value="<?php echo $this->_tpl_vars['priezvisko']; ?>
"><br />
		Titul za menom: <input type="text" name="titul_za" value="<?php echo $this->_tpl_vars['titul_za']; ?>
"><br />
		email: <input type="text" name="" value="<?php echo $this->_tpl_vars['email']; ?>
"><br />
		Adresa pracoviska: <textarea cols="100" rows="5" name="adresa" value="<?php echo $this->_tpl_vars['adresa']; ?>
"></textarea>
		<input type="submit" value="Vloz">
	</form>
 
</body>

</html>