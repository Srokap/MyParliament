<?php

$M->logout();

require_once(ROOT.'/_lib/smarty/Smarty.class.php');
$smarty_folder = ROOT.'/_patterns/_SMARTY/';
$SMARTY = new Smarty();
$SMARTY->template_dir = $smarty_folder;
$SMARTY->compile_dir  = $smarty_folder.'_templates_c/';
$SMARTY->config_dir   = $smarty_folder.'_configs/';
$SMARTY->cache_dir    = $smarty_folder.'_cache/';
$SMARTY->assign('redirection', $_REQUEST['next']);

// minify_html
$html = ( $SMARTY->fetch( ROOT.'/_lib/mPortal/resources/login.tpl' ) );

echo $html;