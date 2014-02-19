<?php /* Smarty version 2.6.28, created on 2014-02-19 19:28:21
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'index.tpl', 37, false),)), $this); ?>
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
			<table>
				<tr><td>Email:</td><td> <input type="text" name="email"></td></tr>
				<tr><td>Heslo:</td><td> <input type="password" name="password"></td></tr>
				
			
			<tr><td colspan="2"><button formaction="index.php?login_fnc=1" type="submit">Prihlás</button> 
			<button formaction="index.php?register_fnc=1"  >Vytvoriť nový účet</button>
			<button formaction="index.php?reset_fnc=1">Zabudnuté heslo?</button></td></tr>	
			</table>
			</form> 
			
		</div>
		 
		<div id="content-right" style="width:700px;">
		<h1>Aktuálne kongresy</h1><hr>
			 		<?php $_from = $this->_tpl_vars['avab_kongres']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i'] => $this->_tpl_vars['row']):
?>
			 			<strong><?php echo $this->_tpl_vars['row']['congress_titel']; ?>
</strong><br>
			 			<?php echo $this->_tpl_vars['row']['congress_subtitel']; ?>
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