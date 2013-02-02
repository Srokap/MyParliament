<?php /* Smarty version 2.6.19, created on 2013-02-02 11:29:25
         compiled from /MAMP/GitHub/OchParliament/_layout/header.tpl */ ?>
<div class="s_header_cont"> 
  <div class="s_main_menu_cont_div">
    <div class="s_wrap">
      <div class="s_menu_div aoverflow">
       
       <div class="lalgin lfloat">
        
        
       
			    <ul>
            <?php unset($this->_sections['front_menu']);
$this->_sections['front_menu']['name'] = 'front_menu';
$this->_sections['front_menu']['loop'] = is_array($_loop=$this->_tpl_vars['M']['FRONT_MENU']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['front_menu']['show'] = true;
$this->_sections['front_menu']['max'] = $this->_sections['front_menu']['loop'];
$this->_sections['front_menu']['step'] = 1;
$this->_sections['front_menu']['start'] = $this->_sections['front_menu']['step'] > 0 ? 0 : $this->_sections['front_menu']['loop']-1;
if ($this->_sections['front_menu']['show']) {
    $this->_sections['front_menu']['total'] = $this->_sections['front_menu']['loop'];
    if ($this->_sections['front_menu']['total'] == 0)
        $this->_sections['front_menu']['show'] = false;
} else
    $this->_sections['front_menu']['total'] = 0;
if ($this->_sections['front_menu']['show']):

            for ($this->_sections['front_menu']['index'] = $this->_sections['front_menu']['start'], $this->_sections['front_menu']['iteration'] = 1;
                 $this->_sections['front_menu']['iteration'] <= $this->_sections['front_menu']['total'];
                 $this->_sections['front_menu']['index'] += $this->_sections['front_menu']['step'], $this->_sections['front_menu']['iteration']++):
$this->_sections['front_menu']['rownum'] = $this->_sections['front_menu']['iteration'];
$this->_sections['front_menu']['index_prev'] = $this->_sections['front_menu']['index'] - $this->_sections['front_menu']['step'];
$this->_sections['front_menu']['index_next'] = $this->_sections['front_menu']['index'] + $this->_sections['front_menu']['step'];
$this->_sections['front_menu']['first']      = ($this->_sections['front_menu']['iteration'] == 1);
$this->_sections['front_menu']['last']       = ($this->_sections['front_menu']['iteration'] == $this->_sections['front_menu']['total']);
?><?php $this->assign('m', $this->_tpl_vars['M']['FRONT_MENU'][$this->_sections['front_menu']['index']]); ?>
		          <li<?php if ($this->_tpl_vars['m']['s']): ?> class="s"<?php endif; ?>><a<?php if ($this->_tpl_vars['m']['dom_id']): ?> id="<?php echo $this->_tpl_vars['m']['dom_id']; ?>
"<?php endif; ?> href="/<?php echo $this->_tpl_vars['m']['url']; ?>
"><?php echo $this->_tpl_vars['m']['name']; ?>
</a></li>
	          <?php endfor; endif; ?>
	        </ul>

          
        </div><div class="ralign rfloat">
          
          <?php if ($this->_tpl_vars['M']['isLogged']): ?>
            <ul>
              <?php if ($this->_tpl_vars['M']['isAdmin']): ?>
		            <li><a href="<?php echo $this->_tpl_vars['M']['SITE_ROOT']; ?>
admin">Administration</a></li>
		          <?php endif; ?>
		          <li id="_USER_LI" class="s_user_li<?php if ($this->_tpl_vars['M']['FRONT_MENU_SELECTED'] == 'user'): ?> s<?php endif; ?>">
		            <a id="_USER_OPTIONS_A" href="<?php echo $this->_tpl_vars['M']['SITE_ROOT']; ?>
konto"><span>Account</span><img src="<?php echo $this->_tpl_vars['SITE_ROOT']; ?>
g/p.gif" /></a>
		            <ul id="_USER_LINKS_UL" class="_USER_LINKS_UL left">
				          <li class="h"><a href="<?php echo $this->_tpl_vars['M']['SITE_ROOT']; ?>
konto">Preferences</a></li>
				          <li class="h"><a href="<?php echo $this->_tpl_vars['M']['SITE_ROOT']; ?>
logout">Logout</a></li>
				        </ul>
		          </li>
		        </ul>	            
            
		      <?php else: ?>
		        <ul>
		          <li class="h<?php if ($this->_tpl_vars['M']['FRONT_MENU_SELECTED'] == 'zaloguj'): ?> s<?php endif; ?>"><a href="<?php echo $this->_tpl_vars['M']['SITE_ROOT']; ?>
zaloguj">Sign in</a></li>
		          <li class="h<?php if ($this->_tpl_vars['M']['FRONT_MENU_SELECTED'] == 'rejestracja'): ?> s<?php endif; ?>"><a href="<?php echo $this->_tpl_vars['M']['SITE_ROOT']; ?>
rejestracja">Sign up</a></li>
		        </ul>
          <?php endif; ?>
          
        </div>
      </div>
	  </div>
  </div>
</div>