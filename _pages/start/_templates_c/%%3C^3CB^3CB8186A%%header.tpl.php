<?php /* Smarty version 2.6.19, created on 2013-01-22 15:03:09
         compiled from /Users/bona/Desktop/Work/OchParlament/_layout/header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'json_encode', '/Users/bona/Desktop/Work/OchParlament/_layout/header.tpl', 32, false),array('modifier', 'default', '/Users/bona/Desktop/Work/OchParlament/_layout/header.tpl', 37, false),)), $this); ?>
<div class="s_header_cont">

  
  
  
  
  <div class="s_main_menu_cont_div">
    <div class="s_wrap">
      <div class="s_sejmometr_icon_div"><a title="Strona startowa" href="<?php echo $this->_tpl_vars['SITE_ROOT']; ?>
start"><img alt="Logo Sejmometru" src="<?php echo $this->_tpl_vars['SITE_ROOT']; ?>
g/p.gif" class="s_sejmometr_icon" /></a></div>
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
"<?php endif; ?> href="<?php echo $this->_tpl_vars['SITE_ROOT']; ?>
<?php echo $this->_tpl_vars['m']['url']; ?>
"><?php echo $this->_tpl_vars['m']['name']; ?>
</a></li>
	          <?php endfor; endif; ?>
	        </ul>

          
        </div><div class="ralign rfloat">
          
          <?php if ($this->_tpl_vars['M']['isLogged']): ?>
            <ul>
              <?php if ($this->_tpl_vars['M']['isAdmin'] && $_REQUEST['__VERSION'] != 'dev'): ?>
		            <li><a id="_LICZNIKI_TOGGLE" href="#" onclick="return false;">Do zrobienia <span class="_licznik" licznik="wszystko"><?php echo $this->_tpl_vars['LICZNIKI']['count']; ?>
</span></a>
									<div id="_LICZNIKI_DIV" style="display: none;">
									  <ul id="_LICZNIKI_UL"></ul>
									</div>
									<script>
									  var $LICZNIKI_INITIAL_DATA = <?php echo json_encode($this->_tpl_vars['LICZNIKI']); ?>
;
									</script>
								</li>
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