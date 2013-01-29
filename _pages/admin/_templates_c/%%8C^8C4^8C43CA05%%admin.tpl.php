<?php /* Smarty version 2.6.19, created on 2013-01-28 14:07:14
         compiled from C:%5Cwork%5Cwww%5COchParlament/_layout/admin.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'C:\\work\\www\\OchParlament/_layout/admin.tpl', 2, false),)), $this); ?>
<div id="s_body">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ((is_array($_tmp=$this->_tpl_vars['M']['ROOT'])) ? $this->_run_mod_handler('cat', true, $_tmp, "/_layout/header.tpl") : smarty_modifier_cat($_tmp, "/_layout/header.tpl")), 'smarty_include_vars' => array('admin' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<div class="s_content_cont">
		<div class="bg_gradient<?php if ($_REQUEST['gradient'] == 'off'): ?> cancel<?php endif; ?>">	 
		  <div class="s_wrap s_main_content_container">
		    <div class="s_main_content_container_inner">
		      <?php echo $this->_tpl_vars['M']['PAGE_HTML']; ?>

		    </div>
		  </div>
	  </div>
  </div>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ((is_array($_tmp=$this->_tpl_vars['M']['ROOT'])) ? $this->_run_mod_handler('cat', true, $_tmp, "/_layout/footer.tpl") : smarty_modifier_cat($_tmp, "/_layout/footer.tpl")), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>