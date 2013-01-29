<?php /* Smarty version 2.6.19, created on 2013-01-22 13:08:24
         compiled from /Users/bona/Desktop/Work/OchParlament/_layout/front.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', '/Users/bona/Desktop/Work/OchParlament/_layout/front.tpl', 3, false),array('modifier', 'truncate', '/Users/bona/Desktop/Work/OchParlament/_layout/front.tpl', 24, false),)), $this); ?>
<div id="s_body">

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ((is_array($_tmp=$this->_tpl_vars['M']['ROOT'])) ? $this->_run_mod_handler('cat', true, $_tmp, "/_layout/header.tpl") : smarty_modifier_cat($_tmp, "/_layout/header.tpl")), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	
  
  

  	
	<div class="s_content_cont">

	  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ((is_array($_tmp=$this->_tpl_vars['M']['ROOT'])) ? $this->_run_mod_handler('cat', true, $_tmp, "/_layout/main_search.tpl") : smarty_modifier_cat($_tmp, "/_layout/main_search.tpl")), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<div class="bg_gradient<?php if ($_REQUEST['gradient'] == 'off'): ?> cancel<?php endif; ?>">	 
		  
		  
		  
		  <div class="s_wrap s_main_content_container">				
		    <div class="s_column_main_right single">
		      
		      <?php if ($this->_tpl_vars['M']['BREAD_CRUMBS']): ?>
		      <div class="promo_display">
					  <ul class="s_breadcrumb">
							<?php unset($this->_sections['bread_crumbs']);
$this->_sections['bread_crumbs']['name'] = 'bread_crumbs';
$this->_sections['bread_crumbs']['loop'] = is_array($_loop=$this->_tpl_vars['M']['BREAD_CRUMBS']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['bread_crumbs']['show'] = true;
$this->_sections['bread_crumbs']['max'] = $this->_sections['bread_crumbs']['loop'];
$this->_sections['bread_crumbs']['step'] = 1;
$this->_sections['bread_crumbs']['start'] = $this->_sections['bread_crumbs']['step'] > 0 ? 0 : $this->_sections['bread_crumbs']['loop']-1;
if ($this->_sections['bread_crumbs']['show']) {
    $this->_sections['bread_crumbs']['total'] = $this->_sections['bread_crumbs']['loop'];
    if ($this->_sections['bread_crumbs']['total'] == 0)
        $this->_sections['bread_crumbs']['show'] = false;
} else
    $this->_sections['bread_crumbs']['total'] = 0;
if ($this->_sections['bread_crumbs']['show']):

            for ($this->_sections['bread_crumbs']['index'] = $this->_sections['bread_crumbs']['start'], $this->_sections['bread_crumbs']['iteration'] = 1;
                 $this->_sections['bread_crumbs']['iteration'] <= $this->_sections['bread_crumbs']['total'];
                 $this->_sections['bread_crumbs']['index'] += $this->_sections['bread_crumbs']['step'], $this->_sections['bread_crumbs']['iteration']++):
$this->_sections['bread_crumbs']['rownum'] = $this->_sections['bread_crumbs']['iteration'];
$this->_sections['bread_crumbs']['index_prev'] = $this->_sections['bread_crumbs']['index'] - $this->_sections['bread_crumbs']['step'];
$this->_sections['bread_crumbs']['index_next'] = $this->_sections['bread_crumbs']['index'] + $this->_sections['bread_crumbs']['step'];
$this->_sections['bread_crumbs']['first']      = ($this->_sections['bread_crumbs']['iteration'] == 1);
$this->_sections['bread_crumbs']['last']       = ($this->_sections['bread_crumbs']['iteration'] == $this->_sections['bread_crumbs']['total']);
?><?php $this->assign('b', $this->_tpl_vars['M']['BREAD_CRUMBS'][$this->_sections['bread_crumbs']['index']]); ?>
							<li><a title="<?php echo $this->_tpl_vars['b']['name']; ?>
" href="/<?php echo $this->_tpl_vars['b']['url']; ?>
"><i class="separator"></i><span><?php echo ((is_array($_tmp=$this->_tpl_vars['b']['name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 80, "...", false, true) : smarty_modifier_truncate($_tmp, 80, "...", false, true)); ?>
</span></a></li>
							<?php endfor; endif; ?>
						</ul>
					</div>
					<?php endif; ?>
					
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