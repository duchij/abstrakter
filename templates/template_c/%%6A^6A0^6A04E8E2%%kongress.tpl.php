<?php /* Smarty version 2.6.28, created on 2015-11-09 13:17:08
         compiled from kongress.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_select_date', 'kongress.tpl', 16, false),)), $this); ?>

		<?php echo $this->_tpl_vars['data']['message']; ?>

<div id="tabs">
    <ul>
	   <li><a href="#tab1">Info kongress</a></li>
	   <li><a href="#tab2">Info stranka</a></li>
	</ul>
	<div id="tab1">
				<h1>Akcia / Seminár / Konferencia / Kongress...</h1>
				<table class="responsive" data-max="15">
					<tr><td>Názov kongresu:</td><td> <input type="text" name="congress_titel" value="<?php echo $this->_tpl_vars['data']['congress_titel']; ?>
" style='width:400px'></td></tr>
					<tr><td>Podnázov:</td><td> <input type="text" name="congress_subtitel" value="<?php echo $this->_tpl_vars['data']['congress_subtitel']; ?>
"  style='width:400px;'></td></tr>
					<tr><td>URL adresa:</td><td> <input type="text" name="congress_url" value="<?php echo $this->_tpl_vars['data']['congress_url']; ?>
" style='width:400px;'></td></tr>
					<tr><td>Venue: </td><td><input type="text" name="congress_venue" value="<?php echo $this->_tpl_vars['data']['congress_venue']; ?>
" style='width:400px;'></td></tr>
					<tr><td colspan="2"><hr></td>
					<tr><td>Kongress od:</td><td> <?php echo smarty_function_html_select_date(array('prefix' => 'kondateOd_','start_year' => '2014','end_year' => '2020','time' => $this->_tpl_vars['data']['congress_from']), $this);?>
</td></tr>
					<tr><td>Kongress do:</td><td> <?php echo smarty_function_html_select_date(array('prefix' => 'kondateDo_','start_year' => '2014','end_year' => '2020','time' => $this->_tpl_vars['data']['congress_until']), $this);?>
 </td></tr>
					<tr><td colspan="2"><hr></td>
					<tr><td>Registrácia od:</td><td> <?php echo smarty_function_html_select_date(array('prefix' => 'dateOd_','start_year' => '2014','end_year' => '2020','time' => $this->_tpl_vars['data']['congress_regfrom']), $this);?>
</td></tr>
					<tr><td>Registrácia do:</td><td> <?php echo smarty_function_html_select_date(array('prefix' => 'dateDo_','start_year' => '2014','end_year' => '2020','time' => $this->_tpl_vars['data']['congress_reguntil']), $this);?>
</td></tr>
					<tr><td>Verejne viditeľný:</td><td> <input type="checkbox" name="public" value="1" <?php echo $this->_tpl_vars['data']['public']; ?>
></td></tr>
					
					
					<tr><td colspan="2"><button class="green button">Ulozit</button></tr>
				</table>
	</div>
	<div id="tab2">
	<textarea class="dtextbox">Popis</textarea>
	</div>
	
</div>

	