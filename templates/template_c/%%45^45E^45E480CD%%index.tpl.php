<?php /* Smarty version 2.6.28, created on 2014-02-13 21:46:52
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'index.tpl', 31, false),)), $this); ?>
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
			<form method='post' action="index.php">
			<input type='hidden' name='login_fnc' value='1'>
				Email: <input type="text" name="email"><br>
				Heslo: <input type="password" name="password"><br>
				
				<input type="submit" value="Prihlás"><button name='register_fnc' value='1' >Vytvoriť nový účet</button> 
			</form> 
		</div>
		
		<div id="content-right" style="width:700px;">
		<h1>Aktuálne kongresy</h1><hr>
			 		<?php $_from = $this->_tpl_vars['avab_kongres']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
			 			<h1><?php echo $this->_tpl_vars['row']['congress_title']; ?>
</h1>
			 			<?php echo $this->_tpl_vars['row']['congres_subtitle']; ?>
,<?php echo $this->_tpl_vars['row']['congress_venue']; ?>
<br>
			 			<em><?php echo ((is_array($_tmp=$this->_tpl_vars['row']['congress_from'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
 - <?php echo ((is_array($_tmp=$this->_tpl_vars['row']['congress_until'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</em>
			 			<hr />
			 		<?php endforeach; endif; unset($_from); ?>
			 		
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