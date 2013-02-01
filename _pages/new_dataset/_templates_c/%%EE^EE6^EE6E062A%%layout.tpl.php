<?php /* Smarty version 2.6.19, created on 2013-02-01 22:39:04
         compiled from /MAMP/GitHub/OchParliament/_lib/mPortal/resources/layout.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', '/MAMP/GitHub/OchParliament/_lib/mPortal/resources/layout.tpl', 9, false),array('modifier', 'strip_tags', '/MAMP/GitHub/OchParliament/_lib/mPortal/resources/layout.tpl', 12, false),array('modifier', 'cat', '/MAMP/GitHub/OchParliament/_lib/mPortal/resources/layout.tpl', 27, false),array('modifier', 'default', '/MAMP/GitHub/OchParliament/_lib/mPortal/resources/layout.tpl', 98, false),)), $this); ?>
<?php echo '<?xml'; ?>
 version="1.0" encoding="utf-8"<?php echo '?>'; ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html<?php if ($this->_tpl_vars['M']['LAYOUT'] != 'blank'): ?> style="background: url('<?php echo $this->_tpl_vars['M']['SITE_ROOT']; ?>
g/_page_bg_pattern.gif') repeat scroll 0 0 #EEEEEE;"<?php endif; ?>>
  <head profile="http://www.w3.org/2005/10/profile">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <?php unset($this->_sections['META']);
$this->_sections['META']['name'] = 'META';
$this->_sections['META']['loop'] = is_array($_loop=$this->_tpl_vars['M']['META']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['META']['show'] = true;
$this->_sections['META']['max'] = $this->_sections['META']['loop'];
$this->_sections['META']['step'] = 1;
$this->_sections['META']['start'] = $this->_sections['META']['step'] > 0 ? 0 : $this->_sections['META']['loop']-1;
if ($this->_sections['META']['show']) {
    $this->_sections['META']['total'] = $this->_sections['META']['loop'];
    if ($this->_sections['META']['total'] == 0)
        $this->_sections['META']['show'] = false;
} else
    $this->_sections['META']['total'] = 0;
if ($this->_sections['META']['show']):

            for ($this->_sections['META']['index'] = $this->_sections['META']['start'], $this->_sections['META']['iteration'] = 1;
                 $this->_sections['META']['iteration'] <= $this->_sections['META']['total'];
                 $this->_sections['META']['index'] += $this->_sections['META']['step'], $this->_sections['META']['iteration']++):
$this->_sections['META']['rownum'] = $this->_sections['META']['iteration'];
$this->_sections['META']['index_prev'] = $this->_sections['META']['index'] - $this->_sections['META']['step'];
$this->_sections['META']['index_next'] = $this->_sections['META']['index'] + $this->_sections['META']['step'];
$this->_sections['META']['first']      = ($this->_sections['META']['iteration'] == 1);
$this->_sections['META']['last']       = ($this->_sections['META']['iteration'] == $this->_sections['META']['total']);
?>
      <META <?php if ($this->_tpl_vars['M']['META'][$this->_sections['META']['index']][2]): ?>PROPERTY<?php else: ?>NAME<?php endif; ?>="<?php echo $this->_tpl_vars['M']['META'][$this->_sections['META']['index']][0]; ?>
" CONTENT="<?php echo ((is_array($_tmp=$this->_tpl_vars['M']['META'][$this->_sections['META']['index']][1])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
">
    <?php endfor; endif; ?>
    
    <title><?php if ($this->_tpl_vars['M']['FORCE_TITLE']): ?><?php echo smarty_modifier_strip_tags($this->_tpl_vars['M']['FORCE_TITLE']); ?>
<?php else: ?><?php echo ((is_array($_tmp=smarty_modifier_strip_tags($this->_tpl_vars['M']['TITLE']))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 <?php if ($this->_tpl_vars['M']['TITLE']): ?>| <?php endif; ?><?php echo smarty_modifier_strip_tags($this->_tpl_vars['M']['DEFAULT_PAGE_TITLE']); ?>
<?php endif; ?></title>
    <?php if ($this->_tpl_vars['M']['REL']['prev']): ?><link rel="prev" href="<?php echo $this->_tpl_vars['M']['REL']['prev']; ?>
" /><?php endif; ?>
    <?php if ($this->_tpl_vars['M']['REL']['next']): ?><link rel="next" href="<?php echo $this->_tpl_vars['M']['REL']['next']; ?>
" /><?php endif; ?>
    
    <?php if ($this->_tpl_vars['M']['FORCE_ICON']): ?><link rel="icon" type="image/png" href="<?php echo $this->_tpl_vars['M']['SITE_ROOT']; ?>
g/<?php echo $this->_tpl_vars['M']['FORCE_ICON']; ?>
.png" /><?php else: ?><link rel="icon" type="image/ico" href="<?php echo $this->_tpl_vars['SITE_ROOT']; ?>
g/sejmometr_32_tecza_s.ico" /><?php endif; ?>
    
    
    <link rel="stylesheet" href="<?php echo $this->_tpl_vars['M']['SITE_ROOT']; ?>
cssLibs/engine-<?php echo $this->_tpl_vars['M']['STAMPS']['engine_css']; ?>
.css" type="text/css">
    
    <?php if ($this->_tpl_vars['M']['isAdmin']): ?>
      <link rel="stylesheet" href="<?php echo $this->_tpl_vars['M']['SITE_ROOT']; ?>
cssLibs/engine-admin-<?php echo $this->_tpl_vars['M']['STAMPS']['engine_admin_css']; ?>
.css" type="text/css">
    <?php endif; ?>
    
	  <?php unset($this->_sections['sheets']);
$this->_sections['sheets']['name'] = 'sheets';
$this->_sections['sheets']['loop'] = is_array($_loop=$this->_tpl_vars['M']['CSSLIBS']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['sheets']['show'] = true;
$this->_sections['sheets']['max'] = $this->_sections['sheets']['loop'];
$this->_sections['sheets']['step'] = 1;
$this->_sections['sheets']['start'] = $this->_sections['sheets']['step'] > 0 ? 0 : $this->_sections['sheets']['loop']-1;
if ($this->_sections['sheets']['show']) {
    $this->_sections['sheets']['total'] = $this->_sections['sheets']['loop'];
    if ($this->_sections['sheets']['total'] == 0)
        $this->_sections['sheets']['show'] = false;
} else
    $this->_sections['sheets']['total'] = 0;
if ($this->_sections['sheets']['show']):

            for ($this->_sections['sheets']['index'] = $this->_sections['sheets']['start'], $this->_sections['sheets']['iteration'] = 1;
                 $this->_sections['sheets']['iteration'] <= $this->_sections['sheets']['total'];
                 $this->_sections['sheets']['index'] += $this->_sections['sheets']['step'], $this->_sections['sheets']['iteration']++):
$this->_sections['sheets']['rownum'] = $this->_sections['sheets']['iteration'];
$this->_sections['sheets']['index_prev'] = $this->_sections['sheets']['index'] - $this->_sections['sheets']['step'];
$this->_sections['sheets']['index_next'] = $this->_sections['sheets']['index'] + $this->_sections['sheets']['step'];
$this->_sections['sheets']['first']      = ($this->_sections['sheets']['iteration'] == 1);
$this->_sections['sheets']['last']       = ($this->_sections['sheets']['iteration'] == $this->_sections['sheets']['total']);
?><link rel="stylesheet" href="<?php echo $this->_tpl_vars['M']['SITE_ROOT']; ?>
cssLibs/<?php echo $this->_tpl_vars['M']['CSSLIBS'][$this->_sections['sheets']['index']]; ?>
" type="text/css"><?php endfor; endif; ?>
    <?php if ($this->_tpl_vars['M']['cssFile']): ?><link rel="stylesheet" href="<?php echo $this->_tpl_vars['M']['SITE_ROOT']; ?>
css/<?php echo $this->_tpl_vars['M']['ID']; ?>
-<?php echo $this->_tpl_vars['M']['STAMPS']['css']; ?>
.css" type="text/css"><?php endif; ?>
    <?php if ($this->_tpl_vars['M']['cssInline']): ?><style><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ((is_array($_tmp=$this->_tpl_vars['M']['NAME'])) ? $this->_run_mod_handler('cat', true, $_tmp, "-inline.css") : smarty_modifier_cat($_tmp, "-inline.css")), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></style><?php endif; ?>
    
    <!--[if IE 7]>
		<link rel="stylesheet" href="/css/ie7.css" type="text/css" />		
		<![endif]-->
    <!--[if IE 8]>
		<link rel="stylesheet" href="/css/ie8.css" type="text/css" />		
		<![endif]-->
    
    <?php unset($this->_sections['links']);
$this->_sections['links']['name'] = 'links';
$this->_sections['links']['loop'] = is_array($_loop=$this->_tpl_vars['M']['LINKS']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['links']['show'] = true;
$this->_sections['links']['max'] = $this->_sections['links']['loop'];
$this->_sections['links']['step'] = 1;
$this->_sections['links']['start'] = $this->_sections['links']['step'] > 0 ? 0 : $this->_sections['links']['loop']-1;
if ($this->_sections['links']['show']) {
    $this->_sections['links']['total'] = $this->_sections['links']['loop'];
    if ($this->_sections['links']['total'] == 0)
        $this->_sections['links']['show'] = false;
} else
    $this->_sections['links']['total'] = 0;
if ($this->_sections['links']['show']):

            for ($this->_sections['links']['index'] = $this->_sections['links']['start'], $this->_sections['links']['iteration'] = 1;
                 $this->_sections['links']['iteration'] <= $this->_sections['links']['total'];
                 $this->_sections['links']['index'] += $this->_sections['links']['step'], $this->_sections['links']['iteration']++):
$this->_sections['links']['rownum'] = $this->_sections['links']['iteration'];
$this->_sections['links']['index_prev'] = $this->_sections['links']['index'] - $this->_sections['links']['step'];
$this->_sections['links']['index_next'] = $this->_sections['links']['index'] + $this->_sections['links']['step'];
$this->_sections['links']['first']      = ($this->_sections['links']['iteration'] == 1);
$this->_sections['links']['last']       = ($this->_sections['links']['iteration'] == $this->_sections['links']['total']);
?><link href="<?php echo $this->_tpl_vars['M']['LINKS'][$this->_sections['links']['index']]['href']; ?>
" title="<?php echo $this->_tpl_vars['M']['LINKS'][$this->_sections['links']['index']]['title']; ?>
" type="<?php echo $this->_tpl_vars['M']['LINKS'][$this->_sections['links']['index']]['type']; ?>
" rel="<?php echo $this->_tpl_vars['M']['LINKS'][$this->_sections['links']['index']]['rel']; ?>
"><?php endfor; endif; ?>
    
    <script type="text/javascript">
      var CURRENT_PAGE = '<?php echo $this->_tpl_vars['M']['ID']; ?>
';
      var _LANG = '<?php echo $this->_tpl_vars['M']['LANG']; ?>
';
			var _PAGEDATA = {'ID':'<?php echo $this->_tpl_vars['M']['ID']; ?>
', 'NAME':'<?php echo $this->_tpl_vars['M']['NAME']; ?>
'<?php if ($this->_tpl_vars['M']['goHomeOnLogin']): ?>, 'goHomeOnLogin': true<?php endif; ?>};
						
			var _LOGGED = <?php if ($this->_tpl_vars['M']['isLogged']): ?>true<?php else: ?>false<?php endif; ?>;
			<?php if ($this->_tpl_vars['M']['isLogged']): ?>
			  var _LOGGED_TYPE = '<?php echo $this->_tpl_vars['M']['USER']['type']; ?>
';
			<?php endif; ?>
			
			<?php if ($this->_tpl_vars['M']['isAdmin']): ?>
			  var _ADMIN = true;			  
			<?php endif; ?>
	  </script>
	  <script type="text/javascript" src="http://www.google.com/jsapi"></script>
  </head>
  
  <body class="_layout_new <?php echo $this->_tpl_vars['M']['LAYOUT']; ?>
<?php if ($this->_tpl_vars['M']['BREAD_CRUMBS']): ?> bc<?php endif; ?><?php if ($this->_tpl_vars['M']['FULLSCREEN']): ?> _FULLSCREEN<?php endif; ?>">
    <div id="fb-root"></div>

    <?php echo '
    
   
	  <!--[if IE 6]>
		<script type="text/javascript"> 
			/*Load jQuery if not already loaded*/ if(typeof jQuery == \'undefined\'){ document.write("<script type=\\"text/javascript\\"   src=\\"http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js\\"></"+"script>"); var __noconflict = true; } 
			var IE6UPDATE_OPTIONS = {
				icons_path: "/ie6update/images/"
			}
		</script>
		<script type="text/javascript" src="/ie6update/ie6update.js"></script>
		<![endif]-->
		'; ?>

    <div id="_OVERLAY" style="display: none;"></div>
    
    
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['M']['ROOT'])) ? $this->_run_mod_handler('cat', true, $_tmp, "/_layout/") : smarty_modifier_cat($_tmp, "/_layout/")))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['M']['LAYOUT']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['M']['LAYOUT'])))) ? $this->_run_mod_handler('cat', true, $_tmp, ".tpl") : smarty_modifier_cat($_tmp, ".tpl")), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    
    
    <div id="_LIGHTBOXES">
    </div>
    
    <script type="text/javascript">
      <?php echo '
      var _FB_INIT_DATA = {
		    appId      : \''; ?>
<?php echo $this->_tpl_vars['M']['FB_APP_ID']; ?>
<?php echo '\', // App ID
		    channelUrl : \'//{$M.SITE_ADDRESS}/channel.html\', // Channel File
		    status     : true, // check login status
		    cookie     : true, // enable cookies to allow the server to access the session
		    oauth      : true, // enable OAuth 2.0
		    xfbml      : true  // parse XFBML
		  };
		  '; ?>

    </script>
    
    <?php if ($this->_tpl_vars['M']['jsConfig'] || $this->_tpl_vars['M']['disqus_url']): ?>
      <script type="text/javascript">
        <?php if ($this->_tpl_vars['M']['jsConfig']): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ((is_array($_tmp=$this->_tpl_vars['M']['NAME'])) ? $this->_run_mod_handler('cat', true, $_tmp, "-inline-config.js") : smarty_modifier_cat($_tmp, "-inline-config.js")), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?>
        <?php if ($this->_tpl_vars['M']['disqus_url']): ?>
          <?php echo 'var'; ?>
 disqus_shortname = 'ochparliament';
					<?php echo 'var'; ?>
 disqus_identifier = '<?php echo ((is_array($_tmp=@$this->_tpl_vars['M']['disqus_identifier'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['M']['disqus_url']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['M']['disqus_url'])); ?>
';
					<?php echo 'var'; ?>
 disqus_url = '<?php echo $this->_tpl_vars['SITE_ADDRESS']; ?>
<?php echo $this->_tpl_vars['M']['disqus_url']; ?>
';
        <?php endif; ?>
      </script>
    <?php endif; ?>
    
    <script type="text/javascript" src="<?php echo $this->_tpl_vars['M']['SITE_ROOT']; ?>
jsLibs/engine-<?php echo $this->_tpl_vars['M']['STAMPS']['engine_js']; ?>
.js"></script>
    <?php unset($this->_sections['EXTERNALJSSLIBS']);
$this->_sections['EXTERNALJSSLIBS']['name'] = 'EXTERNALJSSLIBS';
$this->_sections['EXTERNALJSSLIBS']['loop'] = is_array($_loop=$this->_tpl_vars['M']['EXTERNALJSSLIBS']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['EXTERNALJSSLIBS']['show'] = true;
$this->_sections['EXTERNALJSSLIBS']['max'] = $this->_sections['EXTERNALJSSLIBS']['loop'];
$this->_sections['EXTERNALJSSLIBS']['step'] = 1;
$this->_sections['EXTERNALJSSLIBS']['start'] = $this->_sections['EXTERNALJSSLIBS']['step'] > 0 ? 0 : $this->_sections['EXTERNALJSSLIBS']['loop']-1;
if ($this->_sections['EXTERNALJSSLIBS']['show']) {
    $this->_sections['EXTERNALJSSLIBS']['total'] = $this->_sections['EXTERNALJSSLIBS']['loop'];
    if ($this->_sections['EXTERNALJSSLIBS']['total'] == 0)
        $this->_sections['EXTERNALJSSLIBS']['show'] = false;
} else
    $this->_sections['EXTERNALJSSLIBS']['total'] = 0;
if ($this->_sections['EXTERNALJSSLIBS']['show']):

            for ($this->_sections['EXTERNALJSSLIBS']['index'] = $this->_sections['EXTERNALJSSLIBS']['start'], $this->_sections['EXTERNALJSSLIBS']['iteration'] = 1;
                 $this->_sections['EXTERNALJSSLIBS']['iteration'] <= $this->_sections['EXTERNALJSSLIBS']['total'];
                 $this->_sections['EXTERNALJSSLIBS']['index'] += $this->_sections['EXTERNALJSSLIBS']['step'], $this->_sections['EXTERNALJSSLIBS']['iteration']++):
$this->_sections['EXTERNALJSSLIBS']['rownum'] = $this->_sections['EXTERNALJSSLIBS']['iteration'];
$this->_sections['EXTERNALJSSLIBS']['index_prev'] = $this->_sections['EXTERNALJSSLIBS']['index'] - $this->_sections['EXTERNALJSSLIBS']['step'];
$this->_sections['EXTERNALJSSLIBS']['index_next'] = $this->_sections['EXTERNALJSSLIBS']['index'] + $this->_sections['EXTERNALJSSLIBS']['step'];
$this->_sections['EXTERNALJSSLIBS']['first']      = ($this->_sections['EXTERNALJSSLIBS']['iteration'] == 1);
$this->_sections['EXTERNALJSSLIBS']['last']       = ($this->_sections['EXTERNALJSSLIBS']['iteration'] == $this->_sections['EXTERNALJSSLIBS']['total']);
?><script type="text/javascript" src="<?php echo $this->_tpl_vars['M']['EXTERNALJSSLIBS'][$this->_sections['EXTERNALJSSLIBS']['index']]; ?>
"></script><?php endfor; endif; ?>
    
    <?php if ($this->_tpl_vars['M']['isAdmin']): ?>
      <script type="text/javascript" src="<?php echo $this->_tpl_vars['M']['SITE_ROOT']; ?>
jsLibs/engine-admin<?php if ($_REQUEST['DONT_MINIFY'] != 1): ?>-<?php echo $this->_tpl_vars['M']['STAMPS']['engine_admin_js']; ?>
<?php endif; ?>.js"></script>
    <?php endif; ?>
    
    <?php unset($this->_sections['scripts']);
$this->_sections['scripts']['name'] = 'scripts';
$this->_sections['scripts']['loop'] = is_array($_loop=$this->_tpl_vars['M']['JSLIBS']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['scripts']['show'] = true;
$this->_sections['scripts']['max'] = $this->_sections['scripts']['loop'];
$this->_sections['scripts']['step'] = 1;
$this->_sections['scripts']['start'] = $this->_sections['scripts']['step'] > 0 ? 0 : $this->_sections['scripts']['loop']-1;
if ($this->_sections['scripts']['show']) {
    $this->_sections['scripts']['total'] = $this->_sections['scripts']['loop'];
    if ($this->_sections['scripts']['total'] == 0)
        $this->_sections['scripts']['show'] = false;
} else
    $this->_sections['scripts']['total'] = 0;
if ($this->_sections['scripts']['show']):

            for ($this->_sections['scripts']['index'] = $this->_sections['scripts']['start'], $this->_sections['scripts']['iteration'] = 1;
                 $this->_sections['scripts']['iteration'] <= $this->_sections['scripts']['total'];
                 $this->_sections['scripts']['index'] += $this->_sections['scripts']['step'], $this->_sections['scripts']['iteration']++):
$this->_sections['scripts']['rownum'] = $this->_sections['scripts']['iteration'];
$this->_sections['scripts']['index_prev'] = $this->_sections['scripts']['index'] - $this->_sections['scripts']['step'];
$this->_sections['scripts']['index_next'] = $this->_sections['scripts']['index'] + $this->_sections['scripts']['step'];
$this->_sections['scripts']['first']      = ($this->_sections['scripts']['iteration'] == 1);
$this->_sections['scripts']['last']       = ($this->_sections['scripts']['iteration'] == $this->_sections['scripts']['total']);
?><script type="text/javascript" src="/jsLibs/<?php echo $this->_tpl_vars['M']['JSLIBS'][$this->_sections['scripts']['index']]; ?>
"></script><?php endfor; endif; ?>
    <?php if ($this->_tpl_vars['M']['jsFile']): ?><script type="text/javascript" src="<?php echo $this->_tpl_vars['M']['SITE_ROOT']; ?>
js/<?php echo $this->_tpl_vars['M']['ID']; ?>
-<?php echo $this->_tpl_vars['M']['STAMPS']['js']; ?>
.js"></script><?php endif; ?>
    
    <script type="text/javascript">
			<?php if ($this->_tpl_vars['M']['jsInline']): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ((is_array($_tmp=$this->_tpl_vars['M']['NAME'])) ? $this->_run_mod_handler('cat', true, $_tmp, "-inline.js") : smarty_modifier_cat($_tmp, "-inline.js")), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?>				
			
			<?php if ($this->_tpl_vars['M']['google_maps']): ?>
			<?php echo '
			var script = document.createElement("script");
		  script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyCWTe-IcZTMpn2HyG3OaTGKla7SY72ddx8&sensor=false&libraries=geometry&callback=_google_maps_initialize";
		  script.type = "text/javascript";
		  document.getElementsByTagName("head")[0].appendChild(script);
			'; ?>

			<?php endif; ?>
			
			<?php echo '
			var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
			document.write(unescape("%3Cscript src=\'" + gaJsHost + "google-analytics.com/ga.js\' type=\'text/javascript\'%3E%3C/script%3E"));
	  </script>
		<script type="text/javascript">try { var pageTracker = _gat._getTracker("UA-3303173-6"); pageTracker._trackPageview(); } catch(err) {}
		  '; ?>
  
		</script>
		<div id="__LIGHTBOXES">
    </div>
  </body>
</html>