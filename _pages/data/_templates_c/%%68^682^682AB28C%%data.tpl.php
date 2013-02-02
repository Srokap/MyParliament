<?php /* Smarty version 2.6.19, created on 2013-02-02 10:41:51
         compiled from /MAMP/GitHub/OchParliament/_pages/data/data.tpl */ ?>
<div class="img_baner">
  
  <div class="top_div">
		<h1>Public Datasets</h1>
	</div>

</div>








<?php if ($this->_tpl_vars['datasets']): ?>
<div class="sbox wszystkie _left">
  
	<div class="all_datasets_div">
	  <ul class="datasets_ul">
	  <?php unset($this->_sections['datasets']);
$this->_sections['datasets']['name'] = 'datasets';
$this->_sections['datasets']['loop'] = is_array($_loop=$this->_tpl_vars['datasets']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['datasets']['show'] = true;
$this->_sections['datasets']['max'] = $this->_sections['datasets']['loop'];
$this->_sections['datasets']['step'] = 1;
$this->_sections['datasets']['start'] = $this->_sections['datasets']['step'] > 0 ? 0 : $this->_sections['datasets']['loop']-1;
if ($this->_sections['datasets']['show']) {
    $this->_sections['datasets']['total'] = $this->_sections['datasets']['loop'];
    if ($this->_sections['datasets']['total'] == 0)
        $this->_sections['datasets']['show'] = false;
} else
    $this->_sections['datasets']['total'] = 0;
if ($this->_sections['datasets']['show']):

            for ($this->_sections['datasets']['index'] = $this->_sections['datasets']['start'], $this->_sections['datasets']['iteration'] = 1;
                 $this->_sections['datasets']['iteration'] <= $this->_sections['datasets']['total'];
                 $this->_sections['datasets']['index'] += $this->_sections['datasets']['step'], $this->_sections['datasets']['iteration']++):
$this->_sections['datasets']['rownum'] = $this->_sections['datasets']['iteration'];
$this->_sections['datasets']['index_prev'] = $this->_sections['datasets']['index'] - $this->_sections['datasets']['step'];
$this->_sections['datasets']['index_next'] = $this->_sections['datasets']['index'] + $this->_sections['datasets']['step'];
$this->_sections['datasets']['first']      = ($this->_sections['datasets']['iteration'] == 1);
$this->_sections['datasets']['last']       = ($this->_sections['datasets']['iteration'] == $this->_sections['datasets']['total']);
?><?php $this->assign('d', $this->_tpl_vars['datasets'][$this->_sections['datasets']['index']]); ?>
	    <li>
	      <div class="li_inner">
		      <p class="tytul"><a href="/<?php echo $this->_tpl_vars['d']['base_alias']; ?>
"><?php echo $this->_tpl_vars['d']['name']; ?>
</a></p>
		      <p class="opis"><?php if ($this->_tpl_vars['M']['isAdmin']): ?><div class="_admin_editable" _admin_editable_id="dane/dataset/<?php echo $this->_tpl_vars['d']['base_alias']; ?>
"><?php endif; ?><?php if ($this->_tpl_vars['M']['isAdmin'] && ! $this->_tpl_vars['d']['opis']): ?>null<?php else: ?><?php echo $this->_tpl_vars['d']['opis']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['M']['isAdmin']): ?></div><?php endif; ?></p>
		      
		      <?php if ($this->_tpl_vars['M']['isAdmin']): ?>
		        <div class="admin_div" name="<?php echo $this->_tpl_vars['d']['name']; ?>
" base_alias="<?php echo $this->_tpl_vars['d']['base_alias']; ?>
" api_class="<?php echo $this->_tpl_vars['d']['results_class']; ?>
">
		          <input class="mBtn yellow info" type="button" value="Admin info" />
		        </div>
		      <?php endif; ?>
		      
	      </div>
	    </li>
	  <?php endfor; endif; ?>
	  </ul>
	</div>
  
</div>
<?php else: ?>

  <p id="msg">You don't have any datasets yet</p>

<?php endif; ?>


<p id="new_dataset_p"><a href="/new_dataset">Create new dataset &raquo;</a></p>