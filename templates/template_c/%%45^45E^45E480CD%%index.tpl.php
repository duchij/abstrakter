<?php /* Smarty version 2.6.28, created on 2015-11-10 07:21:48
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'index.tpl', 9, false),)), $this); ?>
<h1 class="red">Kongresy</h1>
<?php echo $this->_tpl_vars['links']; ?>

 	<form method="post" action="app.php">
 	
 		<?php $_from = $this->_tpl_vars['avab_kongress']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i'] => $this->_tpl_vars['row']):
?>
 		<p>
 			<h3><?php echo $this->_tpl_vars['row']['congress_titel']; ?>
</h3> <?php echo $this->_tpl_vars['row']['congress_venue']; ?>
<br><br>
 			<em><?php echo ((is_array($_tmp=$this->_tpl_vars['row']['congress_from'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
 - <?php echo ((is_array($_tmp=$this->_tpl_vars['row']['congress_until'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</em><br>
 			<button name="regKongresForUser_fnc" value="<?php echo $this->_tpl_vars['row']['item_id']; ?>
">Prihlásiť sa... </button>
 		</p>	
 			
 			
		<?php endforeach; endif; unset($_from); ?>
		</form>