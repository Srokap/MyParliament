<?php /* Smarty version 2.6.19, created on 2013-02-02 11:05:04
         compiled from /MAMP/GitHub/OchParliament/_components/dataset_browser/smarty/list_item.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'kalendarzyk', '/MAMP/GitHub/OchParliament/_components/dataset_browser/smarty/list_item.tpl', 13, false),array('modifier', 'cat', '/MAMP/GitHub/OchParliament/_components/dataset_browser/smarty/list_item.tpl', 17, false),array('modifier', 'file_exists', '/MAMP/GitHub/OchParliament/_components/dataset_browser/smarty/list_item.tpl', 18, false),array('modifier', 'var_export', '/MAMP/GitHub/OchParliament/_components/dataset_browser/smarty/list_item.tpl', 21, false),)), $this); ?>
<li class="ep_Object <?php if ((1 & $this->_tpl_vars['iteration'])): ?>odd<?php else: ?>even<?php endif; ?><?php if ($this->_tpl_vars['item']->getDate()): ?> _date<?php endif; ?>">
  <div class="li_inner_controlls">
    <ul class="__controlls">
          </ul>
  </div>
  <?php if ($this->_tpl_vars['item']->getDate()): ?>
  <div class="li_inner_date">
    <?php echo ((is_array($_tmp=$this->_tpl_vars['item']->getDate())) ? $this->_run_mod_handler('kalendarzyk', true, $_tmp) : sm_kalendarzyk($_tmp)); ?>

  </div>
  <?php endif; ?>
  <div class="li_inner_content">
	  <?php $this->assign('file', smarty_modifier_cat(smarty_modifier_cat($this->_tpl_vars['include_path'], $this->_tpl_vars['class']), ".tpl")); ?>
	  <?php if (file_exists($this->_tpl_vars['file'])): ?>
	    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['file'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	  <?php else: ?>
	    <?php echo var_export($this->_tpl_vars['item']); ?>

	  <?php endif; ?>
  </div>
</li>