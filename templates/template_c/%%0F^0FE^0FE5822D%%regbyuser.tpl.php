<?php /* Smarty version 2.6.28, created on 2014-02-11 15:19:22
         compiled from regbyuser.tpl */ ?>
<h1> Vase aktualne zahlasene abstrakty</h1>
<form method="post" action="app.php">
	<?php $_from = $this->_tpl_vars['regbyuser']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['reg_row']):
?>
	<?php echo $this->_tpl_vars['reg_row']['abstract_titul']; ?>
,<?php echo $this->_tpl_vars['reg_row']['congress_titel']; ?>
, <?php echo $this->_tpl_vars['reg_row']['congress_venue']; ?>

		<button name="editAbstr_fnc" value="<?php echo $this->_tpl_vars['reg_row']['congress_id']; ?>
">Oprav abstrakt...</button>
		<button name="deleteAbstr_fnc" value="<?php echo $this->_tpl_vars['reg_row']['congress_id']; ?>
">Zmaz svoj abstrakt...</button>	<br />	
	<?php endforeach; endif; unset($_from); ?>
</form>