<?php /* Smarty version 2.6.28, created on 2014-02-19 20:55:38
         compiled from abstraktreg.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'var_dump', 'abstraktreg.tpl', 19, false),array('modifier', 'date_format', 'abstraktreg.tpl', 47, false),)), $this); ?>
<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="css/layout.css">

<meta charset="UTF-8">
<title>Abstrakter - Pridaj kongress</title>
<script src="js/abstracter.js"></script>

</head>
<?php echo '
<script>
test(\'0\');
</script>
'; ?>


<body>
<?php echo var_dump($this->_tpl_vars['data']); ?>




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
		<ul>
			<li><a href="app.php?run=1">Domov...</a></li>
			<?php if ($this->_tpl_vars['data']['admin']): ?>
			<li><a href="app.php?addcon=1">Kongress..</a></li>
			<?php endif; ?>
			<li><a href="app.php?logout=1">Odhlasiť sa</a></li>
		</ul>
		</div>
	<div id="content-main" style="width:750px;">
			<h1 class="logo">Prihlásenie na kongres</h1>
			<hr />
			<h2><?php echo $this->_tpl_vars['data']['congress']['congress_titel']; ?>
 </h2>
			<?php echo $this->_tpl_vars['data']['congress']['congress_subtitel']; ?>
<br>
			<a href="<?php echo $this->_tpl_vars['data']['congress']['congress_url']; ?>
" target="_blank">Web stranka...</a><br>
			<?php echo $this->_tpl_vars['data']['congress']['congress_venue']; ?>
<br>
			<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['congress']['congress_from'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
 - <?php echo ((is_array($_tmp=$this->_tpl_vars['data']['congress']['congress_until'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<br>
			<?php echo $this->_tpl_vars['data']['message']; ?>
<hr />
			
			<form name="form1" method='post' action="app.php">
			
			
				<input type="hidden" name="<?php echo $this->_tpl_vars['data']['functions']['fnc']; ?>
" value="<?php echo $this->_tpl_vars['data']['functions']['value']; ?>
">
				<input type="hidden" name="congress_id" value="<?php echo $this->_tpl_vars['data']['congress']['item_id']; ?>
">
				<input type="hidden" name="user_id" value="<?php echo $this->_tpl_vars['data']['congress']['user_id']; ?>
">
				<input type="hidden" name="registr_id" value="<?php echo $this->_tpl_vars['data']['abstract']['registr_id']; ?>
">
				<table>
				<tr><td> Aktívna účasť (autor)</td><td> <input type="radio" name="particip" value="aktiv"  <?php echo $this->_tpl_vars['data']['check_activ']; ?>
 onClick="test('1');" <?php echo $this->_tpl_vars['data']['state']; ?>
></td></tr>
				<tr><td>	Pasívna účasť (spoluautor)  </td><td>  <input type="radio" name="particip" value ="pasiv" <?php echo $this->_tpl_vars['data']['check_pasiv']; ?>
 onClick="test('0');"  <?php echo $this->_tpl_vars['data']['state']; ?>
></td></tr>
				<tr><td>	Pasívna účasť (návštevník)</td><td> 	<input type="radio" name="particip"  value ="visit" <?php echo $this->_tpl_vars['data']['check_visit']; ?>
 onClick="test('0');"  <?php echo $this->_tpl_vars['data']['state']; ?>
></td></tr>
				</table>
				
				<div id="block" style="border:none;padding:0px;margin:0px">
				<table>
				<tr><td> <input type="radio" name="section" value="doctor"> - Lekárska sekcia</td> <td><input type="radio" name="section" value="nurse" > - Sesterská sekcia</td></tr> 
				
				</table>
				
				<table>
					<tr><td width="150px" valign="top">Názov prednášky:</td><td>  <input type="text" name="abstract_titul" value="<?php echo $this->_tpl_vars['data']['abstract']['abstract_titul']; ?>
" style='width:600px;' <?php echo $this->_tpl_vars['data']['state']; ?>
></td></tr>
					<tr><td width="150px" valign="top">Názov pracoviska:</td><td>  <input type="text" name="abstract_adresy" value="<?php echo $this->_tpl_vars['data']['abstract']['abstract_adresy']; ?>
"  style='width:600px;' <?php echo $this->_tpl_vars['data']['state']; ?>
></td></tr>
					<tr><td width="150px" valign="top">Prvý autor:</td><td>  <input type="text" name="abstract_main_autor" value="<?php echo $this->_tpl_vars['data']['abstract']['abstract_main_autor']; ?>
" style='width:600px;' <?php echo $this->_tpl_vars['data']['state']; ?>
></td></tr>
					<tr><td width="150px" valign="top">Ostatný autori:</td><td>  <input type="text" name="abstract_autori" value="<?php echo $this->_tpl_vars['data']['abstract']['abstract_autori']; ?>
"  style='width:600px;' <?php echo $this->_tpl_vars['data']['state']; ?>
></td></tr>
					
					<tr><td width="150px" valign="top">Abstrakt:</td><td> <textarea name="abstract_text" rows="20"   style='width:600px;' <?php echo $this->_tpl_vars['data']['state']; ?>
><?php echo $this->_tpl_vars['data']['abstract']['abstract_text']; ?>
</textarea> </td></tr>
					
				
				
			</table>
			</div>
			<?php if ($this->_tpl_vars['data']['state'] != 'readonly'): ?>
					<input type="submit" value="<?php echo $this->_tpl_vars['data']['buttons']['registration_submit']; ?>
">
				<?php endif; ?>
	</form>
	</div>
	<!-- <div id="content-right">
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
		
		</div> -->
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