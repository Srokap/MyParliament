<?php
require_once( '../_lib/mPortal/config.php' );

$parts = explode( '.', $_SERVER['SERVER_NAME'] );

if( $parts[0]=='feed' ) {

	$_GET['_FEED'] = $_REQUEST['_PAGE'];
	include( $_SERVER['DOCUMENT_ROOT'].'/servers/feed.php' );

} elseif( $parts[0]=='api' ) {

	$_GET['_ACTION'] = $_REQUEST['_PAGE'];
	include( $_SERVER['DOCUMENT_ROOT'].'/servers/api.php' );

} elseif( $parts[0]=='sitemap' ) {

	$_GET['_SITEMAP_ID'] = $_REQUEST['_PAGE'];
	include( $_SERVER['DOCUMENT_ROOT'].'/servers/sitemap.php' );

} else {
	require_once( '../_lib/mPortal/PAGE.php' );
	$M = new Page($_REQUEST['_PAGE']);
	 
	$M->render_page();
}