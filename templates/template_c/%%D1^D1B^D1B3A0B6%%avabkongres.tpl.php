<?php /* Smarty version 2.6.28, created on 2014-02-11 18:43:48
         compiled from avabkongres.tpl */ ?>
<h1> Dostupne aktivne kongresy</h1>
 	
 		<?php $_from = $this->_tpl_vars['avab_kongres']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i'] => $this->_tpl_vars['row']):
?>
 			
 			<form method="post" action="app.php">
 			<?php echo $this->_tpl_vars['row']['congress_titel']; ?>
, <?php echo $this->_tpl_vars['row']['congress_venue']; ?>
		
 				
 				<button name="regKongresForUser_fnc" value="<?php echo $this->_tpl_vars['row']['item_id']; ?>
">Prihl‡sié sa... </button>
 				
 			</form>
 			
		<?php endforeach; endif; unset($_from); ?>