<?php /* Smarty version 2.6.19, created on 2013-02-02 10:52:19
         compiled from dataset_browser_filters_div.tpl */ ?>






	
	





  <?php if ($this->_tpl_vars['filters'] || $this->_tpl_vars['dataset']->data['fts_columns']): ?>
	<div class="s_browser_filtry_ul_cont">
	  <?php if ($this->_tpl_vars['dataset']->data['fts_columns']): ?>
		<h2><?php echo $this->_tpl_vars['dataset']->data['fts_label']; ?>
</h2>
		<ul class="s_browser_k_ul">
		  <li class="main">
		    <input name="k[]" class="s_text_input" type="text" value="<?php echo $this->_tpl_vars['k']['0']; ?>
" />
		    <?php echo $this->_tpl_vars['k_str']; ?>

		  </li>
		</ul>
		<?php endif; ?>
	  <?php unset($this->_sections['filters']);
$this->_sections['filters']['name'] = 'filters';
$this->_sections['filters']['loop'] = is_array($_loop=$this->_tpl_vars['filters']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['filters']['show'] = true;
$this->_sections['filters']['max'] = $this->_sections['filters']['loop'];
$this->_sections['filters']['step'] = 1;
$this->_sections['filters']['start'] = $this->_sections['filters']['step'] > 0 ? 0 : $this->_sections['filters']['loop']-1;
if ($this->_sections['filters']['show']) {
    $this->_sections['filters']['total'] = $this->_sections['filters']['loop'];
    if ($this->_sections['filters']['total'] == 0)
        $this->_sections['filters']['show'] = false;
} else
    $this->_sections['filters']['total'] = 0;
if ($this->_sections['filters']['show']):

            for ($this->_sections['filters']['index'] = $this->_sections['filters']['start'], $this->_sections['filters']['iteration'] = 1;
                 $this->_sections['filters']['iteration'] <= $this->_sections['filters']['total'];
                 $this->_sections['filters']['index'] += $this->_sections['filters']['step'], $this->_sections['filters']['iteration']++):
$this->_sections['filters']['rownum'] = $this->_sections['filters']['iteration'];
$this->_sections['filters']['index_prev'] = $this->_sections['filters']['index'] - $this->_sections['filters']['step'];
$this->_sections['filters']['index_next'] = $this->_sections['filters']['index'] + $this->_sections['filters']['step'];
$this->_sections['filters']['first']      = ($this->_sections['filters']['iteration'] == 1);
$this->_sections['filters']['last']       = ($this->_sections['filters']['iteration'] == $this->_sections['filters']['total']);
?><?php $this->assign('f', $this->_tpl_vars['filters'][$this->_sections['filters']['index']]); ?>
	  <div class="filter_div<?php if (! $this->_tpl_vars['f']['parent_field']): ?> visible<?php endif; ?><?php if ($this->_tpl_vars['f']['selected']): ?> expanded<?php endif; ?>" field="<?php echo $this->_tpl_vars['f']['field']; ?>
">
		  <h2><i></i> <?php echo $this->_tpl_vars['f']['tytul']; ?>
<span class="c">:</span></h2>
			<ul class="s_browser_filtry_ul"<?php if (! $this->_tpl_vars['f']['selected']): ?> style="display: none;"<?php endif; ?>>
		  <li class="filter_li" field="<?php echo $this->_tpl_vars['f']['field']; ?>
" selected="<?php if ($this->_tpl_vars['f']['selected']): ?>true<?php else: ?>false<?php endif; ?>"<?php if ($this->_tpl_vars['f']['selected']): ?> selectedValue="<?php echo $this->_tpl_vars['f']['selected_value']; ?>
"<?php endif; ?>>
		    <?php if ($this->_tpl_vars['f']['selected']): ?>
		      <input type="hidden" name="w[]" value="<?php echo $this->_tpl_vars['f']['field']; ?>
" />
		      <input type="hidden" name="w[]" value="<?php echo $this->_tpl_vars['f']['selected_operator']; ?>
" />
		      <input type="hidden" name="w[]" value="<?php echo $this->_tpl_vars['f']['selected_value']; ?>
" />
		    <?php endif; ?>
		    <ul class="s_browser_filtry_ul_results _LOADING"></ul>
		    <input style="display: none;" type="button" class="mBtn h first wszystkie_opcje s_browser_mbtn soft" value="Wszystkie opcje">
		  </li>
			</ul>
	  </div>
	  <?php endfor; endif; ?>
	</div>
  <?php endif; ?>