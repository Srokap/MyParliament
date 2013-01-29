<?php /* Smarty version 2.6.19, created on 2013-01-22 13:08:24
         compiled from /Users/bona/Desktop/Work/OchParlament/_layout/main_search.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', '/Users/bona/Desktop/Work/OchParlament/_layout/main_search.tpl', 11, false),array('modifier', 'escape', '/Users/bona/Desktop/Work/OchParlament/_layout/main_search.tpl', 11, false),)), $this); ?>
<div id="_MAIN_SEARCH_DIV">
  <div class="s_wrap">
  
    <div id="_MAIN_SEARCH_PORTAL_MSG">
      <div class="s_wrap">
	      <p>Na Sejmometrze możesz przeglądać bazy danych publicznych oraz ustawić <a href="/powiadomienia">powiadomienia</a>, dzięki którym zawsze będziesz wiedział, gdy władza zajmuje się, interesującymi Ciebie problemami.</p>
      </div>
    </div>
    
    <div id="_MAIN_SEARCH_DIV_INNER">
		  <form method="get" action="/szukaj"><input maxlength="512" class="mInput<?php if (! $_GET['q']): ?> blured<?php endif; ?>" id="_MAIN_SEARCH_INPUT" type="text" name="q" value="<?php echo ((is_array($_tmp=((is_array($_tmp=@$_GET['q'])) ? $this->_run_mod_handler('default', true, $_tmp, "Szukaj w danych publicznych...") : smarty_modifier_default($_tmp, "Szukaj w danych publicznych...")))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" default_value="Szukaj w danych publicznych..." /><input id="_MAIN_SUBMIT_INPUT" type="submit" class="mBtn green" value="Szukaj &raquo;" /></form>
    </div>
  </div>
</div>