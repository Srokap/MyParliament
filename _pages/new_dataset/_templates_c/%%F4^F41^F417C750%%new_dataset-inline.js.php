<?php /* Smarty version 2.6.19, created on 2013-02-01 22:44:29
         compiled from new_dataset-inline.js */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'json_encode', 'new_dataset-inline.js', 1, false),)), $this); ?>
var aliases = <?php echo json_encode($this->_tpl_vars['aliases']); ?>

var fields = <?php echo json_encode($this->_tpl_vars['fields']); ?>

<?php echo '
$M.addInitCallback(function(){
	   new WIZARD( aliases, fields ); 
});
'; ?>