<?php /* Smarty version 2.6.28, created on 2014-02-12 18:18:57
         compiled from kongress.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_select_date', 'kongress.tpl', 36, false),array('modifier', 'date_format', 'kongress.tpl', 55, false),)), $this); ?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/layout.css">
<meta charset="UTF-8">
<title>Abstrakter - Pridaj kongress</title>
</head>

<body>
<div id="wrapper">

	<div id="header"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		
	</div>
	
		<div id="content">
			<div id="content-left">
			<ul>
				<li><a href="app.php?run=1">Domov...</a></li>
				<li><a href="app.php?addcon=1">Pridaj kongress..</a></li>
				<li><a href="app.phxp?logout=1">Logout</a></li>
			</ul>
			</div>
		
		<div id="content-main"><?php echo $this->_tpl_vars['message']; ?>

		
				<h1>Akcia / Seminár / Konferencia / Kongress...</h1>
				<form method='post' action="app.php">
				<input type="hidden" name="<?php echo $this->_tpl_vars['data']['functions']['fnc']; ?>
" value="<?php echo $this->_tpl_vars['data']['functions']['value']; ?>
">
				<table width="100%">
					<tr><td>Názov kongresu:</td><td> <input type="text" name="congress_titel" value="<?php echo $this->_tpl_vars['data']['congress_titel']; ?>
" style='width:400px'></td></tr>
					<tr><td>Podnázov:</td><td> <input type="text" name="congress_subtitel" value="<?php echo $this->_tpl_vars['data']['congress_subtitel']; ?>
"  style='width:400px;'></td></tr>
					<tr><td>URL adresa:</td><td> <input type="text" name="congress_url" value="<?php echo $this->_tpl_vars['data']['congress_url']; ?>
" style='width:400px;'></td></tr>
					<tr><td>Venue: </td><td><input type="text" name="congress_venue" value="<?php echo $this->_tpl_vars['data']['congress_venue']; ?>
" style='width:400px;'></td></tr>
					<tr><td colspan="2"><hr></td>
					<tr><td>Kongress od:</td><td> <?php echo smarty_function_html_select_date(array('prefix' => 'kondateOd_','start_year' => '2014','end_year' => '2020','time' => $this->_tpl_vars['data']['congress_from']), $this);?>
</td></tr>
					<tr><td>Kongress do:</td><td> <?php echo smarty_function_html_select_date(array('prefix' => 'kondateDo_','start_year' => '2014','end_year' => '2020','time' => $this->_tpl_vars['data']['congress_until']), $this);?>
 </td></tr>
					<tr><td colspan="2"><hr></td>
					<tr><td>Registrácia od:</td><td> <?php echo smarty_function_html_select_date(array('prefix' => 'dateOd_','start_year' => '2014','end_year' => '2020','time' => $this->_tpl_vars['data']['congress_regfrom']), $this);?>
</td></tr>
					<tr><td>Registrácia do:</td><td> <?php echo smarty_function_html_select_date(array('prefix' => 'dateDo_','start_year' => '2014','end_year' => '2020','time' => $this->_tpl_vars['data']['congress_reguntil']), $this);?>
</td></tr>
					
					
					<tr><td colspan="2"><input type="submit" value="<?php echo $this->_tpl_vars['data']['buttons']['insert_new_kongres']; ?>
"></td></tr>
				</table>
				</form>
		</div>
		
		<div id="content-right">
		 		<h1> Dostupné kongresy</h1>
		 		<hr/>
		 			<form method="post" action="app.php">
		 			<?php $_from = $this->_tpl_vars['data']['avakon']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i'] => $this->_tpl_vars['row']):
?>	 			
		 					<p>
		 					<strong><?php echo $this->_tpl_vars['row']['congress_titel']; ?>
</strong><br />
		 					<?php echo $this->_tpl_vars['row']['congress_venue']; ?>
, <em><?php echo ((is_array($_tmp=$this->_tpl_vars['row']['congress_from'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
 - <?php echo ((is_array($_tmp=$this->_tpl_vars['row']['congress_until'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</em><br />	
		 				
		 					<button name="register" value="<?php echo $this->_tpl_vars['row']['item_id']; ?>
">Prihlásiť</button>
		 					<button name="editcon" value="<?php echo $this->_tpl_vars['row']['item_id']; ?>
">Upraviť</button>
		 					</p>
		 			<?php endforeach; endif; unset($_from); ?>
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