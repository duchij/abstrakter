<?php /* Smarty version 2.6.28, created on 2014-02-19 19:51:46
         compiled from emails/registration_info.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'emails/registration_info.tpl', 9, false),)), $this); ?>
<html>
<body>

<h3>Vážená kolegyňa, Vážený kolega <?php echo $this->_tpl_vars['data']['user_meno']; ?>
 <?php echo $this->_tpl_vars['data']['user_priezvisko']; ?>
</h3>

<p>Dovoľujeme si Vás informovať o úspešnej registrácii na <strong><br>
<?php echo $this->_tpl_vars['data']['congress_titel']; ?>
</strong>, <br>
ktorý sa koná v dňoch
<em><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['congress_from'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
 - <?php echo ((is_array($_tmp=$this->_tpl_vars['data']['congress_until'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
, <?php echo $this->_tpl_vars['data']['congress_venue']; ?>
</em>
</p> 
<strong>Formou:</strong><br>
<?php if ($this->_tpl_vars['data']['reg_participation'] === 'aktiv'): ?>
<p>Aktívnou:</p>
<p><strong><?php echo $this->_tpl_vars['data']['reg_abstract_titul']; ?>
</strong><br>
Autor:<strong> <?php echo $this->_tpl_vars['data']['reg_main_autor']; ?>
</strong><br>
Spoluautori:<strong> <?php echo $this->_tpl_vars['data']['reg_abstract_autori']; ?>
</strong><br>
Pracovisko:<strong> <?php echo $this->_tpl_vars['data']['reg_abstract_adresy']; ?>
</strong><br></p>
<?php endif; ?>
<?php if ($this->_tpl_vars['data']['reg_participation'] === 'pasiv'): ?>
<p>Ako spoluautor</p>
<?php endif; ?>
<?php if ($this->_tpl_vars['data']['reg_participation'] === 'visit'): ?>
<p>Ako návštevník</p>
<?php endif; ?>

<p>
ďakujeme za Vašu účasť, pri aktívnej účasti si môžete Vašu prednášku/poster opraviť ev. zmazať do dátumu uzavierky.
</p>
s pozdravom<br>

organizačným tím <em><?php echo $this->_tpl_vars['data']['congress_titel']; ?>
</em>
</body>
</html>