<?php /* Smarty version 2.6.19, created on 2013-02-01 22:39:04
         compiled from /MAMP/GitHub/OchParliament/_lib/mPortal/resources/menu.tpl */ ?>
<?php unset($this->_sections['MENUGROUPS']);
$this->_sections['MENUGROUPS']['name'] = 'MENUGROUPS';
$this->_sections['MENUGROUPS']['loop'] = is_array($_loop=$this->_tpl_vars['M']['MENUGROUPSIDS']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['MENUGROUPS']['show'] = true;
$this->_sections['MENUGROUPS']['max'] = $this->_sections['MENUGROUPS']['loop'];
$this->_sections['MENUGROUPS']['step'] = 1;
$this->_sections['MENUGROUPS']['start'] = $this->_sections['MENUGROUPS']['step'] > 0 ? 0 : $this->_sections['MENUGROUPS']['loop']-1;
if ($this->_sections['MENUGROUPS']['show']) {
    $this->_sections['MENUGROUPS']['total'] = $this->_sections['MENUGROUPS']['loop'];
    if ($this->_sections['MENUGROUPS']['total'] == 0)
        $this->_sections['MENUGROUPS']['show'] = false;
} else
    $this->_sections['MENUGROUPS']['total'] = 0;
if ($this->_sections['MENUGROUPS']['show']):

            for ($this->_sections['MENUGROUPS']['index'] = $this->_sections['MENUGROUPS']['start'], $this->_sections['MENUGROUPS']['iteration'] = 1;
                 $this->_sections['MENUGROUPS']['iteration'] <= $this->_sections['MENUGROUPS']['total'];
                 $this->_sections['MENUGROUPS']['index'] += $this->_sections['MENUGROUPS']['step'], $this->_sections['MENUGROUPS']['iteration']++):
$this->_sections['MENUGROUPS']['rownum'] = $this->_sections['MENUGROUPS']['iteration'];
$this->_sections['MENUGROUPS']['index_prev'] = $this->_sections['MENUGROUPS']['index'] - $this->_sections['MENUGROUPS']['step'];
$this->_sections['MENUGROUPS']['index_next'] = $this->_sections['MENUGROUPS']['index'] + $this->_sections['MENUGROUPS']['step'];
$this->_sections['MENUGROUPS']['first']      = ($this->_sections['MENUGROUPS']['iteration'] == 1);
$this->_sections['MENUGROUPS']['last']       = ($this->_sections['MENUGROUPS']['iteration'] == $this->_sections['MENUGROUPS']['total']);
?>
  
  <?php $this->assign('GROUPID', $this->_tpl_vars['M']['MENUGROUPSIDS'][$this->_sections['MENUGROUPS']['index']]); ?>
  <?php $this->assign('MENU', $this->_tpl_vars['M']['MENU'][$this->_tpl_vars['GROUPID']]); ?>
  
  <div class="_MENU_BLOCK <?php echo $this->_tpl_vars['M']['MENUGROUPS'][$this->_tpl_vars['GROUPID']]['1']; ?>
">
    <h3><?php echo $this->_tpl_vars['M']['MENUGROUPS'][$this->_tpl_vars['GROUPID']]['0']; ?>
</h3>
        
    <ul>
    <?php unset($this->_sections['MENUITEM']);
$this->_sections['MENUITEM']['name'] = 'MENUITEM';
$this->_sections['MENUITEM']['loop'] = is_array($_loop=$this->_tpl_vars['MENU']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['MENUITEM']['show'] = true;
$this->_sections['MENUITEM']['max'] = $this->_sections['MENUITEM']['loop'];
$this->_sections['MENUITEM']['step'] = 1;
$this->_sections['MENUITEM']['start'] = $this->_sections['MENUITEM']['step'] > 0 ? 0 : $this->_sections['MENUITEM']['loop']-1;
if ($this->_sections['MENUITEM']['show']) {
    $this->_sections['MENUITEM']['total'] = $this->_sections['MENUITEM']['loop'];
    if ($this->_sections['MENUITEM']['total'] == 0)
        $this->_sections['MENUITEM']['show'] = false;
} else
    $this->_sections['MENUITEM']['total'] = 0;
if ($this->_sections['MENUITEM']['show']):

            for ($this->_sections['MENUITEM']['index'] = $this->_sections['MENUITEM']['start'], $this->_sections['MENUITEM']['iteration'] = 1;
                 $this->_sections['MENUITEM']['iteration'] <= $this->_sections['MENUITEM']['total'];
                 $this->_sections['MENUITEM']['index'] += $this->_sections['MENUITEM']['step'], $this->_sections['MENUITEM']['iteration']++):
$this->_sections['MENUITEM']['rownum'] = $this->_sections['MENUITEM']['iteration'];
$this->_sections['MENUITEM']['index_prev'] = $this->_sections['MENUITEM']['index'] - $this->_sections['MENUITEM']['step'];
$this->_sections['MENUITEM']['index_next'] = $this->_sections['MENUITEM']['index'] + $this->_sections['MENUITEM']['step'];
$this->_sections['MENUITEM']['first']      = ($this->_sections['MENUITEM']['iteration'] == 1);
$this->_sections['MENUITEM']['last']       = ($this->_sections['MENUITEM']['iteration'] == $this->_sections['MENUITEM']['total']);
?>
      <li class="_">
        <a href="/<?php echo $this->_tpl_vars['MENU'][$this->_sections['MENUITEM']['index']]['id']; ?>
" <?php if ($this->_tpl_vars['MENU'][$this->_sections['MENUITEM']['index']]['id'] == $this->_tpl_vars['M']['ID']): ?>class="selected" <?php endif; ?>><?php echo $this->_tpl_vars['MENU'][$this->_sections['MENUITEM']['index']]['label']; ?>
</a>
        <?php $this->assign('SUBMENU', $this->_tpl_vars['MENU'][$this->_sections['MENUITEM']['index']]['SUBMENU']); ?>
        <?php if ($this->_tpl_vars['SUBMENU']): ?>
		      <div class="_SUBMENU <?php echo $this->_tpl_vars['MENU'][$this->_sections['MENUITEM']['index']]['id']; ?>
" <?php if ($this->_tpl_vars['MENU'][$this->_sections['MENUITEM']['index']]['id'] != $this->_tpl_vars['M']['ID'] && $this->_tpl_vars['MENU'][$this->_sections['MENUITEM']['index']]['id'] != $this->_tpl_vars['M']['SUBMENUS_TABLE'][$this->_tpl_vars['M']['ID']]): ?>style="display:none;"<?php endif; ?>>
		        <?php unset($this->_sections['SUBMENU']);
$this->_sections['SUBMENU']['name'] = 'SUBMENU';
$this->_sections['SUBMENU']['loop'] = is_array($_loop=$this->_tpl_vars['SUBMENU']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['SUBMENU']['show'] = true;
$this->_sections['SUBMENU']['max'] = $this->_sections['SUBMENU']['loop'];
$this->_sections['SUBMENU']['step'] = 1;
$this->_sections['SUBMENU']['start'] = $this->_sections['SUBMENU']['step'] > 0 ? 0 : $this->_sections['SUBMENU']['loop']-1;
if ($this->_sections['SUBMENU']['show']) {
    $this->_sections['SUBMENU']['total'] = $this->_sections['SUBMENU']['loop'];
    if ($this->_sections['SUBMENU']['total'] == 0)
        $this->_sections['SUBMENU']['show'] = false;
} else
    $this->_sections['SUBMENU']['total'] = 0;
if ($this->_sections['SUBMENU']['show']):

            for ($this->_sections['SUBMENU']['index'] = $this->_sections['SUBMENU']['start'], $this->_sections['SUBMENU']['iteration'] = 1;
                 $this->_sections['SUBMENU']['iteration'] <= $this->_sections['SUBMENU']['total'];
                 $this->_sections['SUBMENU']['index'] += $this->_sections['SUBMENU']['step'], $this->_sections['SUBMENU']['iteration']++):
$this->_sections['SUBMENU']['rownum'] = $this->_sections['SUBMENU']['iteration'];
$this->_sections['SUBMENU']['index_prev'] = $this->_sections['SUBMENU']['index'] - $this->_sections['SUBMENU']['step'];
$this->_sections['SUBMENU']['index_next'] = $this->_sections['SUBMENU']['index'] + $this->_sections['SUBMENU']['step'];
$this->_sections['SUBMENU']['first']      = ($this->_sections['SUBMENU']['iteration'] == 1);
$this->_sections['SUBMENU']['last']       = ($this->_sections['SUBMENU']['iteration'] == $this->_sections['SUBMENU']['total']);
?>
		          <p><a href="/<?php echo $this->_tpl_vars['SUBMENU'][$this->_sections['SUBMENU']['index']]['id']; ?>
" <?php if ($this->_tpl_vars['SUBMENU'][$this->_sections['SUBMENU']['index']]['id'] == $this->_tpl_vars['M']['ID']): ?>class="selected" <?php endif; ?>><?php echo $this->_tpl_vars['SUBMENU'][$this->_sections['SUBMENU']['index']]['label']; ?>
</a></p>
		        <?php endfor; endif; ?>
		      </div>
        <?php endif; ?>
      </li>
    <?php endfor; endif; ?>
    </ul>
    
  </div>
<?php endfor; endif; ?>