<?php /* Smarty version 2.6.19, created on 2013-02-02 10:58:15
         compiled from _dataset-inline.js */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'json_encode', '_dataset-inline.js', 1, false),)), $this); ?>
var _dataset = <?php echo json_encode($this->_tpl_vars['dataset']->data); ?>
;