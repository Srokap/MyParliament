<?php /* Smarty version 2.6.19, created on 2013-01-22 16:02:34
         compiled from rejestracja-inline.js */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'json_encode', 'rejestracja-inline.js', 1, false),)), $this); ?>
<?php if ($this->_tpl_vars['aktualnosci']['glosowania_data']): ?>var _glosowania_data = <?php echo json_encode($this->_tpl_vars['aktualnosci']['glosowania_data']); ?>
;<?php endif; ?>