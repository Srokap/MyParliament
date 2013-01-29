<?php /* Smarty version 2.6.19, created on 2013-01-29 10:29:20
         compiled from C:%5Cwork%5Cwww%5COchParliament/_layout/header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'C:\\work\\www\\OchParliament/_layout/header.tpl', 14, false),)), $this); ?>
<div class="s_header_cont"> 
  <div class="s_main_menu_cont_div">
    <div class="s_wrap">
      <div class="s_ochparliament_icon_div"><a title="Strona startowa" href="<?php echo $this->_tpl_vars['SITE_ROOT']; ?>
start"><img alt="Logo OchParliament" src="<?php echo $this->_tpl_vars['SITE_ROOT']; ?>
g/p.gif" class="ochparliament_icon" /></a></div>
      <div class="s_menu_div aoverflow">
       <div class="ralign rfloat">
          
          <?php if ($this->_tpl_vars['M']['isLogged']): ?>
            <ul>
              <?php if ($this->_tpl_vars['M']['isAdmin']): ?>
		            <li><a href="<?php echo $this->_tpl_vars['SITE_ROOT']; ?>
admin">Admin</a></li>
		          <?php endif; ?>
		          <li id="_USER_LI" class="s_user_li<?php if ($this->_tpl_vars['M']['FRONT_MENU_SELECTED'] == 'user'): ?> s<?php endif; ?>">
		            <a id="_USER_OPTIONS_A" href="<?php echo $this->_tpl_vars['SITE_ROOT']; ?>
konto"><span><?php echo ((is_array($_tmp=@$this->_tpl_vars['M']['USER']['name'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Ja') : smarty_modifier_default($_tmp, 'Ja')); ?>
</span><img src="<?php echo $this->_tpl_vars['SITE_ROOT']; ?>
g/p.gif" /></a>
		            <ul id="_USER_LINKS_UL" class="_USER_LINKS_UL left">
				          <li class="h"><a href="<?php echo $this->_tpl_vars['SITE_ROOT']; ?>
konto">Konto</a></li>
				          <li class="h"><a href="<?php echo $this->_tpl_vars['SITE_ROOT']; ?>
logout">Wyloguj</a></li>
				        </ul>
		          </li>
		        </ul>	            
            
		      <?php else: ?>
		        <ul>
		          <li class="h<?php if ($this->_tpl_vars['M']['FRONT_MENU_SELECTED'] == 'zaloguj'): ?> s<?php endif; ?>"><a href="<?php echo $this->_tpl_vars['SITE_ROOT']; ?>
zaloguj">Zaloguj</a></li>
		          <li class="h<?php if ($this->_tpl_vars['M']['FRONT_MENU_SELECTED'] == 'rejestracja'): ?> s<?php endif; ?>"><a href="<?php echo $this->_tpl_vars['SITE_ROOT']; ?>
rejestracja">Zarejestruj</a></li>
		        </ul>
          <?php endif; ?>
          
        </div>
      </div>
	  </div>
  </div>
</div>