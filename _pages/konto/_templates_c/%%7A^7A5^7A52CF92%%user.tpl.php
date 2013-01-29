<?php /* Smarty version 2.6.19, created on 2013-01-22 15:26:54
         compiled from /Users/bona/Desktop/Work/OchParlament/_layout/user.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', '/Users/bona/Desktop/Work/OchParlament/_layout/user.tpl', 2, false),)), $this); ?>
<div id="s_body">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ((is_array($_tmp=$this->_tpl_vars['M']['ROOT'])) ? $this->_run_mod_handler('cat', true, $_tmp, "/_layout/header.tpl") : smarty_modifier_cat($_tmp, "/_layout/header.tpl")), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<div class="s_content_cont">
		<div class="bg_gradient<?php if ($_REQUEST['gradient'] == 'off'): ?> cancel<?php endif; ?>">	 
		  <div class="s_wrap s_main_content_container">
		    <div class="s_column_main_left">
		      <div class="s_main_left_menu">
			      <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ((is_array($_tmp=$this->_tpl_vars['M']['ROOT'])) ? $this->_run_mod_handler('cat', true, $_tmp, "/_layout/user_menu.tpl") : smarty_modifier_cat($_tmp, "/_layout/user_menu.tpl")), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		      </div>
		    </div><div class="s_column_main_right">
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