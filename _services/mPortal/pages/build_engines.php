<?php
require_once( ROOT.'/_lib/jsmin.php');

$components = $this->DB->selectValues("SELECT ".DB_TABLE_components_defaults.".id FROM `".DB_TABLE_components_defaults."` LEFT JOIN `".DB_TABLE_components."` ON ".DB_TABLE_components_defaults.".id=".DB_TABLE_components.".id WHERE ".DB_TABLE_components.".css='1' OR ".DB_TABLE_components.".js='1'" );

// ENGINE CSS
$stamp = uniqid();

$txt = @file_get_contents(ROOT.'/cssLibs/engine.css');
for( $i=0; $i<count($components); $i++ )
	$txt .= "\n".@file_get_contents(ROOT.'/_components/'.$components[$i].'/'.$components[$i].'.css');

$output = @JSMIN::minify_css( $txt );

$stamp_old = $this->DB->selectValue("SELECT stamp FROM ".DB_TABLE_files_stamps." WHERE `file`='engine' AND `ext`='css'");
$output_old = @file_get_contents( ROOT.'/cssLibs/engine-'.$stamp_old.'.css' );

if( $_PARAMS['force'] || $output!=$output_old ){
	$old_stamp = $this->DB->selectValue("SELECT stamp FROM ".DB_TABLE_files_stamps." WHERE `file`='engine' AND `ext`='css' LIMIT 1");
	$this->DB->q("INSERT INTO ".DB_TABLE_files_stamps." (`file`, `ext`, `stamp`) VALUES ('engine', 'css', '$stamp') ON DUPLICATE KEY UPDATE `stamp`='$stamp'");
	@unlink( ROOT.'/cssLibs/engine-'.$old_stamp.'.css' );
	$result['engine-css'] = force_file_put_contents(ROOT.'/cssLibs/engine-'.$stamp.'.css', $output);
}



// ENGINE JS

$parts = array('/jsLibs/prototype.js', '/jsLibs/effects.js', '/jsLibs/builder.js', '/jsLibs/controls.js', '/jsLibs/dragdrop.js', '/jsLibs/scribd.js', '/jsLibs/engine.js');

for( $i=0; $i<count($components); $i++ )
	$parts[] = '/_components/'.$components[$i].'/'.$components[$i].'.js';

$stamp = uniqid();
$output = '';
foreach($parts as $file) $output .= @JSMIN::minify( @file_get_contents(ROOT.$file) );
$output = str_replace('__SITE_ROOT__', SITE_ROOT, $output);
$stamp_old = $this->DB->selectValue("SELECT stamp FROM ".DB_TABLE_files_stamps." WHERE `file`='engine' AND `ext`='js'");
$output_old = @file_get_contents( ROOT.'/jsLibs/engine-'.$stamp_old.'.js' );

if( $_PARAMS['force'] || $output!=$output_old ){
	$old_stamp = $this->DB->selectValue("SELECT stamp FROM ".DB_TABLE_files_stamps." WHERE `file`='engine' AND `ext`='js' LIMIT 1");
	$this->DB->q("INSERT INTO ".DB_TABLE_files_stamps." (`file`, `ext`, `stamp`) VALUES ('engine', 'js', '$stamp') ON DUPLICATE KEY UPDATE `stamp`='$stamp'");
	@unlink( ROOT.'/jsLibs/engine-'.$old_stamp.'.js' );
	$result['engine-js'] = force_file_put_contents(ROOT.'/jsLibs/engine-'.$stamp.'.js', $output);
}



// ENGINE ADMIN CSS
$stamp = uniqid();
$output = @JSMIN::minify_css( file_get_contents(ROOT.'/cssLibs/engine-admin.css') );

$stamp_old = $this->DB->selectValue("SELECT stamp FROM ".DB_TABLE_files_stamps." WHERE `file`='engine_admin' AND `ext`='css'");
$output_old = @file_get_contents( ROOT.'/cssLibs/engine-admin-'.$stamp_old.'.css' );

if( $_PARAMS['force'] || $output!=$output_old ){
	$this->DB->q("INSERT INTO ".DB_TABLE_files_stamps." (`file`, `ext`, `stamp`) VALUES ('engine_admin', 'css', '$stamp') ON DUPLICATE KEY UPDATE `stamp`='$stamp'");
	$result['engine-admin-css'] = force_file_put_contents(ROOT.'/cssLibs/engine-admin-'.$stamp.'.css', $output);
}



// ENGINE ADMIN JS
$stamp = uniqid();
$output = @JSMIN::minify( file_get_contents(ROOT.'/jsLibs/engine-admin.js') );

$stamp_old = $this->DB->selectValue("SELECT stamp FROM ".DB_TABLE_files_stamps." WHERE `file`='engine_admin' AND `ext`='js'");
$output_old = @file_get_contents( ROOT.'/jsLibs/engine-admin-'.$stamp_old.'.js' );

if( $_PARAMS['force'] || $output!=$output_old ){
	$this->DB->q("INSERT INTO ".DB_TABLE_files_stamps." (`file`, `ext`, `stamp`) VALUES ('engine_admin', 'js', '$stamp') ON DUPLICATE KEY UPDATE `stamp`='$stamp'");
	$result['engine-admin-js'] = force_file_put_contents(ROOT.'/jsLibs/engine-admin-'.$stamp.'.js', $output);
}


return $result;