<?php /* Smarty version 2.6.28, created on 2014-03-13 19:59:29
         compiled from formdes/formdes.tpl */ ?>
<form action="app.php" method="post">
<input type="hidden" name="fform_parse_string" value="">
<textarea rows="20" cols="100" name="formstring">
</textarea>
<input type="submit" name="" value="ukaz">
</form>


<table>
<?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i'] => $this->_tpl_vars['row']):
?>

	<?php if ($this->_tpl_vars['row']['type'] == 'input_text'): ?>
	
		<tr>
			<td><?php echo $this->_tpl_vars['row']['label']; ?>
:</td><td><input type="text" width="<?php echo $this->_tpl_vars['row']['width']; ?>
" name="<?php echo $this->_tpl_vars['row']['field']; ?>
" value="<?php echo $this->_tpl_vars['row']['value']; ?>
"></td>
		</tr>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['row']['type'] == 'textarea'): ?>
		<tr>
			<td><?php echo $this->_tpl_vars['row']['label']; ?>
:</td><td><textarea rows="<?php echo $this->_tpl_vars['row']['height']; ?>
" cols="<?php echo $this->_tpl_vars['row']['width']; ?>
" name="<?php echo $this->_tpl_vars['row']['field']; ?>
"><?php echo $this->_tpl_vars['row']['value']; ?>
</textarea></td>
		</tr>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['row']['type'] == 'radio'): ?>
	<tr>	
		<td><?php echo $this->_tpl_vars['row']['label']; ?>
:</td><td><input type="radio" name="<?php echo $this->_tpl_vars['row']['field']; ?>
" value="<?php echo $this->_tpl_vars['row']['value']; ?>
"></td>
	</tr>
	<?php endif; ?>
	
		

<?php endforeach; endif; unset($_from); ?>
</table>

</form>