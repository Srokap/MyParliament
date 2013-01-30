<?php
$path = $_PARAMS;

$pathparts = pathinfo($path);
$folder = $pathparts['dirname'];
$pagename = $pathparts['filename'];
$abspath = ROOT.'/_pages/'.$path;

if( !file_exists($abspath) || !is_dir($abspath) ){
	force_mkdir($abspath);
}
// @file_put_contents( $abspath.'/'.$pagename.'.tpl', '' );

@mkdir( $abspath.'/_templates_c' );
@mkdir( $abspath.'/_configs' );
@mkdir( $abspath.'/_cache' );
@mkdir( $abspath.'/_services' );
@mkdir( $abspath.'/_patterns' );

$this->DB->q("INSERT IGNORE INTO `".DB_TABLE_pages."` (id) VALUES ('".$path."')");
