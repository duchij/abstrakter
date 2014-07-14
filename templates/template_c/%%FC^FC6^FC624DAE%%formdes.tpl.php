<?php /* Smarty version 2.6.28, created on 2014-07-14 15:10:53
         compiled from formdes/formdes.tpl */ ?>
<!--<form action="app.php" method="post">
 
<input type="hidden" name="fform_parse_string" value="">
<textarea rows="20" cols="100" name="formstring">
</textarea>
<input type="submit" name="" value="ukaz">
</form>
 -->

<table>
<?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i'] => $this->_tpl_vars['row']):
?>

	<?php if ($this->_tpl_vars['row']['type'] == 'input_text'): ?>
		<tr>
			<td><?php echo $this->_tpl_vars['row']['label']; ?>
:</td><td><input type="text" style="width:<?php echo $this->_tpl_vars['row']['width']; ?>
px" name="<?php echo $this->_tpl_vars['row']['field']; ?>
" value="<?php echo $this->_tpl_vars['row']['value']; ?>
"></td>
		</tr>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['row']['type'] == 'textarea'): ?>
		<tr>
			<td><?php echo $this->_tpl_vars['row']['label']; ?>
:</td><td><textarea name="<?php echo $this->_tpl_vars['row']['field']; ?>
" style="width:<?php echo $this->_tpl_vars['row']['width']; ?>
px;height:<?php echo $this->_tpl_vars['row']['height']; ?>
px;"><?php echo $this->_tpl_vars['row']['value']; ?>
</textarea></td>
		</tr>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['row']['type'] == 'radio'): ?>
	<tr>	
		<td><?php echo $this->_tpl_vars['row']['label']; ?>
:</td><td><input type="radio" name="<?php echo $this->_tpl_vars['row']['group']; ?>
" value="<?php echo $this->_tpl_vars['row']['value']; ?>
"></td>
	</tr>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['row']['type'] == 'selectlist'): ?>
	<tr>
		<td><?php echo $this->_tpl_vars['row']['label']; ?>
:</td><td><select style="width:<?php echo $this->_tpl_vars['row']['width']; ?>
px;">
				<?php $_from = $this->_tpl_vars['row']['value']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
					<option value='<?php echo $this->_tpl_vars['key']; ?>
'><?php echo $this->_tpl_vars['item']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
		</select>
	</tr>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</table>

</form>
<?php echo $this->_tpl_vars['sqlStr']; ?>