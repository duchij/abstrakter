<?php /* Smarty version 2.6.28, created on 2014-02-12 13:19:35
         compiled from regbyuser.tpl */ ?>
<h1> Vaše aktuálne zahlasené abstrakty</h1>
<form method="post" action="app.php">   
	<?php $_from = $this->_tpl_vars['regbyuser']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['reg_row']):
?>
	
	<strong><?php echo $this->_tpl_vars['reg_row']['abstract_titul']; ?>
</strong><br />,<?php echo $this->_tpl_vars['reg_row']['congress_titel']; ?>
, <?php echo $this->_tpl_vars['reg_row']['congress_venue']; ?>
<br />
	
		<button name="editAbstr_fnc" value="<?php echo $this->_tpl_vars['reg_row']['registr_id']; ?>
">Edituj</button>
		
		<button name="deleteAbstr_fnc" value="<?php echo $this->_tpl_vars['reg_row']['congress_id']; ?>
" >Zmaž</button>
		<hr />
	
	<?php endforeach; endif; unset($_from); ?>
</form>