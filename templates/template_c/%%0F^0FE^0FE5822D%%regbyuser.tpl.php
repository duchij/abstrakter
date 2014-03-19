<?php /* Smarty version 2.6.28, created on 2014-03-15 17:44:04
         compiled from regbyuser.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count_characters', 'regbyuser.tpl', 7, false),)), $this); ?>
<h1> Vaše aktuálne zahlasené abstrakty</h1>
<hr>
 
	<?php $_from = $this->_tpl_vars['regbyuser']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['reg_row']):
?>
	
	
	<?php if (((is_array($_tmp=$this->_tpl_vars['reg_row']['abstract_titul'])) ? $this->_run_mod_handler('count_characters', true, $_tmp) : smarty_modifier_count_characters($_tmp)) == 0): ?>
		<?php if ($this->_tpl_vars['reg_row']['reg_participation'] == 'aktiv'): ?>
			<h3>Aktívna účasť</h3>
		<?php endif; ?>
		
		<?php if ($this->_tpl_vars['reg_row']['reg_participation'] == 'pasiv'): ?>
			<h3>Pasívna úcasť</h3>
		<?php endif; ?>
		
		<?php if ($this->_tpl_vars['reg_row']['reg_participation'] == 'visit'): ?>
			<h3>Navštevník</h3>
		<?php endif; ?>
		
	<?php else: ?>
	<h3>Aktívna účasť</h3> 
	<h2><?php echo $this->_tpl_vars['reg_row']['abstract_titul']; ?>
</h2>
	<?php endif; ?>
	<strong><?php echo $this->_tpl_vars['reg_row']['congress_titel']; ?>
</strong><br> <?php echo $this->_tpl_vars['reg_row']['congress_venue']; ?>
<br />
	<p>
	<form name ="regabstrform" method="post" action="app.php"> 
		<button name="editAbstr_fnc" value="<?php echo $this->_tpl_vars['reg_row']['registr_id']; ?>
">Edituj</button>
	
	</form>
	<button  onClick="deleteConfirm('deleteAbstr_fnc;<?php echo $this->_tpl_vars['reg_row']['registr_id']; ?>
')" >Zmaž</button>
	</p>
		<hr />
	
	<?php endforeach; endif; unset($_from); ?>