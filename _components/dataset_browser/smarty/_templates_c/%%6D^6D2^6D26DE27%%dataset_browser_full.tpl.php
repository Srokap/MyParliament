<?php /* Smarty version 2.6.19, created on 2013-02-02 10:55:04
         compiled from dataset_browser_full.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'json_encode', 'dataset_browser_full.tpl', 1, false),array('modifier', 'cat', 'dataset_browser_full.tpl', 15, false),array('modifier', 'default', 'dataset_browser_full.tpl', 87, false),)), $this); ?>
<div class="_s_browser <?php echo $this->_tpl_vars['dataset']->data['base_alias']; ?>
" base_alias="<?php echo $this->_tpl_vars['dataset']->data['base_alias']; ?>
" initw='<?php echo json_encode($this->_tpl_vars['dataset']->get_init_wheres()); ?>
'>
  <div class="_performance" style="display: none;">
    <ul>
      <?php if ($this->_tpl_vars['dataset']->performance['data_query']): ?><li><p class="l">data_query</p><p class="v"><?php echo $this->_tpl_vars['dataset']->performance['data_query']; ?>
</p></li><?php endif; ?>
      <?php if ($this->_tpl_vars['dataset']->performance['found_rows_query']): ?><li><p class="l">found_rows_query</p><p class="v"><?php echo $this->_tpl_vars['dataset']->performance['found_rows_query']; ?>
</p></li><?php endif; ?>
      <?php if ($this->_tpl_vars['dataset']->performance['opening_files']): ?><li><p class="l">opening_files</p><p class="v"><?php echo $this->_tpl_vars['dataset']->performance['opening_files']; ?>
</p></li><?php endif; ?>
      <li><p class="l">total</p><p class="v"><?php echo $this->_tpl_vars['dataset']->performance['total']; ?>
</p></li>
    </ul>
  </div>
	<div class="s_browser_filters_cont">
		<form class="s_browser_form" method="get" action="">
		<div class="s_browser_main_cont">
		  <div class="s_filters_cont">
			  <div class="s_browser_side_div">
		      <?php if ($this->_tpl_vars['mode'] == 'browse'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ((is_array($_tmp=$this->_tpl_vars['ROOT'])) ? $this->_run_mod_handler('cat', true, $_tmp, "/_components/dataset_browser/smarty/dataset_browser_filters_div.tpl") : smarty_modifier_cat($_tmp, "/_components/dataset_browser/smarty/dataset_browser_filters_div.tpl")), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?>
		    </div>
		  </div><div class="s_browser_cont">
				<div class="s_browser">   
					  <div class="s_browser_cont_div">
					    <div class="s_brwoser_main_div">
					      <?php if ($this->_tpl_vars['mode'] == 'browse'): ?>
								  <div class="aoverflow s_browser_bar">
							      <div class="lalign lfloat">
							        <p class="s_browser_counter"><?php echo $this->_tpl_vars['nav_str']; ?>
</p>
							      </div><div class="ralign rfloat">
						          <?php if ($this->_tpl_vars['dataset']->fields): ?>
											<div class="s_browser_order">
											  <?php $this->assign('sort_order', 'DESC'); ?>
												<p class="sort_label">Sorting:</p>
											  <select name="o[]" class="main_select">
											  
											    <?php if ($this->_tpl_vars['add_sort_fields']): ?>
										      <optgroup label="<?php echo $this->_tpl_vars['add_sort_fields_label']; ?>
">
										      <?php unset($this->_sections['sort_fields']);
$this->_sections['sort_fields']['name'] = 'sort_fields';
$this->_sections['sort_fields']['loop'] = is_array($_loop=$this->_tpl_vars['add_sort_fields']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['sort_fields']['show'] = true;
$this->_sections['sort_fields']['max'] = $this->_sections['sort_fields']['loop'];
$this->_sections['sort_fields']['step'] = 1;
$this->_sections['sort_fields']['start'] = $this->_sections['sort_fields']['step'] > 0 ? 0 : $this->_sections['sort_fields']['loop']-1;
if ($this->_sections['sort_fields']['show']) {
    $this->_sections['sort_fields']['total'] = $this->_sections['sort_fields']['loop'];
    if ($this->_sections['sort_fields']['total'] == 0)
        $this->_sections['sort_fields']['show'] = false;
} else
    $this->_sections['sort_fields']['total'] = 0;
if ($this->_sections['sort_fields']['show']):

            for ($this->_sections['sort_fields']['index'] = $this->_sections['sort_fields']['start'], $this->_sections['sort_fields']['iteration'] = 1;
                 $this->_sections['sort_fields']['iteration'] <= $this->_sections['sort_fields']['total'];
                 $this->_sections['sort_fields']['index'] += $this->_sections['sort_fields']['step'], $this->_sections['sort_fields']['iteration']++):
$this->_sections['sort_fields']['rownum'] = $this->_sections['sort_fields']['iteration'];
$this->_sections['sort_fields']['index_prev'] = $this->_sections['sort_fields']['index'] - $this->_sections['sort_fields']['step'];
$this->_sections['sort_fields']['index_next'] = $this->_sections['sort_fields']['index'] + $this->_sections['sort_fields']['step'];
$this->_sections['sort_fields']['first']      = ($this->_sections['sort_fields']['iteration'] == 1);
$this->_sections['sort_fields']['last']       = ($this->_sections['sort_fields']['iteration'] == $this->_sections['sort_fields']['total']);
?><?php $this->assign('f', $this->_tpl_vars['add_sort_fields'][$this->_sections['sort_fields']['index']]); ?>
											    <option<?php if ($this->_tpl_vars['f']['selected']): ?><?php $this->assign('sort_order', $this->_tpl_vars['f']['direction']); ?> selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['f']['field']; ?>
"><?php echo $this->_tpl_vars['f']['tytul']; ?>
</option>
											    <?php endfor; endif; ?>
										      </optgroup>
										      
										      <optgroup label="<?php echo $this->_tpl_vars['dataset']->data['name']; ?>
">
											    <?php endif; ?>
											  
											    <?php unset($this->_sections['sort_fields']);
$this->_sections['sort_fields']['name'] = 'sort_fields';
$this->_sections['sort_fields']['loop'] = is_array($_loop=$this->_tpl_vars['dataset']->fields) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['sort_fields']['show'] = true;
$this->_sections['sort_fields']['max'] = $this->_sections['sort_fields']['loop'];
$this->_sections['sort_fields']['step'] = 1;
$this->_sections['sort_fields']['start'] = $this->_sections['sort_fields']['step'] > 0 ? 0 : $this->_sections['sort_fields']['loop']-1;
if ($this->_sections['sort_fields']['show']) {
    $this->_sections['sort_fields']['total'] = $this->_sections['sort_fields']['loop'];
    if ($this->_sections['sort_fields']['total'] == 0)
        $this->_sections['sort_fields']['show'] = false;
} else
    $this->_sections['sort_fields']['total'] = 0;
if ($this->_sections['sort_fields']['show']):

            for ($this->_sections['sort_fields']['index'] = $this->_sections['sort_fields']['start'], $this->_sections['sort_fields']['iteration'] = 1;
                 $this->_sections['sort_fields']['iteration'] <= $this->_sections['sort_fields']['total'];
                 $this->_sections['sort_fields']['index'] += $this->_sections['sort_fields']['step'], $this->_sections['sort_fields']['iteration']++):
$this->_sections['sort_fields']['rownum'] = $this->_sections['sort_fields']['iteration'];
$this->_sections['sort_fields']['index_prev'] = $this->_sections['sort_fields']['index'] - $this->_sections['sort_fields']['step'];
$this->_sections['sort_fields']['index_next'] = $this->_sections['sort_fields']['index'] + $this->_sections['sort_fields']['step'];
$this->_sections['sort_fields']['first']      = ($this->_sections['sort_fields']['iteration'] == 1);
$this->_sections['sort_fields']['last']       = ($this->_sections['sort_fields']['iteration'] == $this->_sections['sort_fields']['total']);
?><?php $this->assign('f', $this->_tpl_vars['dataset']->fields[$this->_sections['sort_fields']['index']]); ?>
											    <?php if ($this->_tpl_vars['f']['can_order'] == '1'): ?>
											    <option<?php if ($this->_tpl_vars['f']['selected']): ?><?php $this->assign('sort_order', $this->_tpl_vars['f']['direction']); ?> selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['f']['field']; ?>
"><?php echo $this->_tpl_vars['f']['tytul']; ?>
</option>
											    <?php endif; ?>
											    <?php endfor; endif; ?>
											    
											    <?php if ($this->_tpl_vars['add_sort_fields']): ?>
											    </optgroup>
											    <?php endif; ?>
											  </select>
											  <select name="o[]">
											    <option value="DESC"<?php if ($this->_tpl_vars['sort_order'] == 'DESC'): ?> selected="selected"<?php endif; ?>>descending</option>
											    <option value="ASC"<?php if ($this->_tpl_vars['sort_order'] == 'ASC'): ?> selected="selected"<?php endif; ?>>ascending</option>
											  </select>
											  <input class="mBtn blue s_browser_mbtn" type="submit" value="Sort" />
										  </div>
										  <?php endif; ?>
							      </div>
							    </div>
					        <div class="s_browser_pagination upper"><?php echo $this->_tpl_vars['pagination']['str']; ?>
</div>
						      <ul class="s_browser_results_ul<?php if ($this->_tpl_vars['dataset']->data['color_items'] != '1'): ?> nocoloring<?php endif; ?>">
						        <?php unset($this->_sections['items']);
$this->_sections['items']['name'] = 'items';
$this->_sections['items']['loop'] = is_array($_loop=$this->_tpl_vars['items']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['items']['show'] = true;
$this->_sections['items']['max'] = $this->_sections['items']['loop'];
$this->_sections['items']['step'] = 1;
$this->_sections['items']['start'] = $this->_sections['items']['step'] > 0 ? 0 : $this->_sections['items']['loop']-1;
if ($this->_sections['items']['show']) {
    $this->_sections['items']['total'] = $this->_sections['items']['loop'];
    if ($this->_sections['items']['total'] == 0)
        $this->_sections['items']['show'] = false;
} else
    $this->_sections['items']['total'] = 0;
if ($this->_sections['items']['show']):

            for ($this->_sections['items']['index'] = $this->_sections['items']['start'], $this->_sections['items']['iteration'] = 1;
                 $this->_sections['items']['iteration'] <= $this->_sections['items']['total'];
                 $this->_sections['items']['index'] += $this->_sections['items']['step'], $this->_sections['items']['iteration']++):
$this->_sections['items']['rownum'] = $this->_sections['items']['iteration'];
$this->_sections['items']['index_prev'] = $this->_sections['items']['index'] - $this->_sections['items']['step'];
$this->_sections['items']['index_next'] = $this->_sections['items']['index'] + $this->_sections['items']['step'];
$this->_sections['items']['first']      = ($this->_sections['items']['iteration'] == 1);
$this->_sections['items']['last']       = ($this->_sections['items']['iteration'] == $this->_sections['items']['total']);
?>
						          <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['list_item_path'], 'smarty_include_vars' => array('class' => $this->_tpl_vars['dataset']->items_class,'item' => $this->_tpl_vars['items'][$this->_sections['items']['index']],'iteration' => $this->_sections['items']['iteration'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						        <?php endfor; endif; ?>
						      </ul>
						      <div class="s_browser_pagination lower"><?php echo $this->_tpl_vars['pagination']['str']; ?>
</div>
					      <?php elseif ($this->_tpl_vars['mode'] == 'api'): ?>
					        <div class="s_browser_inner api">
					          <p>Aby pobierać dane o elementach w tym zbiorze, użyj obiektu <i>ep_Dataset</i> o identyfikatorze <i><?php echo $this->_tpl_vars['dataset']->data['base_alias']; ?>
</i>.</p>
					          <p>Przykład:</p>
					          <pre><code>
									    <p><span class="var">$dataset</span> = new <span class="function">ep_Dataset</span>(<span class="string">'<?php echo $this->_tpl_vars['dataset']->data['base_alias']; ?>
'</span>);</p>
									    <p><span class="var">$<?php echo $this->_tpl_vars['dataset']->data['base_alias']; ?>
</span> = <span class="var">$dataset</span>-><span class="function">find_all();</span></p>
									  </code></pre>
									  
									  <p>Metoda <i>find_all()</i> zwróci w tym przypadku tablicę obiektów klasy <i><?php echo $this->_tpl_vars['dataset']->data['results_class']; ?>
</i>. Każdy z tych obiektów będzie zawierał publiczną właściwość <i>data</i>, będącą tablicą asocjacyjną z następującymi kluczami:</p>
					          
					          <table class="api_keys_table" cellpadding="0" cellspacing="0" border="0">
					            <tr>
					              <th class="l">Klucz</th>
					              <th class="v">Znaczenie</th>
					            </tr>
					            <?php unset($this->_sections['rows']);
$this->_sections['rows']['name'] = 'rows';
$this->_sections['rows']['loop'] = is_array($_loop=$this->_tpl_vars['object_fields']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['rows']['show'] = true;
$this->_sections['rows']['max'] = $this->_sections['rows']['loop'];
$this->_sections['rows']['step'] = 1;
$this->_sections['rows']['start'] = $this->_sections['rows']['step'] > 0 ? 0 : $this->_sections['rows']['loop']-1;
if ($this->_sections['rows']['show']) {
    $this->_sections['rows']['total'] = $this->_sections['rows']['loop'];
    if ($this->_sections['rows']['total'] == 0)
        $this->_sections['rows']['show'] = false;
} else
    $this->_sections['rows']['total'] = 0;
if ($this->_sections['rows']['show']):

            for ($this->_sections['rows']['index'] = $this->_sections['rows']['start'], $this->_sections['rows']['iteration'] = 1;
                 $this->_sections['rows']['iteration'] <= $this->_sections['rows']['total'];
                 $this->_sections['rows']['index'] += $this->_sections['rows']['step'], $this->_sections['rows']['iteration']++):
$this->_sections['rows']['rownum'] = $this->_sections['rows']['iteration'];
$this->_sections['rows']['index_prev'] = $this->_sections['rows']['index'] - $this->_sections['rows']['step'];
$this->_sections['rows']['index_next'] = $this->_sections['rows']['index'] + $this->_sections['rows']['step'];
$this->_sections['rows']['first']      = ($this->_sections['rows']['iteration'] == 1);
$this->_sections['rows']['last']       = ($this->_sections['rows']['iteration'] == $this->_sections['rows']['total']);
?><?php $this->assign('r', $this->_tpl_vars['object_fields'][$this->_sections['rows']['index']]); ?>
					            <tr>
					              <td class="l"><?php echo $this->_tpl_vars['r']['key']; ?>
</td>
					              <td class="v"><?php if ($this->_tpl_vars['r']['key'] == 'id'): ?><?php echo ((is_array($_tmp=@$this->_tpl_vars['r']['desc'])) ? $this->_run_mod_handler('default', true, $_tmp, "Identyfikator obiektu w <i>ep_API</i>") : smarty_modifier_default($_tmp, "Identyfikator obiektu w <i>ep_API</i>")); ?>
<?php elseif ($this->_tpl_vars['r']['key'] == 'dokument_id'): ?><?php echo ((is_array($_tmp=@$this->_tpl_vars['r']['desc'])) ? $this->_run_mod_handler('default', true, $_tmp, "Identyfikator dokumentu w <i>ep_API</i>") : smarty_modifier_default($_tmp, "Identyfikator dokumentu w <i>ep_API</i>")); ?>
<?php else: ?><p class="title"><?php echo $this->_tpl_vars['r']['tytul']; ?>
</p><p class="title"><?php echo $this->_tpl_vars['r']['desc']; ?>
</p><?php endif; ?></td>
					            </tr>
					            <?php endfor; endif; ?>
					          </table>
					          
					        </div>
					      
					      <?php elseif ($this->_tpl_vars['mode'] == 'rss'): ?>
					        <div class="s_browser_inner rss">
					          <p>Możesz zaprenumerować informacje o nowych elementach w tym zbiorze. Oto link do kanału RSS:</p>
					          <input class="copy_content_input" type="text" readonly="readonly" value="http://rss.ochparliament.pl/<?php echo $this->_tpl_vars['dataset']->data['base_alias']; ?>
" />
					        </div>
					      <?php endif; ?>
					    </div>
					  </div>
				</div>
			</div>
		</div>
	  </form>
	</div>
</div>