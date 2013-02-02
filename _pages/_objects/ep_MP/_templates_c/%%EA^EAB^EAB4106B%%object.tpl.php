<?php /* Smarty version 2.6.19, created on 2013-02-02 11:29:25
         compiled from /MAMP/GitHub/OchParliament/_pages/_objects/object.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'dataset_browser', '/MAMP/GitHub/OchParliament/_pages/_objects/object.tpl', 2, false),array('modifier', 'cat', '/MAMP/GitHub/OchParliament/_pages/_objects/object.tpl', 4, false),)), $this); ?>
<?php if ($this->_tpl_vars['M']['OBJECT_TAB']['type'] == 'dataset'): ?>
  <?php echo sf_dataset_browser(array('dataset' => $this->_tpl_vars['M']['OBJECT_TAB']['dataset'],'request' => $_REQUEST), $this);?>

<?php elseif ($this->_tpl_vars['M']['OBJECT_TAB']['type'] == 'file'): ?>
  <?php $this->assign('file', ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['M']['ROOT'])) ? $this->_run_mod_handler('cat', true, $_tmp, "/_pages/") : smarty_modifier_cat($_tmp, "/_pages/")))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['M']['ID']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['M']['ID'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "/tabs/") : smarty_modifier_cat($_tmp, "/tabs/")))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['M']['OBJECT_TAB']['id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['M']['OBJECT_TAB']['id'])))) ? $this->_run_mod_handler('cat', true, $_tmp, ".tpl") : smarty_modifier_cat($_tmp, ".tpl"))); ?>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['file'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php else: ?>
  <?php $this->assign('file', ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['M']['ROOT'])) ? $this->_run_mod_handler('cat', true, $_tmp, "/_pages/") : smarty_modifier_cat($_tmp, "/_pages/")))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['M']['ID']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['M']['ID'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "/") : smarty_modifier_cat($_tmp, "/")))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['M']['NAME']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['M']['NAME'])))) ? $this->_run_mod_handler('cat', true, $_tmp, ".tpl") : smarty_modifier_cat($_tmp, ".tpl"))); ?>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['file'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>