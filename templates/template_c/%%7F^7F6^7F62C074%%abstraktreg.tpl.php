<?php /* Smarty version 2.6.28, created on 2014-02-11 14:24:38
         compiled from abstraktreg.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'abstraktreg.tpl', 36, false),)), $this); ?>
<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<title>Abstrakter - Pridaj kongress</title>
<script language="javascript">
<?php echo '

function test(st)
{
	//alert(st);
	var block = document.getElementById("block");
	if (st === \'0\')
	{
		block.style.visibility = "hidden";
	}
	else
	{
		block.style.visibility = "visible";
	}
}

'; ?>

</script>

</head>

<body>
	<h1>Prihlásenie na kongres</h1>
	<hr />
	<h2><?php echo $this->_tpl_vars['data']['congress']['congress_titel']; ?>
 </h2>
	<h3><?php echo $this->_tpl_vars['data']['congress']['congress_subtitel']; ?>
</h3>
	<a href="<?php echo $this->_tpl_vars['data']['congress']['congress_url']; ?>
" target="_blank">Web stranka...</a>
	<h3><?php echo $this->_tpl_vars['data']['congress']['congress_venue']; ?>
</h3>
	<h4><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['congress']['congress_from'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
 - <?php echo ((is_array($_tmp=$this->_tpl_vars['data']['congress']['congress_until'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</h4>
	<a href="app.php?addcon=1">Pridaj kongress..</a>
	
	<a href="app.php?logout=1">Logout</a>
	
	<?php echo $this->_tpl_vars['data']['message']; ?>
<br />
	<form method='post' action="app.php">
	
	<input type="hidden" name="regabstr" value="1">
	<input type="hidden" name="congress_id" value="<?php echo $this->_tpl_vars['data']['congress']['item_id']; ?>
">
	<input type="hidden" name="user_id" value="<?php echo $this->_tpl_vars['data']['congress']['user_id']; ?>
">
		Aktívna účasť (autor) <input type="radio" name="particip" value="aktiv" onClick="test('1');" checked><br/>
		Pasívna účasť (spoluautor)  <input type="radio" name="particip" value ="pasiv" onClick="test('0');"><br/>
		Pasívna účasť (návštevník)	<input type="radio" name="particip"  value ="visit" onClick="test('0');"><br/>
	<div id="block">
		Názov prednášky: <input type="text" name="abstract_titul" value="<?php echo $this->_tpl_vars['data']['abstract']['abstract_titul']; ?>
" style='width:500px;'><br />
		Názov pracoviska: <input type="text" name="abstract_adresy" value="<?php echo $this->_tpl_vars['data']['abstract']['abstract_adresy']; ?>
"  style='width:500px;'><br />
		Prvý autor: <input type="text" name="abstract_main_autor" value="<?php echo $this->_tpl_vars['data']['abstract']['abstract_main_autor']; ?>
"><br />
		Ostatný autori: <input type="text" name="abstract_autori" value="<?php echo $this->_tpl_vars['data']['abstract']['abstract_autori']; ?>
"><br />
		
		Abstrakt:<textarea name="abstract_text" cols="100" rows="20"><?php echo $this->_tpl_vars['data']['abstract']['abstract_text']; ?>
</textarea> <br />
		
	</div>
		<input type="submit" value="Prihlásiť sa....">
	</form>
</body>

</html>