<?php /* Smarty version 2.6.28, created on 2014-02-11 14:47:45
         compiled from kongress.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_select_date', 'kongress.tpl', 23, false),)), $this); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Abstrakter - Pridaj kongress</title>
</head>

<body>
	<h1>Pridaj kongress...</h1>
	<a href="app.php?addcon=1">Pridaj kongress..</a>
	
	<a href="app.php?logout=1">Logout</a>
	
	
	<?php echo $this->_tpl_vars['message']; ?>
<br />
	<form method='post' action="app.php">
	<input type="hidden" name="inscongress" value="1">
		Názov kongresu: <input type="text" name="congress_titel" value="<?php echo $this->_tpl_vars['data']['congress_titel']; ?>
" style='width:500px'"><br />
		Podnázov: <input type="text" name="congress_subtitel" value="<?php echo $this->_tpl_vars['data']['congress_subtitel']; ?>
"  style='width:500px;'"><br />
		URL adresa: <input type="text" name="congress_url" value="<?php echo $this->_tpl_vars['data']['congress_url']; ?>
"><br />
		Venue: <input type="text" name="congress_venue" value="<?php echo $this->_tpl_vars['data']['congress_venue']; ?>
"><br />
		
		Kongress od: <?php echo smarty_function_html_select_date(array('prefix' => 'kondateOd_','start_year' => '2014','end_year' => '2020','time' => $this->_tpl_vars['data']['congress_from']), $this);?>
 <br />
		Kongress do: <?php echo smarty_function_html_select_date(array('prefix' => 'kondateDo_','start_year' => '2014','end_year' => '2020','time' => $this->_tpl_vars['data']['congress_until']), $this);?>
 <br />
		
		Registrácia od: <?php echo smarty_function_html_select_date(array('prefix' => 'dateOd_','start_year' => '2014','end_year' => '2020','time' => $this->_tpl_vars['data']['congress_regfrom']), $this);?>
 <br />
		Registrácia do: <?php echo smarty_function_html_select_date(array('prefix' => 'dateDo_','start_year' => '2014','end_year' => '2020','time' => $this->_tpl_vars['data']['congress_reguntil']), $this);?>
 <br />
		
		
		<input type="submit" value="Vloz">
	</form>
 	<h1> Dostupne aktivne kongresy</h1>
 	
 		<?php $_from = $this->_tpl_vars['data']['avakon']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i'] => $this->_tpl_vars['row']):
?>
 			
 			<form method="post" action="app.php">
 			<?php echo $this->_tpl_vars['row']['congress_titel']; ?>
, <?php echo $this->_tpl_vars['row']['congress_venue']; ?>
		
 				<!--<input type="hidden" name="editcon" value="<?php echo $this->_tpl_vars['row']['item_id']; ?>
">  -->
 				<button name="register" value="<?php echo $this->_tpl_vars['row']['item_id']; ?>
">Prihlas sa </button>
 				<button name="editcon" value="<?php echo $this->_tpl_vars['row']['item_id']; ?>
">Edituj kongress </button>
 				<!-- <a href="app.php?register=<?php echo $this->_tpl_vars['row']['item_id']; ?>
">Prihlas sa....</a> -->
 				<!--<input type="submit" value="Edituj">  -->
 			</form>
 			
		<?php endforeach; endif; unset($_from); ?>
 	
 	
 	
 
 
</body>

</html>